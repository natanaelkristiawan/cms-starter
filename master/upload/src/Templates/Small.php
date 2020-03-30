<?php

namespace Master\Upload\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Small implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $action = config('image.size.sm.action', 'fit');
        $width = (int)((40/100) * $image->width());
        $height = (int)((40/100) * $image->height());

        $dataFile =  explode('/', $image->mime());

        $format = 'jpg';

        if ($dataFile[1] == 'png') {
            $format = 'png';
        }

        if ($action == 'resize') {
            $image->resize($width, $height);
        } 
        else if ($action == 'compress') {
            $image->encode($format, 40);
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
