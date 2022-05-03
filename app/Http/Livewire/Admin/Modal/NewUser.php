<?php

namespace App\Http\Livewire\Admin\Modal;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;

class NewUser extends ModalComponent
{

    public $selectedRole = 2;
    public $name;
    public $username;
    public $email;
    public $password;
    public $passwordConfirm;

    protected $rules = [
        'name' => 'required|min:3|max:25',
        'username' => 'required|min:3|max:25|alpha_dash|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'passwordConfirm' => 'required|same:password',
    ];

    protected $messages = [
        'name.required' => 'Name is missing',
        'username.required' => 'Username is missing',
        'email.required' => 'Email is missing',
        'password.required' => 'Password is missing',
        'passwordConfirm.required' => 'Confirm the password',
        'name.min' => 'The name is too big. It should be between 3 to 25 characters.',
        'name.max' => 'The name is too big. It should be between 3 to 25 characters.',
        'username.min' => 'The name is too big. It should be between 3 to 25 characters.',
        'username.max' => 'The name is too big. It should be between 3 to 25 characters.',
        'password.max' => 'The password should be at least 8 characters.',
        'username.alpha_dash' => 'No spaces allowed.',
        'password.alpha_dash' => 'No spaces allowed.',
        'passwordConfirm.same' => 'Passwords are not matching',
        'username.unique' => 'User with this username already exists.',
        'email.unique' => 'User with this email already exists.',
    ];

    public function save()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => $this->selectedRole,
        ]);

        $this->forceClose()->closeModal();
        $this->emit('refreshTable');
    }

    public function mount()
    {
        $this->roles = Role::all();
    }
    public function render()
    {
        return view('livewire.admin.modal.new-user');
    }
}
