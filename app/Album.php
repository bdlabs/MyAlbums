<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Album extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
    ];

    /**
     * @return int
     */
    public function qtyPhotos(): int
    {
        $qty = $this->belongsToMany('App\Photo', 'albums_has_photos')->count();

        return $qty;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function photos(): BelongsToMany
    {
        return $this->belongsToMany('App\Photo', 'albums_has_photos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static public function allAlbums(): Builder
    {
        return Album::selectRaw('albums.*, COUNT(ahp.album_id) as `qty`')
            ->leftJoin(
                'albums_has_photos as ahp', function ($q) {
                $q->on('ahp.album_id', '=', 'albums.id');
            })
            ->groupBy('ahp.album_id');
    }
}
