<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('products')
            ->orderBy('id')
            ->select(['id', 'features', 'specifications'])
            ->chunkById(100, function ($products): void {
                foreach ($products as $product) {
                    $features = json_decode((string) $product->features, true);
                    $specifications = json_decode((string) $product->specifications, true);

                    DB::table('products')
                        ->where('id', $product->id)
                        ->update([
                            'features' => json_encode(is_array($features) ? array_values($features) : [], JSON_THROW_ON_ERROR),
                            'specifications' => json_encode(is_array($specifications) ? $specifications : [], JSON_THROW_ON_ERROR),
                        ]);
                }
            });
    }

    public function down(): void {}
};
