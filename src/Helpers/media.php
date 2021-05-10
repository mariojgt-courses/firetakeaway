<?php

namespace Mariojgt\Firetakeaway\Helpers;

use Illuminate\Http\Request;
use File;
use Image;

class media
{
    public function mediaUpload(Request $request, $folderName = "products_img")
    {
        // The folder where we will store the image
        $folderName = 'products_img/';
        // Create a path for the image
        $path  = public_path($folderName);
        // Create the path if empty
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        // Make the image name using slug so remove bad naming
        $fileName = str_replace(' ', '', $request->file->getClientOriginalName());
        // Move the raw temp file to the server folder
        $request->file->move($path, $fileName);

        // Move the temp file to the server folder
        $imageRawPath = $path . '/' . $fileName;
        // Call the resize function
        $img  = Image::make($imageRawPath)->orientate();
        // Resize the image
        $img->resize(
            400,
            300,
            function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            }
        );
        // Save the original file
        $img->save($imageRawPath);

        return $folderName . $fileName;
    }
}
