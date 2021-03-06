<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserController as UserUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('test', function () {
    return view('test');
})->name('test');


Route::group(
    [
        'prefix' => 'admin',
        'middleware' => 'is_admin',
        'as' => 'admin.',
    ],
    function () {

        Route::get('', function () {
            return view('adminPages.home');
        })->name('');

        Route::get('contacts', function () {
            return view('adminPages.contacts');
        })->name('contacts');

        Route::get('todo', function () {
            return view('adminPages.todo');
        })->name('todo');

        /* User Controller Routes */
        Route::controller(UserController::class)->prefix('users')->as('user.')->group(
            function () {
                Route::get('', 'index')->name('table');
                Route::get('{id}/edit', 'edit')->name('edit');
                Route::delete('{id}/delete', 'destroy')->name('delete');
            }
        );

        /* Post Controller Routes */
        Route::controller(PostController::class)->prefix('posts')->as('post.')->group(
            function () {
                Route::get('/', 'index')->name('table');
                Route::get('{id}/edit', 'edit')->name('edit');
                Route::delete('{id}/delete', 'destroy')->name('delete');
            }
        );

        /* Category Controller Routes */
        Route::controller(TagController::class)->prefix('tags')->as('tag.')->group(
            function () {
                Route::get('', 'index')->name('table');
                Route::get('{id}/edit', 'edit')->name('edit');
                Route::delete('{id}/delete', 'destroy')->name('delete');
            }
        );
    }
);


Route::controller(UserUserController::class)->prefix('users')->as('user.')->group(
    function () {
        Route::get('/{username}', 'profile')->name('profile');
    }
);


Route::group(
    [
        'prefix' => 'search',
        'as' => 'search.',
    ],
    function () {
        Route::get('/{value}', function ($value) {
            return view('userPages.search', [
                'value' => $value
            ]);
        })->name('tags');
    }
);
