<?php

namespace App\Http\Livewire\Userprofile\Modal;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;


class EditProfile extends ModalComponent
{
    use WithFileUploads;

    public $image;
    public $background;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function save()
    {
        $this->validate([
            'image' => 'max:1024',
            'background' => 'max:1024',
        ]);

        if ($this->background) {

            $path = 'images/users/' . auth()->user()->username;
            $filenameBg = $path . '/background.jpg';
            //dd(json_encode($filenames));
            $this->background->storeAs(
                $path,
                'background.jpg',
                'public'
            );
            $this->user->userInfo->background = $filenameBg;
            $this->user->userInfo->save();
        }
        if ($this->image) {

            $path = 'images/users/' . auth()->user()->username;
            $filenameAvatar = $path . '/avatar.jpg';
            //dd(json_encode($filenames));
            $this->image->storeAs(
                $path,
                'avatar.jpg',
                'public'
            );

            $this->user->userInfo->avatar = $filenameAvatar;
            $this->user->userInfo->save();
        }

        $this->emit("openModal", "user-profile.modal.child-modal.user-info");
    }


    public function render()
    {
        return view('livewire.userprofile.modal.edit-profile');
    }
}
