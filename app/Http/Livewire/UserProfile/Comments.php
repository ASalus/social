<?php

namespace App\Http\Livewire\UserProfile;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Post\PostStat;
use App\Models\Post\PostToPost;
use App\Models\Post\UserPostStat;
use ArrayObject;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Comments extends Component
{
    use WithFileUploads;

    public $postText;
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
        'postText' => 'required|min:2|max:255',
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

        $i = 1;
        $filenames= new ArrayObject();
        $last_id = 0;
        if(DB::table('posts')->count() !== 0){
            $last_id = DB::table('posts')->latest('id')->first()->id;
        }
        foreach ($this->imagesModal as $image) {
            $path = 'images/users/'.auth()->user()->username.'/posts/'. $last_id+1;
            $filenames->append($path.'/'. $i. '.jpg');
            //dd(json_encode($filenames));
            $image->storeAs(
                'public/'.$path,
                $i.'.jpg'
            );
            $i +=1;
        }



        $comment = Post::create([
            'user_id' => auth()->user()->id,
            'full_text' => $this->postText,
            'image' => json_encode($filenames),
            'to_post' => true,
        ]);

        PostStat::create([
            'post_id' => $comment->id,
        ]);

        PostToPost::create([
            'post_id' => $comment->id,
            'to_post_id' => $this->post->id
        ]);

        $this->reset(['postText', 'imageInputModal', 'imagesModal']);
        $this->emit('refreshPosts', $this->post->id);
    }

    public function openPostModal(Post $post)
    {
        return $post->image != '{}'
            ? $this->emit('openModal', 'user-profile.modal.image-post-modal', ['post' => $post->id])
            : $this->emit('openModal', 'user-profile.modal.post-modal', ['post' => $post->id]);
    }

    public function resendClick(Post $post)
    {

        $userPostStat = UserPostStat::firstOrCreate([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ]);
        if($userPostStat->resend == false)
        {
            $userPostStat->resend = true;
            $post->stats->resend += 1;
        }
        else
        {
            $userPostStat->resend = false;
            $post->stats->resend -= 1;
        }
        $userPostStat->save();
        $post->stats->save();
        $this->emit('$refresh');
    }

    public function likeClick(Post $post)
    {

        $userPostStat = UserPostStat::firstOrCreate([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ]);
        if($userPostStat->liked == false)
        {
            $userPostStat->liked = true;
            $post->stats->like += 1;
        }
        else
        {
            $userPostStat->liked = false;
            $post->stats->like -= 1;
        }
        $userPostStat->save();
        $post->stats->save();
        $this->emit('$refresh');
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
    }

    public function render()
    {
        return view('livewire.user-profile.comments', [
            'comments' => $this->post->postsToPost->sortByDesc('created_at')->take($this->loadAmount)
        ]);
    }
}
