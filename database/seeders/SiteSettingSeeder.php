<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'brand_name' => 'Vantier',
            'whatsapp_number' => '+6281234567890',
            'email' => 'hello@vantier.com',
            'footer_description' => 'Karpet mobil premium dengan desain presisi untuk perlindungan dan kenyamanan interior kendaraan.',
            'default_seo_title' => 'Vantier — Premium Couture Carmat',
            'default_seo_description' => 'Vantier menghadirkan karpet mobil premium dengan desain presisi, material berkualitas, dan perlindungan interior yang refined.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => 'string'],
            );
        }
    }
}
