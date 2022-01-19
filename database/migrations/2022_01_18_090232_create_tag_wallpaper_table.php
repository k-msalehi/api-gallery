<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagWallpaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wp-tag_wallpaper', function (Blueprint $table) {
            $table->foreignId('wallpaper_id')->constrained('wp-wallpapers');
            $table->foreignId('tag_id')->constrained('wp-tags');
            $table->primary(['wallpaper_id','tag_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wp-tag_wallpaper');
    }
}
