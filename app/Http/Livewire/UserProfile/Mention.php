<?php

namespace App\Http\Livewire\UserProfile;

use App\Models\User;
use Livewire\Component;

class Mention extends Component
{
    public $mentionables;
    public $body;


    public function mount()
    {
        $this->mentionables = User::all()
            ->map(function ($user) {
                return [
                    'key' => $user->name,
                    'value' => $user->username,
                ];
            });
    }

    public function render()
    {
        return view('livewire.user-profile.mention');
    }
}
