<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use App\Photo;  
use File;

class PhotoController extends Controller
{
    public function index()
    {   
        $photos = Photo::orderBy('id', 'DESC')->paginate(3);

        return view('photos.index', compact('photos'));
    }

    public function create()
    {
        return view('photos.create');
    }

    public function store(PhotoRequest $request)
    {
        $photo = new Photo();
        $image = $request->file('fImages');
        $filename = $image->getClientoriginalName();
        $photo->title = $request->txtTitle;
        $photo->image = $filename;
        $photo->save();

        $image->move('upload/images/', $filename);

        return redirect()
                ->route('photo.index')
                ->with([
                    'flash_level' => 'success',
                    'flash_message' => 'Success !! Complete Created New Photo'
                ]);
    }

    public function edit($id)
    {
        $photo = Photo::find($id);

        return view('photos.edit', compact('photo'));
    }

    public function update($id, Request $request)
    {
        $photo = Photo::find($id);

        $photo->title = $request->txtTitle;
        $image_current = 'upload/images/' .$photo->image;

        if (!empty($request->file('fImages'))) {

            $image = $request->file('fImages');
            $filename = $image->getClientOriginalName();

            $photo->image = $filename;
            $image->move('upload/images/', $filename);
            if (File::exists($image_current)) {
                File::delete($image_current);
            } 
        } else {
             echo "Not Exists File !";
        }
        $photo->save();

        return redirect()
                ->route('photo.index')
                ->with([
                    'flash_level' => 'success',
                    'flash_message' => 'Success !! Complete updated Photo'
                ]);
    }

    public function delete($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return redirect()
                ->route('photo.index')
                ->with([
                    'flash_level' => 'success',
                    'flash_message' => 'Success !! Complete Deleted Photo'
                ]);
    }
}
