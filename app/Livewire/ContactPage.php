<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ContactPage extends Component
{
    public function render(): View
    {
        return view('livewire.pages.contact')
            ->layout(
                'layouts.public',
                [
                    'title' => 'Contact',
                    'description' => 'Contact our team for product information, fitment questions, and automotive car mat inquiries.',
                ],
            );
    }
}
