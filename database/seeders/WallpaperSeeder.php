<?php

namespace Database\Seeders;

use App\Models\Wallpaper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WallpaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wallpaper::factory()->count(50)->create();
    }
}
