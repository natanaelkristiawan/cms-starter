<?php

namespace Master\Upload\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Large implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $action = config('image.size.lg.action', 'fit');
        $width = (int)((80/100) * $image->width());
        $height = (int)((80/100) * $image->height());

        $dataFile =  explode('/', $image->mime());

        $format = 'jpg';

        if ($dataFile[1] == 'png') {
            $format = 'png';
        }

        if ($action == 'resize') {
            $image->resize($width, $height);
        }  
        else if ($action == 'compress') {
            $image->encode($format, 80);
        }
        else {
            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }

        if (!empty(config('image.size.lg.watermark'))) {
            $image->insert(config('image.size.lg.watermark'), 'center');
        }

        return $image;
    }
}
