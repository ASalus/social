<?php

namespace App\Http\Livewire\UserProfile;

use Livewire\Component;

class About extends Component
{

    public function mount($data)
    {
        $this->data = $data;
    }
    public function render()
    {
        return view('livewire.user-profile.about');
    }
}
