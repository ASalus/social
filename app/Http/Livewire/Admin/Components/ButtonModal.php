<?php

namespace App\Http\Livewire\Admin\Components;

use Livewire\Component;

class ButtonModal extends Component
{

    public function mount($modal)
    {
        $this->modal = $modal;
    }

    public function render()
    {
        return view('livewire.admin.components.button-modal');
    }
}
