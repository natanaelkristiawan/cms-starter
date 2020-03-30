<?php

namespace Master\Upload\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Profile implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $action = config('image.size.sm.action', 'fit');
        $width = 400;
        $height = 400;
        if ($action == 'resize') {
            $image->resize($width, $height);
        } 
        else {
            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }

        if (!empty(config('image.size.sm.watermark'))) {
            $image->insert(config('image.size.sm.watermark'), 'center');
        }

        return $image;
    }
}
