<?php

namespace App\CustomHelpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper {

    public static function addImage($image) 
    {
        //change name and save image in public/gambar/             
        $ldate = date('Y-m-d_H_i_s');
        $imageName = $ldate.'_'.$image->getClientOriginalName();
        // $image->move(public_path('gambar'), $imageName);
        $image->storeAs('public/gambar',$imageName);

        return $imageName;
    }

    public static function deleteImage($image) 
    {                
        // $imagePath = public_path('gambar'."/".$image);
        // if (file_exists($imagePath)) {
        //     @unlink($imagePath);
        // }        

        if (Storage::exists('public/gambar/'.$image)) {
            Storage::delete('public/gambar/'.$image);
        }        
    }

    public static function changeImage($newImage, $oldImage)
    {
        // upload image if updated
        if ($newImage != null) {
            // upload new image
            $image = self::addImage($newImage);
            // delete old image
            self::deleteImage($oldImage);

            return $image;
        }
        else {
            return $oldImage;
        }
    }

}