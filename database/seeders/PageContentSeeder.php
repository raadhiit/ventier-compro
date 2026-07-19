<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'page_key' => PageContent::PAGE_ABOUT,
                'section_key' => 'hero',
                'title' => 'Designed for Every Journey',
                'subtitle' => 'Premium automotive carpets designed to protect your vehicle while elevating every drive.',
                'content' => null,
                'cta_label' => null,
                'cta_url' => null,
                'settings' => null,
                'is_visible' => true,
                'sort_order' => 10,
            ],
            [
                'page_key' => PageContent::PAGE_ABOUT,
                'section_key' => 'story',
                'title' => 'The Vantier Story',
                'subtitle' => 'Protection, comfort, and craftsmanship in every detail.',
                'content' => '<p>Vantier was built from a simple belief: vehicle protection should never compromise design. We create automotive carpets that combine precise fit, durable materials, and a premium appearance for everyday journeys.</p>',
                'cta_label' => null,
                'cta_url' => null,
                'settings' => null,
                'is_visible' => true,
                'sort_order' => 20,
            ],
            [
                'page_key' => PageContent::PAGE_ABOUT,
                'section_key' => 'values',
                'title' => 'Our Values',
                'subtitle' => 'The principles behind every Vantier product.',
                'content' => null,
                'cta_label' => null,
                'cta_url' => null,
                'settings' => [
                    'items' => [
                        [
                            'title' => 'Precision',
                            'description' => 'Every product is designed for an accurate and secure fit.',
                            'image_path' => null,
                        ],
                        [
                            'title' => 'Quality',
                            'description' => 'Materials are selected for durability, comfort, and daily use.',
                            'image_path' => null,
                        ],
                        [
                            'title' => 'Practical Design',
                            'description' => 'Products are easy to use, easy to maintain, and built for real journeys.',
                            'image_path' => null,
                        ],
                    ],
                ],
                'is_visible' => true,
                'sort_order' => 30,
            ],
            [
                'page_key' => PageContent::PAGE_ABOUT,
                'section_key' => 'advantages',
                'title' => 'Why Choose Vantier',
                'subtitle' => 'Built to protect more than just your vehicle floor.',
                'content' => null,
                'cta_label' => null,
                'cta_url' => null,
                'settings' => [
                    'items' => [
                        [
                            'title' => 'Vehicle-Specific Fit',
                            'description' => 'Designed according to the shape and dimensions of supported vehicle models.',
                            'image_path' => null,
                        ],
                        [
                            'title' => 'Durable Protection',
                            'description' => 'Helps protect the vehicle interior from dirt, spills, and daily wear.',
                            'image_path' => null,
                        ],
                        [
                            'title' => 'Premium Appearance',
                            'description' => 'Clean visual details that complement the vehicle interior.',
                            'image_path' => null,
                        ],
                    ],
                ],
                'is_visible' => true,
                'sort_order' => 40,
            ],
            [
                'page_key' => PageContent::PAGE_ABOUT,
                'section_key' => 'cta',
                'title' => 'Find the Right Carpet for Your Vehicle',
                'subtitle' => 'Explore the Vantier product collection and discover the right fit for your journey.',
                'content' => null,
                'cta_label' => 'Explore Products',
                'cta_url' => '/products',
                'settings' => null,
                'is_visible' => true,
                'sort_order' => 50,
            ],
            [
                'page_key' => PageContent::PAGE_CONTACT,
                'section_key' => 'hero',
                'title' => 'Get in Touch',
                'subtitle' => 'Questions about product compatibility or availability? Our team is ready to help.',
                'content' => null,
                'cta_label' => null,
                'cta_url' => null,
                'settings' => null,
                'is_visible' => true,
                'sort_order' => 10,
            ],
            [
                'page_key' => PageContent::PAGE_CONTACT,
                'section_key' => 'intro',
                'title' => 'Let Us Help You',
                'subtitle' => 'Contact Vantier through WhatsApp, email, or the contact form.',
                'content' => '<p>Provide your vehicle brand, model, variant, and production year so our team can help identify the most suitable product.</p>',
                'cta_label' => null,
                'cta_url' => null,
                'settings' => null,
                'is_visible' => true,
                'sort_order' => 20,
            ],
        ];

        foreach ($sections as $section) {
            PageContent::query()->firstOrCreate(
                [
                    'page_key' => $section['page_key'],
                    'section_key' => $section['section_key'],
                ],
                $section,
            );
        }
    }
}