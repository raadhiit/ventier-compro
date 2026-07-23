<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('home_sections')
            ->where('section_key', 'latest_articles')
            ->delete();

        DB::table('page_contents')
            ->where('page_key', 'contact')
            ->delete();

        DB::table('page_contents')
            ->whereNotNull('settings')
            ->orderBy('id')
            ->select(['id', 'settings'])
            ->chunkById(100, function ($sections): void {
                foreach ($sections as $section) {
                    $settings = json_decode((string) $section->settings, true);

                    if (! is_array($settings) || ! array_key_exists('items', $settings)) {
                        continue;
                    }

                    unset($settings['items']);

                    DB::table('page_contents')
                        ->where('id', $section->id)
                        ->update([
                            'settings' => $settings === []
                                ? null
                                : json_encode($settings, JSON_THROW_ON_ERROR),
                        ]);
                }
            });
    }

    public function down(): void {}
};
