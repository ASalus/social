<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserInfo;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $avatar = public_path() . '/images/placeholder.jpg';
        $background = public_path() . '/images/bg-placeholder.jpg';
        $path = 'images/users/' . $user->username;

        Storage::disk('public')->putFileAs($path, $avatar, 'avatar.jpg');
        Storage::disk('public')->putFileAs($path, $background, 'background.jpg');

        UserInfo::create([
            'user_id' => $user->id,
            'avatar' => $path . '/avatar.jpg',
            'background' => $path . '/background.jpg',
        ]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
