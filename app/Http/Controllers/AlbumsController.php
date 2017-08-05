<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Album;
use App\Http\Requests\AlbumsRequest;

/**
 * Class AlbumsController
 *
 * @package App\Http\Controllers
 */
class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $albums = Album::allAlbums()->orderBy('title', 'asc')->get();

        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('albums.create');
    }

    /**
     * @param AlbumsRequest $request
     *
     * @return RedirectResponse
     */
    public function store(AlbumsRequest $request): RedirectResponse
    {
        try {
            Album::create($request->all());
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['An album with such title already exists in database']);
        }

        return redirect()->route('album.index');
    }

    /**
     * @param Album $album
     *
     * @return View
     */
    public function show(Album $album): View
    {
        if ($album->id === null) {
            return view('albums.404');
        }

        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int     $id
     *
     * @return void
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Album $album
     *
     * @return Response
     * @internal param int $id
     */
    public function destroy(Album $album)
    {
        $album->photos()->detach();
        $album->delete();

        return redirect()->back();
    }
}
