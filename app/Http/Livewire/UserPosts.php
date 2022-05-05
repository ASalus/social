<?php

namespace App\Http\Livewire;

use App\Models\User;
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
        'refreshPosts' => 'reloadPosts',
    ];

    public function reloadPosts()
    {
        $this->emit('$refresh');
    }

    public function loadMore()
    {
        $this->loadAmount += 5;
    }

    public function mount(User $user)
    {
        $this->user = $user->load('userInfo', 'userPostStat', 'userPostStat.post');
        $this->reposted = $user->userPostStat->map(function ($value) {
            return $value->post;
        });
        $this->totalPosts = $user->posts->count();
    }

    public function render()
    {
        return view('livewire.user-posts', [
            'posts' => $this->user->posts
                ->where('to_post', false)
                ->merge($this->reposted)
                ->load('postsToPost', 'stats', 'user', 'user.userInfo', 'userPostStat')
                ->sortByDesc('created_at')->take($this->loadAmount)
        ]);
    }
}
