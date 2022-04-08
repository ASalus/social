<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Post\PostStat;
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

    public $postText;
    public $tags = [];
    // public $category;
    public $imageInput = [];
    public $avatar;
    public $isDisabled = true;
    public $images = [];
    public $data;

    protected $rules = [
        'postText' => 'required|min:1|max:255',
        'imageInput.*' => 'image|max:1024',
    ];

    protected $listeners = [
        'refreshPosts' => '$refresh',
    ];

    protected $messages = [
        'postText.required' => 'The post cannot be empty.',
        'postText.min' => 'To short.',
        'postText.max' => 'To big.',
    ];

    public function store()
    {
        $this->validate();

        $i = 1;
        $filenames= new ArrayObject();
        $last_id = 0;
        if(DB::table('posts')->count() !== 0){
            $last_id = DB::table('posts')->latest('id')->first()->id;
        }
        foreach ($this->images as $image) {
            $path = 'images/users/'.auth()->user()->username.'/posts/'. $last_id+1;
            $filenames->append($path.'/'. $i. '.jpg');
            //dd(json_encode($filenames));
            $image->storeAs(
                'public/'.$path,
                $i.'.jpg'
            );
            $i +=1;
        }

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'full_text' => $this->postText,
            'image' => json_encode($filenames),
        ]);

        PostStat::create([
            'post_id' => $post->id,
        ]);

        $this->reset('postText');
        $this->emit('refreshPosts', $post);
    }

    public function mount($data)
    {

        $this->avatar = $data->userInfo->avatar;
        $this->mentionables = User::all()->load('userInfo')
            ->map(function ($user) {
                return [
                    'key' => $user->username,
                    'value' => $user->name,
                    'image' => $user->userInfo->avatar
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

    public function addTag($tag)
    {
        $this->tags = array_push($this->tags, $tag);
    }

    public function render()
    {
        return view('livewire.new-post');
    }

}
