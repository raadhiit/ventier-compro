<?php

namespace Database\Seeders;

use App\Models\HomeSection;
use Illuminate\Database\Seeder;

class HomeSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'section_key' => 'hero',
                'title' => 'Indonesia’s First Double Layer Carmat',
                'subtitle' => 'Vantier offers premium interior products with precise design, driving comfort, and exceptional quality.',
                'cta_label' => 'View Products',
                'cta_url' => '/products',
                'is_visible' => true,
                'sort_order' => 0,
            ],
            [
                'section_key' => 'featured_products',
                'title' => 'Featured Products',
                'subtitle' => 'A curated selection of premium products for your vehicle.',
                'settings' => ['limit' => 6],
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'section_key' => 'benefits',
                'title' => 'Why Choose Vantier?',
                'subtitle' => 'We deliver premium products designed for greater driving comfort.',
                'content' => '<p>Vantier uses high-quality materials made under strict production standards. Every product is designed to complement your vehicle’s interior.</p>',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'section_key' => 'about_preview',
                'title' => 'About Vantier',
                'subtitle' => 'Learn how Vantier creates premium automotive interior products.',
                'content' => '<p>Vantier is a brand focused on premium automotive interior products. Through experience, dedication, and continuous innovation, we create a more comfortable and refined driving experience.</p>',
                'cta_label' => 'Learn More',
                'cta_url' => '/about',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'section_key' => 'latest_articles',
                'title' => 'Latest Articles',
                'settings' => ['limit' => 3],
                'is_visible' => true,
                'sort_order' => 4,
            ],
            [
                'section_key' => 'cta',
                'title' => 'Contact Us',
                'subtitle' => 'Have a question or need assistance? The Vantier team is ready to help.',
                'cta_label' => 'Contact Us on WhatsApp',
                'cta_url' => 'https://wa.me/6281234567890',
                'is_visible' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($sections as $section) {
            HomeSection::updateOrCreate(
                ['section_key' => $section['section_key']],
                $section,
            );
        }
    }
}
