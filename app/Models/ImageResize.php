<?php

namespace App\Models;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageResize extends Model
{
    use HasFactory, SoftDeletes;

    // Functions ...
    public static function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    public static function getFileImageSize($imagePath) {
        $info = getimagesize($imagePath); 
        if ($info === false) {
            return false;
        }
        $width = $info[0]; 
        $height = $info[1];
        return [
            'width' => $width,
            'height' => $height,
        ];
    }
    
}
