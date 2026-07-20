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
            'email' => 'hello@Vantier.com',
            'default_seo_title' => 'Vantier - Furnitur Premium untuk Kendaraan Anda',
            'default_seo_description' => 'Vantier menghadirkan produk interior berkendara premium dengan desain presisi dan kualitas terbaik.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => 'string'],
            );
        }
    }
}
