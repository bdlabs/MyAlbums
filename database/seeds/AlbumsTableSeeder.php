<?php

use Illuminate\Database\Seeder;
use App\Album;

/**
 * Class AlbumsTableSeeder
 */
class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Album::class, 2)->create()->each(
            function ($album) {
                $album->save();
            });
    }
}
