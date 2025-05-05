<?php

namespace App\Traits\Traits;

trait Media
{
    
    public function UploadPhoto($photo,$path){
         $photoName = uniqid() . '.' . $photo->extension();
         $photo->move(public_path($path),$photoName);
         return url("/$path") .'/' . $photoName;
    }


    public function deletePhoto($image){
        $image_path =str_replace(url('/'),public_path(),$image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
   }

}
