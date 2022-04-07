<?php

namespace App\Http\Livewire\UserProfile\Modal;

use App\Models\Post;
use LivewireUI\Modal\ModalComponent;

class PostModal extends ModalComponent
{

    public $post;

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.user-profile.modal.post-modal');
    }
}
