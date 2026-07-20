<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $subject = '';

    public string $message = '';

    public string $website = '';

    public bool $sent = false;

    public function submit(): void
    {
        if ($this->website !== '') {
            return;
        }

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::create([
            ...$validated,
            'status' => 'new',
            'source_page' => request()->path(),
            'ip_address' => request()->ip(),
        ]);

        $this->reset(['name', 'phone', 'email', 'subject', 'message', 'website']);
        $this->sent = true;
    }

    public function render(): View
    {
        return view('livewire.contact-form');
    }
}
