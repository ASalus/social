<?php

namespace App\Http\Livewire\UserProfile\Navbar;

use App\Models\Post;
use Carbon\Carbon;
use Livewire\Component;

class PostsMention extends Component
{

    public $loadAmount = 3;

    protected $listeners = [
        'refreshPosts' => '$refresh',
    ];

    public function openPostModal(Post $post)
    {
        return $post->image != '{}'
            ? $this->emit('openModal', 'user-profile.modal.image-post-modal', ['post' => $post->id])
            : $this->emit('openModal', 'user-profile.modal.post-modal', ['post' => $post->id]);
    }

    public function dateFormat($date)
    {
        $date = new Carbon($date);
        return ($date->diff()->days < 1)
            ? $date->diffForHumans()
            : $date->format('d F Y');
    }

    public function booted()
    {
        $this->postsA = Post::where('mentions', 'like', '%"@' . auth()->user()->username . '"%')->where('created_at', '>', now()->subDays(1))->get();
    }

    public function mount($class)
    {
        $this->class = $class;
    }

    public function render()
    {
        return view('livewire.user-profile.navbar.posts-mention', [
            'posts' => $this->postsA->load('user', 'user.userInfo', 'postsToPost', 'stats')->sortByDesc('created_at')
        ]);
    }
}
