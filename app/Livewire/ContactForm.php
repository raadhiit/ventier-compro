<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\RateLimiter;
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

    private function rateLimitKey(): string
    {
        return 'contact-form:'.request()->ip();
    }

    public function submit(): void
    {
        if ($this->website !== '') {
            return;
        }

        if (RateLimiter::tooManyAttempts($this->rateLimitKey(), 5)) {
            $this->addError('form', 'Too many attempts. Please wait a minute and try again.');

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

        RateLimiter::hit($this->rateLimitKey(), 60);

        $this->reset(['name', 'phone', 'email', 'subject', 'message', 'website']);
        $this->sent = true;
    }

    public function render(): View
    {
        return view('livewire.contact-form');
    }
}
