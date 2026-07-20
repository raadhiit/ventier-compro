<?php

namespace App\Livewire;

use App\Models\HomeSection;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Home extends Component
{
    /** @var Collection<int, HomeSection> */
    public Collection $sections;

    public function mount(): void
    {
        $this->sections = HomeSection::query()
            ->where('is_visible', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.home')
            ->layout('layouts.public');
    }
}
