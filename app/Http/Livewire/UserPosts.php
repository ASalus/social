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
        'refreshPosts' => 'render',
    ];

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
