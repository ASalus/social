<?php

namespace App\Http\Livewire\UserProfile\Modal;

use App\Models\User;
use App\Models\UserFollower;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class FollowUsers extends ModalComponent
{

    public function follow(User $user)
    {
        UserFollower::create([
            "user_id" => $user->id,
            "follower_id" => auth()->user()->id
        ]);
        // $this->emit('refresh');
    }

    public function unfollow(User $user)
    {
        // dd(auth()->user()->followed->where('user_id', $this->user->id)->where('follower_id', auth()->user()->id));
        UserFollower::where('user_id', $user->id)->where('follower_id', auth()->user()->id)->delete();
        // $this->emit('refresh');
    }

    public function mount(User $user, $trigger)
    {
        $this->user = $user->load('userInfo', 'followed', 'followers');
        $this->trigger = $trigger;
    }

    public function render()
    {
        return view('livewire.user-profile.modal.follow-users');
    }
}
