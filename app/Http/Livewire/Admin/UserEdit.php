<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class UserEdit extends ModalComponent
{
    public $selectedRole;
    public function save()
    {
        $this->user->role_id = $this->selectedRole;
        $this->user->save();

        $this->forceClose()->closeModal();
        $this->emit('refreshTable');
    }

    public static function modalMaxWidth(): string
    {
        return 'roleModal';
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->selectedRole = $user->role_id;
        $this->roles = Role::all();
    }

    public function render()
    {
        return view('livewire.admin.user-edit');
    }
}
