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
                'title' => 'Tentang Vantier',
                'subtitle' => 'Kami hadir untuk meningkatkan kenyamanan berkendara Anda dengan produk interior premium.',
                'is_visible' => true,
                'sort_order' => 0,
            ],
            [
                'page_key' => 'about',
                'section_key' => 'story',
                'title' => 'Cerita Kami',
                'content' => '<p>Vantier lahir dari keprihatinan terhadap kualitas produk interior kendaraan yang beredar di pasaran. Kami percaya bahwa setiap perjalanan layak dinikmati dengan kenyamanan maksimal.</p><p>Berawal dari tahun 2020, Vantier mulai merancang dan memproduksi berbagai aksesoris interior mobil dengan fokus pada kualitas bahan, presisi desain, dan kepuasan pelanggan.</p>',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'page_key' => 'about',
                'section_key' => 'values',
                'title' => 'Nilai-Nilai Kami',
                'content' => '<ul><li><strong>Kualitas Premium</strong> — Bahan terbaik dengan kontrol kualitas ketat di setiap tahap produksi.</li><li><strong>Desain Presisi</strong> — Setiap produk dirancang khusus untuk kendaraan Anda.</li><li><strong>Kenyamanan</strong> — Prioritas utama dalam setiap produk yang kami hasilkan.</li><li><strong>Pelayanan Terbaik</strong> — Kepuasan pelanggan adalah tujuan utama kami.</li></ul>',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'page_key' => 'about',
                'section_key' => 'advantages',
                'title' => 'Keunggulan Vantier',
                'content' => '<p>Kami menggunakan material premium yang tahan lama dan nyaman digunakan. Proses produksi kami mengedepankan detail dan akurasi tinggi. Setiap produk dilengkapi garansi kualitas untuk ketenangan Anda.</p>',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'page_key' => 'about',
                'section_key' => 'cta',
                'title' => 'Tertarik dengan produk kami?',
                'subtitle' => 'Jelajahi katalog produk Vantier dan temukan yang sesuai untuk kendaraan Anda.',
                'cta_label' => 'Lihat Produk',
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
