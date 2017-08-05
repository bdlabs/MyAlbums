<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AlbumsHasPhotos
 */
class AlbumsHasPhotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'albums_has_photos', function (Blueprint $table) {
            $table->integer('album_id')->unsigned();
            $table->integer('photo_id')->unsigned();
        });

        Schema::table(
            'albums_has_photos', function (Blueprint $table) {
            $table->foreign('album_id')
                ->references('id')
                ->on('albums');
        });

        Schema::table(
            'albums_has_photos', function (Blueprint $table) {
            $table->foreign('photo_id')
                ->references('id')
                ->on('photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('albums_has_photos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
