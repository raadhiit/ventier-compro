<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'brand_name' => 'Ventier',
            'whatsapp_number' => '+6281234567890',
            'email' => 'hello@ventier.com',
            'default_seo_title' => 'Ventier - Furnitur Premium untuk Kendaraan Anda',
            'default_seo_description' => 'Ventier menghadirkan produk interior berkendara premium dengan desain presisi dan kualitas terbaik.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => 'string'],
            );
        }
    }
}
