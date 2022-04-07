<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Post\PostStat;
use App\Models\Post\UserPostStat;
use App\Models\User;
use ArrayObject;
use EmptyIterator;
use Livewire\Component;

class UserPosts extends Component
{
    public $user;
    public $data;
    public $images;
    public $totalPosts;
    public $loadAmount = 5;
    public $likeCount;
    public $resendCount;
    public $commentsCount;

    protected $listeners = [
        'refreshPosts' => '$refresh',
    ];

    public function loadMore()
    {
        $this->loadAmount += 5;
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

    public function openPostModal(Post $post)
    {
        return $post->image != '{}'
            ? $this->emit('openModal', 'user-profile.modal.image-post-modal', ['post' => $post->id])
            : $this->emit('openModal', 'user-profile.modal.post-modal', ['post' => $post->id]);
    }

    public function mount(User $user)
    {
        $this->user = $user->load('userInfo');
        $this->totalPosts = $user->posts->count();
    }

    public function render()
    {
        return view('livewire.user-posts',[
            'posts' => $this->user->posts->where('to_post', false)->load('postsToPost', 'stats')->sortByDesc('created_at')->take($this->loadAmount)
        ]);
    }
}
