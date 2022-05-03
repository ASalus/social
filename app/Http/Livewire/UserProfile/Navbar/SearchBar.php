<?php

namespace App\Http\Livewire\UserProfile\Navbar;

use App\Models\Post\Tag;
use App\Models\User;
use Livewire\Component;

class SearchBar extends Component
{
    public $search;
    public $users;
    public $tags;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        if (strlen($this->search) > 0) {
            $this->users = User::where('username', 'like', '%' . $this->search . '%')->orWhere('username', 'like', '%' . $this->search . '%')->with('userInfo')->limit(5)->get();
            $this->tags = Tag::where('tag', 'like', '%' . $this->search . '%')->limit(5)->get();
        }
    }

    public function render()
    {
        return view('livewire.user-profile.navbar.search-bar');
    }
}
