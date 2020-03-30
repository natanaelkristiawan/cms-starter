<?php

namespace Master\Upload\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Preview implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $action = config('image.size.sm.action', 'fit');
        $width = 300;
        $height = 250;

        $image->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        });
        

        if (!empty(config('image.size.sm.watermark'))) {
            $image->insert(config('image.size.sm.watermark'), 'center');
        }

        return $image;
    }
}
