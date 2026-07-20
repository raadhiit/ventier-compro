<?php

namespace App\Livewire;

use App\Models\PageContent;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.public')]
class AboutPage extends Component
{
    /** @var Collection<int, PageContent> */
    public Collection $sections;

    public function mount(): void
    {
        $this->sections = PageContent::query()
            ->where('page_key', 'about')
            ->where('is_visible', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.pages.about');
    }
}
