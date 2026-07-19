<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.public')]
class ContactPage extends Component
{
    public function render()
    {
        return view('livewire.pages.contact');
    }
}
