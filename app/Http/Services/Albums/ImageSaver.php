<?php

namespace App\Http\Services\Albums;

use Illuminate\Database\QueryException;
use App\Album;
use App\Photo;

/**
 * Class ImageSaver
 *
 * @package App\Http\Services\Albums
 */
class ImageSaver
{
    /**
     * @param array $requestData
     *
     * @return void
     * @throws
     */
    public function save(array $requestData)
    {
        $album = Album::find($requestData['album_id']);
        $photo = $this->getPhoto($requestData);
        try {
            $album->photos()->attach($photo);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    /**
     * @param array $requestData
     *
     * @return Photo
     */
    private function getPhoto(array $requestData): Photo
    {
        try {
            //$photo = Photo::crate($requestData);
            $photo = new Photo();
            $photo->url = $requestData['url'];
            $photo->save();
        } catch (QueryException $e) {
            $photo = Photo::where("url", "like", $requestData['url'])->first();
        }

        return $photo;
    }
}
