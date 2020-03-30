<?php

namespace Master\Upload\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Mobile implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $width = 480;
        $height = 641;

        $image->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        });
        
        return $image;
    }
}
