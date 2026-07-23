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
            'footer_description' => 'Premium car mats designed for precise protection and interior comfort.',
            'default_seo_title' => 'Vantier — Premium Couture Carmat',
            'default_seo_description' => 'Vantier offers premium car mats with precise design, quality materials, and refined interior protection.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => 'string'],
            );
        }
    }
}
