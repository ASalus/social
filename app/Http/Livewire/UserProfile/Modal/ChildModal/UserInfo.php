<?php

namespace App\Http\Livewire\UserProfile\Modal\ChildModal;

use App\Models\Countries\City;
use App\Models\Countries\Country;
use App\Models\Countries\State;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Js;
use LivewireUI\Modal\ModalComponent;

class UserInfo extends ModalComponent
{
    public $user;
    public $country;
    public $countries;
    public $state;
    public $states = [];
    public $city;
    public $cities = [];
    public $education;
    public $occupation;
    public $location;
    public $about;

    protected $rules = [
        'location' => 'max:255',
        'education' => 'max:255',
        'occupation' => 'max:255',
    ];

    public function getArray($array, $value, $key)
    {
        if ($array) {
            foreach ($array as $element) {
                $result[$element[$key]] = $element[$value];
            }
            return $result;
        }
        return [];
    }

    public function selectCountry($id)
    {
        $this->country = Country::where('id', $id)->get(['id', 'name', 'iso2'])->first();
        $arrayState = State::where('country_id', $this->country->id)->get(['id', 'name'])->toArray();
        if($arrayState){
            $this->states = $this->getArray($arrayState, 'name', 'id');
        }
    }

    public function selectState($id)
    {
        $this->state = State::where('id', $id)->get(['id', 'name', 'iso2'])->first();
        $arrayCity = City::where('state_id', $this->state->id)->get(['id', 'name'])->toArray();
        if($arrayCity)
        {
            $this->cities = $this->getArray($arrayCity, 'name', 'id');
            // dd($this->cities);
        }
    }
    public function selectCity($id)
    {
        $this->city = City::where('id', $id)->get(['id', 'name'])->first();
    }

    public function save()
    {
        $this->validate();

        $this->user->userInfo->location = $this->location;
        $this->user->userInfo->education = $this->education;
        $this->user->userInfo->occupation = $this->occupation;
        $this->user->userInfo->about = $this->about;

        $this->user->userInfo->save();
        $this->forceClose()->closeModal();
        $this->emit('$refresh');
    }

    public function mount(Country $country)
    {
        $this->user = auth()->user();
        $this->fill([
            'occupation' => $this->user->userInfo->occupation,
            'education' => $this->user->userInfo->education,
            'location' => $this->user->userInfo->location,
            'about' => $this->user->userInfo->about,
            'countries' => $this->getArray($country->get(['id', 'name'])->toArray(), 'name', 'id'),
        ]);
    }

    public function render()
    {
        return view('livewire.user-profile.modal.child-modal.user-info', [

        ]);
    }
}
