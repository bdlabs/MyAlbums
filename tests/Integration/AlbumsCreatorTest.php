<?php

namespace Tests\Integration;

use App\Album;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class AlbumsCreatorTest extends TestCase
{
    /**
     * @dataProvider addNewAlbumsProvider
     *
     * @param string $title
     *
     * @return void
     */
    public function testAddNewAlbumsTest(string $title)
    {
        Session::start();

        $response = $this->call(
            'POST',
            '/albums',
            [
                '_token' => Session::token(),
                'title'  => $title,
            ],
            [],
            [],
            ['content' => 'content']);

        $response->assertStatus(302);

        /*$album = Album::where("url", "like", $title)->first();

        $album*/
    }

    /**
     * @dataProvider addNewImagesForAlbumProvider
     *
     * @param string $imageUrl
     * @param string $albumTitle
     *
     * @return void
     */
    public function testAddNewImagesForAlbumTest(string $imageUrl, string $albumTitle)
    {
        Session::start();

        $album = Album::where("title", "like", $albumTitle)->first();

        $response = $this->call(
            'POST',
            '/photos',
            [
                '_token'   => Session::token(),
                'album_id' => $album->id,
                'url'      => $imageUrl,
            ],
            [],
            [],
            ['content' => 'content']);

        $response->assertStatus(302);
    }

    /**
     * @dataProvider albumsHasPhotosCheckTestProvider
     *
     * @param string $albumTitle
     * @param int    $qtyPhotos
     *
     * @return void
     */
    public function testAlbumsHasPhotosCheckTest(string $albumTitle, int $qtyPhotos)
    {
        $album = Album::allAlbums()->where('title', 'like', $albumTitle)->first();
        $this->assertEquals($qtyPhotos, $album->qty);
    }

    /**
     * @dataProvider addNewAlbumsProvider
     *
     * @param string $albumTitle
     */
    public function testDeleteAlbumTest(string $albumTitle)
    {
        $album = Album::allAlbums()->where('title', 'like', $albumTitle)->first();
        $response = $this->call(
            'DELETE',
            '/albums/'.$album->id,
            [
                '_token'   => Session::token(),
            ],
            [],
            [],
            ['content' => 'content']);

        $response->assertStatus(302);
    }

    /**
     * @return array
     */
    public function addNewAlbumsProvider(): array
    {
        return [
            ['AlbumName_1'],
            ['AlbumName_2'],
            ['AlbumName_3'],
        ];
    }

    /**
     * @return array
     */
    public function addNewImagesForAlbumProvider(): array
    {
        return [
            ['https://assets.servedby-buysellads.com/p/manage/asset/id/32052', 'AlbumName_1'],
            ['https://www.gravatar.com/avatar/98309adc484ca1b434cc4f02157ad9be?s=100', 'AlbumName_1'],
            ['https://blog.mwaysolutions.com/wp-content/themes/mwayblog/img/logo.png', 'AlbumName_1'],
            ['https://assets.servedby-buysellads.com/p/manage/asset/id/32052', 'AlbumName_2'],
            ['https://www.gravatar.com/avatar/98309adc484ca1b434cc4f02157ad9be?s=100', 'AlbumName_2'],
            ['https://blog.mwaysolutions.com/wp-content/themes/mwayblog/img/logo.png', 'AlbumName_3'],
        ];
    }

    /**
     * @return array
     */
    public function albumsHasPhotosCheckTestProvider(): array
    {
        return [
            ['AlbumName_1', 3],
            ['AlbumName_2', 2],
            ['AlbumName_3', 1],
        ];
    }
}
