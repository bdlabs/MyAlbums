<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PhotosRequest;
use App\Http\Services\Albums\ImageSaver;
use App\Photo;

/**
 * Class PhotosController
 *
 * @package App\Http\Controllers
 */
class PhotosController extends Controller
{
    /**
     * @param PhotosRequest $request
     *
     * @return RedirectResponse
     */
    public function store(PhotosRequest $request): RedirectResponse
    {
        try {
            $imageSaver = new ImageSaver();
            $imageSaver->save($request->all());
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['This image is already added to this album']);
        }

        return redirect()->back();
    }

    /**
     * @param Photo $photo
     *
     * @return View
     * @internal param int $id
     */
    public function show(Photo $photo): View
    {
        if ($photo->id === null) {
            return view('photos.404');
        }

        return view('photos.show', compact('photo'));
    }
}
