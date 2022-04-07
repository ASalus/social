<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('userPages.profile', ['data' => $user]);
    }
}
