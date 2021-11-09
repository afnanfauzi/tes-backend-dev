<?php

namespace App\CustomHelpers;

use Illuminate\Support\Facades\Storage;

class FileHelper {

    public static function addFile($file) 
    {
        //change name and save image in public/images/             
        $ldate = date('Y-m-d_H_i_s');
        $fileName = $ldate.'_'.$file->getClientOriginalName();
        // $file->move(public_path('files'), $fileName);
        $file->storeAs('public/files',$fileName);

        return $fileName;
    }

    public static function deleteFile($file) 
    {                
        // $filePath = public_path('files'."/".$file);        
        // if (file_exists($filePath)) {
        //     @unlink($filePath);
        // }        
        
        if (Storage::exists('public/files/'.$file)) {
            Storage::delete('public/files/'.$file);
        }        
    }

    public static function changeFile($newFile, $oldFile)
    {
        // upload image if updated
        if ($newFile != null) {
            // upload new image
            $file = self::addFile($newFile);
            // delete old image
            self::deleteFile($oldFile);

            return $file;
        }
        else {
            return $oldFile;
        }
    }

}