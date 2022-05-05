<?php

namespace App\Http\Livewire\UserProfile;

use App\Models\Post;
use App\Models\Post\PostStat;
use App\Models\Post\PostToPost;
use App\Models\Post\Tag;
use App\Models\Post\UserPostStat;
use App\Models\User;
use ArrayObject;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Comments extends Component
{
    use WithFileUploads;

    public $postText;
    public $postTags = [];
    public $mentions = [];
    // public $category;
    public $imageInputModal = [];
    public $isDisabled = true;
    public $imagesModal = [];
    public $totalAmount;
    public $loadAmount = 5;


    protected $listeners = [
        'refreshPosts' => '$refresh',
    ];

    protected $rules = [
        'postText' => 'required|min:2|max:1024',
        'imageInputModal.*' => 'max:1024',
    ];

    protected $messages = [
        'postText.required' => 'The post cannot be empty.',
        'postText.min' => 'To short.',
        'postText.max' => 'To big.',
    ];

    public function loadMore()
    {
        $this->loadAmount += 5;
    }

    public function store()
    {
        $this->validate();
        // dd($this->postTags);
        $i = 1;
        $filenames = new ArrayObject();
        $last_id = 0;
        if (DB::table('posts')->count() !== 0) {
            $last_id = DB::table('posts')->latest('id')->first()->id;
        }
        foreach ($this->imagesModal as $image) {
            $path = 'images/users/' . auth()->user()->username . '/posts/' . $last_id + 1;
            $filenames->append($path . '/' . $i . '.jpg');
            //dd(json_encode($filenames));
            $image->storeAs(
                $path,
                $i . '.jpg', 
                'public'
            );
            $i += 1;
        }

        $comment = Post::create([
            'user_id' => auth()->user()->id,
            'full_text' => $this->postText,
            'image' => json_encode($filenames),
            'tags' => json_encode((object) $this->postTags),
            'mentions' => json_encode((object) $this->mentions),
            'to_post' => true,
        ]);

        PostStat::create([
            'post_id' => $comment->id,
        ]);

        PostToPost::create([
            'post_id' => $comment->id,
            'to_post_id' => $this->post->id
        ]);

        foreach ($this->postTags as $tag) {
            Tag::firstOrCreate([
                'tag' => $tag,
            ]);
        }

        $this->reset(['postText', 'imageInputModal', 'imagesModal']);
        $this->emit('refreshPosts', $this->post->id);
    }

    public function numberFilter($n)
    {
        if ($n > 1000000000000) return round(($n / 1000000000000), 1) . 'T';
        else if ($n > 1000000000) return round(($n / 1000000000), 1) . 'B';
        else if ($n > 1000000) return round(($n / 1000000), 1) . 'M';
        else if ($n > 1000) return round(($n / 1000), 1) . 'K';

        return number_format($n);
    }

    public function openPostModal(Post $post)
    {
        return $post->image != '{}'
            ? $this->emit('openModal', 'user-profile.modal.image-post-modal', ['post' => $post->id])
            : $this->emit('openModal', 'user-profile.modal.post-modal', ['post' => $post->id]);
    }

    public function deleteImage($id)
    {
        array_splice($this->imagesModal, $id, 1);
    }

    public function updatedImageInputModal()
    {
        foreach ($this->imageInputModal as $image) {
            array_push($this->imagesModal, $image);
        }

        // dd($this->imagesModal);
    }

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->totalAmount = $post->postsToPost->count();
        $this->mentionables = User::all()->load('userInfo')
            ->map(function ($user) {
                return [
                    'key' => $user->username,
                    'value' => $user->name,
                    'image' => $user->userInfo->avatar
                ];
            });
        $this->tags = Tag::all()->map(function ($tag) {
            return [
                'key' => $tag->id,
                'value' => $tag->tag,
            ];
        });
    }

    public function render()
    {
        return view('livewire.user-profile.comments', [
            'comments' => $this->post
                ->postsToPost
                ->sortByDesc('created_at')
                ->take($this->loadAmount)
        ]);
    }
}
