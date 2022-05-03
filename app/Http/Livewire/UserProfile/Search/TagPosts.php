<?php

namespace App\Http\Livewire\UserProfile\Search;

use App\Models\Post;
use App\Models\Post\UserPostStat;
use Livewire\Component;

class TagPosts extends Component
{
    public $tag;
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

    public function mount($value)
    {
        $this->tag = $value;
    }

    public function booted()
    {
        // dd($this->tag);
        if (str_starts_with($this->tag, '#')) {
            $this->postsA = Post::where('tags', 'like', '%"' . $this->tag . '"%')->get();
        } else {
            $this->postsA = Post::where('mentions', 'like', '%"' . $this->tag . '"%')->get();
        }
    }

    public function render()
    {
        return view('livewire.user-profile.search.tag-posts', [
            'posts' => $this->postsA->load('user', 'user.userInfo', 'postsToPost', 'stats', 'userPostStat')->sortByDesc('created_at')->take($this->loadAmount)
        ]);
    }
}
