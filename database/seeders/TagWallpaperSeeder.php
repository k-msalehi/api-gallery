<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagWallpaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wp-tag_wallpaper')->insert([
            [
                'wallpaper_id' =>1,
                'tag_id' => 1,
            ],
            [
                'wallpaper_id' =>1,
                'tag_id' => 2,
            ],
            [
                'wallpaper_id' =>1,
                'tag_id' => 3,
            ],
            [
                'wallpaper_id' =>2,
                'tag_id' => 1,
            ],
            [
                'wallpaper_id' =>3,
                'tag_id' => 1,
            ],
            [
                'wallpaper_id' =>4,
                'tag_id' => 2,
            ],
            [
                'wallpaper_id' =>5,
                'tag_id' => 3,
            ],
        ]);
    }
}
