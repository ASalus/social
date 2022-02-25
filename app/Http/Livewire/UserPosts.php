<?php

namespace App\Http\Livewire;

use App\Models\User;
use ArrayObject;
use Livewire\Component;

class UserPosts extends Component
{
    public $user;
    public $data;
    public $images;

    protected $listeners = [
        'refreshPosts' => '$refresh',
    ];

    public function mount($data){
        $this->user = $data;
    }

    public function render()
    {
        return view('livewire.user-posts');
    }
}
