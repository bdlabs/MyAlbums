<?php

use Illuminate\Database\Seeder;
use App\Album;
use App\Photo;

/**
 * Class PhotosTableSeeder
 */
class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $album = Album::find(1);
        $urls = [
            'https://static.pexels.com/photos/170811/pexels-photo-170811.jpeg',
            'https://static.pexels.com/photos/116675/pexels-photo-116675.jpeg',
        ];

        foreach ($urls as $url) {
            $photo = new Photo();
            $photo->url = $url;
            $photo->save();
            $album->photos()->attach($photo);
        }
    }
}
