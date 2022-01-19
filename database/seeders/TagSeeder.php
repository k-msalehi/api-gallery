<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wp-tags')->insert([
            [
                'title' => 'طبیعت',
                'slug' => 'nature',
            ],
            [
                'title' => 'آیفون',
                'slug' => 'iphone',
            ],
            [
                'title' => 'کهکشان',
                'slug' => 'galaxy',
            ],
            [
                'title' => 'موبایل',
                'slug' => 'mobile',
            ],
            [
                'title' => 'کامپیوتر',
                'slug' => 'computer',
            ],
        ]);
    }
}
