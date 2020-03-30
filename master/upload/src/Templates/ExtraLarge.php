<?php

namespace Master\Upload\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class ExtraLarge implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $action = config('image.size.xl.action', 'fit');
        $width = $image->width();
        $height = $image->height();

        $dataFile =  explode('/', $image->mime());

        $format = 'jpg';

        if ($dataFile[1] == 'png') {
            $format = 'png';
        }


        if ($action == 'resize') {
            $image->resize($width, $height);
        }
        if ($action == 'compress') {
            $image->encode($format, 100);
        }
        else {
            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }

        if (!empty(config('image.size.xl.watermark'))) {
            $image->insert(config('image.size.xl.watermark'), 'center');
        }

        return $image;
    }
}
