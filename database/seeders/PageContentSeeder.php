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
                'page_key' => 'about',
                'section_key' => 'hero',
                'title' => 'About Vantier',
                'subtitle' => 'We enhance driving comfort through premium automotive interior products.',
                'is_visible' => true,
                'sort_order' => 0,
            ],
            [
                'page_key' => 'about',
                'section_key' => 'story',
                'title' => 'Our Story',
                'content' => '<p>Vantier began with a commitment to improve the quality of automotive interior products. We believe every journey deserves exceptional comfort.</p><p>Since 2020, Vantier has designed and produced automotive interior accessories focused on material quality, precise design, and customer satisfaction.</p>',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'page_key' => 'about',
                'section_key' => 'values',
                'title' => 'Our Values',
                'content' => '<ul><li><strong>Premium Quality</strong> — Carefully selected materials with strict quality control at every production stage.</li><li><strong>Precise Design</strong> — Every product is designed for your vehicle.</li><li><strong>Comfort</strong> — A priority in every product we create.</li><li><strong>Excellent Service</strong> — Customer satisfaction remains our primary goal.</li></ul>',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'page_key' => 'about',
                'section_key' => 'advantages',
                'title' => 'The Vantier Advantage',
                'content' => '<p>We use durable, comfortable premium materials. Our production process prioritizes detail and precision. Every product includes a quality guarantee for added confidence.</p>',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'page_key' => 'about',
                'section_key' => 'cta',
                'title' => 'Interested in Our Products?',
                'subtitle' => 'Explore the Vantier catalog and find the right product for your vehicle.',
                'cta_label' => 'View Products',
                'cta_url' => '/products',
                'is_visible' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($sections as $section) {
            PageContent::updateOrCreate(
                [
                    'page_key' => $section['page_key'],
                    'section_key' => $section['section_key'],
                ],
                $section,
            );
        }
    }
}
