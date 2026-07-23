<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::query()->updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'role' => User::ROLE_SUPER_ADMIN,
                'is_active' => true,
            ],
        );

        $this->call([
            SiteSettingSeeder::class,
            HomeSectionSeeder::class,
            PageContentSeeder::class,
        ]);
    }
}
