<?php

namespace App\Livewire;

use App\Models\HomeSection;
use Livewire\Component;

class Home extends Component
{
    public $sections;

    public function mount(): void
    {
        $this->sections = HomeSection::query()
            ->where('is_visible', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function render()
    {
        return view('livewire.home')
            ->layout('layouts.public');
    }
}
