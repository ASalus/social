<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:25',
            'username' => 'required|min:3|max:25|alpha_dash|unique:users,username',
            'email' => 'required|email|alpha_dash|unique:users,email',
            'password' => 'required|alpha_dash|min:8',
            'passwordConfirm' => 'required|password_confirmation',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
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
            'passwordConfirm.password_confirmation' => 'Passwords are not matching',
            'username.unique' => 'User with this username already exists.',
            'email.unique' => 'User with this email already exists.',
        ];
    }
}
