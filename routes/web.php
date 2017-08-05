<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::model(
    'album', 'App\Album',
    function () {
        return new \App\Album;
    }
);

Route::model(
    'photo', 'App\Photo',
    function () {
        return new \App\Photo;
    }
);

Route::group(
    [
        'middleware' => 'album.sanitizer',
    ],
    function () {
        Route::post(
            '/albums',
            [
                'uses' => 'AlbumsController@store',
                'as'   => 'album.store',
            ]
        );
    }
);

Route::group(
    [
        'middleware' => 'photo.sanitizer',
    ],
    function () {
        Route::post(
            '/photos',
            [
                'uses' => 'PhotosController@store',
                'as'   => 'photos.store',
            ]
        );
    }
);

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Route::get(
    '/albums',
    [
        'uses' => 'AlbumsController@index',
        'as'   => 'album.index',
    ]
);

Route::get(
    '/albums/create',
    [
        'uses' => 'AlbumsController@create',
        'as'   => 'album.create',
    ]
);

Route::get(
    '/albums/{album}',
    [
        'uses' => 'AlbumsController@show',
        'as'   => 'album.show',
    ]
);

Route::delete(
    '/albums/{album}',
    [
        'uses' => 'AlbumsController@destroy',
        'as'   => 'album.destroy',
    ]
);

Route::get(
    '/photos/{photo}',
    [
        'uses' => 'PhotosController@show',
        'as'   => 'photos.show',
    ]
);
