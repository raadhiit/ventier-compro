<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.public')]
class AboutPage extends Component
{
    public $sections;

    public function mount(): void
    {
        $this->sections = \App\Models\PageContent::where('page_key', 'about')
            ->where('is_visible', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.about');
    }
}
