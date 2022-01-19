<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWallpapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wp-wallpapers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('alt')->nullable()->default(null);
            $table->string('url', 1024);
            $table->foreignId('user_id')->constrained();
            $table->unsignedInteger('likes')->default(0);
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
        Schema::dropIfExists('wp-wallpepers');
    }
}
