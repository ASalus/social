<?php

namespace App\Http\Livewire\UserProfile\Modal;

use App\Models\Post;
use LivewireUI\Modal\ModalComponent;

class ImagePostModal extends ModalComponent
{
    public $post;

    public static function modalMaxWidth(): string
    {
        return 'full';
    }

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.user-profile.modal.image-post-modal');
    }
}
