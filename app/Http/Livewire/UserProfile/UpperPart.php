<?php

namespace App\Http\Livewire\UserProfile;

use App\Models\UserFollower;
use Database\Factories\UserFactory;
use Livewire\Component;

class UpperPart extends Component
{

    public $user;
    public $data;
    public $followers;
    public $followed;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function follow()
    {
        UserFollower::create([
            "user_id" => $this->user->id,
            "follower_id" => auth()->user()->id
        ]);
        $this->emit('refresh');
    }

    public function unfollow()
    {
        // dd(auth()->user()->followed->where('user_id', $this->user->id)->where('follower_id', auth()->user()->id));
        UserFollower::where('user_id', $this->user->id)->where('follower_id', auth()->user()->id)->delete();
        $this->emit('refresh');
    }

    public function mount($data)
    {
        $this->user = $data;
    }

    public function render()
    {
        return view('livewire.user-profile.upper-part');
    }
}
