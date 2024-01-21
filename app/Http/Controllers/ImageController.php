<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('file');

        if($file ){
            // create image manager with desired driver
            $manager = new ImageManager(new Driver());
            $nombreImagen = Str::uuid() . "." . $file->extension();
            $imageServer = $manager->read($file);
            $imageServer->cover(1000, 1000);
        }

        $imagePath = public_path('uploads') . "/" . $nombreImagen;

        $imageServer->save($imagePath);

        return response()->json(['image' => $nombreImagen]);
    }
}
