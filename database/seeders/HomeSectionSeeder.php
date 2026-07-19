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
                'title' => 'Furnitur Berkualitas untuk Kendaraan Anda',
                'subtitle' => 'Ventier menghadirkan produk interior premium dengan desain presisi, kenyamanan berkendara, dan kualitas terbaik untuk mobil kesayangan Anda.',
                'cta_label' => 'Lihat Produk',
                'cta_url' => '/products',
                'is_visible' => true,
                'sort_order' => 0,
            ],
            [
                'section_key' => 'featured_products',
                'title' => 'Produk Unggulan',
                'subtitle' => 'Koleksi produk terbaik pilihan untuk kendaraan Anda.',
                'settings' => ['limit' => 6],
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'section_key' => 'benefits',
                'title' => 'Kenapa Memilih Ventier?',
                'subtitle' => 'Kami berkomitmen memberikan produk terbaik untuk kenyamanan berkendara Anda.',
                'content' => '<p>Ventier menggunakan bahan berkualitas tinggi yang diproses dengan standar produksi ketat. Setiap produk dirancang khusus agar sesuai dengan interior kendaraan Anda.</p>',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'section_key' => 'about_preview',
                'title' => 'Tentang Ventier',
                'subtitle' => 'Pelajari lebih lanjut tentang perjalanan Ventier dalam menghadirkan produk terbaik.',
                'content' => '<p>Ventier adalah brand yang berfokus pada produk interior berkendara premium. Dengan pengalaman dan dedikasi tinggi, kami terus berinovasi untuk memberikan pengalaman berkendara yang lebih nyaman dan stylish.</p>',
                'cta_label' => 'Selengkapnya',
                'cta_url' => '/about',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'section_key' => 'latest_articles',
                'title' => 'Artikel Terbaru',
                'settings' => ['limit' => 3],
                'is_visible' => true,
                'sort_order' => 4,
            ],
            [
                'section_key' => 'cta',
                'title' => 'Hubungi Kami',
                'subtitle' => 'Punya pertanyaan atau butuh bantuan? Tim Ventier siap membantu Anda.',
                'cta_label' => 'Hubungi WhatsApp',
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
