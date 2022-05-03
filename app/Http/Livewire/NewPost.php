<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Post\PostStat;
use App\Models\Post\Tag;
use App\Models\User;
use ArrayObject;
use Dotenv\Parser\Value;
use GuzzleHttp\Psr7\AppendStream;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewPost extends Component
{
    use WithFileUploads;

    public $postText = '';
    public $postTags = [];
    public $mentions = [];
    public $imageInput = [];
    public $avatar;
    public $isDisabled = true;
    public $images = [];
    public $data;

    protected $rules = [
        'imageInput.*' => 'image|max:1024',
    ];

    protected $listeners = [
        'refreshPosts' => '$refresh',
    ];

    protected $messages = [
        'postText.required' => 'The post cannot be empty.',
    ];

    public function store()
    {
        $this->validate();

        $i = 1;
        $filenames = new ArrayObject();
        $last_id = 0;
        if (DB::table('posts')->count() !== 0) {
            $last_id = DB::table('posts')->latest('id')->first()->id;
        }
        foreach ($this->images as $image) {
            $path = 'images/users/' . auth()->user()->username . '/posts/' . $last_id + 1;
            $filenames->append($path . '/' . $i . '.jpg');
            //dd(json_encode($filenames));
            $image->storeAs(
                'public/' . $path,
                $i . '.jpg'
            );
            $i += 1;
        }
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'full_text' => $this->postText,
            'image' => json_encode($filenames),
            'mentions' => json_encode((object) $this->mentions),
            'tags' => json_encode((object) $this->postTags)
        ]);

        PostStat::create([
            'post_id' => $post->id,
        ]);

        foreach ($this->postTags as $tag) {
            Tag::firstOrCreate([
                'tag' => $tag,
            ]);
        }

        $this->reset('postText', 'images', 'imageInput');
        $this->emit('refreshPosts', $post);
    }

    public function mount()
    {

        $this->avatar = auth()->user()->userInfo->avatar;
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

    public function deleteImage($id)
    {
        array_splice($this->images, $id, 1);
    }

    public function updatedImageInput()
    {
        foreach ($this->imageInput as $image) {
            array_push($this->images, $image);
        }
    }

    public function render()
    {
        return view('livewire.new-post');
    }
}
