<?php

namespace App\Livewire;

use App\Models\HomeSection;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Home extends Component
{
    /** @var Collection<int, array{section: HomeSection, view: non-falsy-string, data: array<string, mixed>}> */
    public Collection $sections;

    public function mount(): void
    {
        $visibleSections = HomeSection::query()
            ->where('is_visible', true)
            ->orderBy('sort_order')
            ->get();

        /** @var Collection<int, array{section: HomeSection, view: non-falsy-string, data: array<string, mixed>}> $sections */
        $sections = $visibleSections
            ->map(function (HomeSection $section): ?array {
                if (! array_key_exists($section->section_key, HomeSection::publicViews())) {
                    return null;
                }

                $view = HomeSection::publicViews()[$section->section_key];

                return [
                    'section' => $section,
                    'view' => $view,
                    'data' => $this->sectionData($section),
                ];
            })
            ->filter()
            ->values();

        $this->sections = $sections;
    }

    /** @return array<string, mixed> */
    private function sectionData(HomeSection $section): array
    {
        $limit = (int) data_get($section->settings, 'limit', 4);

        return match ($section->section_key) {
            HomeSection::FEATURED_PRODUCTS => [
                'categories' => ProductCategory::query()
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->limit($limit)
                    ->get(),
            ],
            default => [],
        };
    }

    public function render(): View
    {
        return view('livewire.home')
            ->layout(
                'layouts.public',
                [
                    'title' => 'Home',
                    'description' => 'Discover premium automotive car mats made for refined protection, precise fit, and easy product inquiry.',
                ],
            );
    }
}
