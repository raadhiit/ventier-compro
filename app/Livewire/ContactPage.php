<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.public')]
class ContactPage extends Component
{
    public function render(): View
    {
        return view('livewire.pages.contact');
    }
}
