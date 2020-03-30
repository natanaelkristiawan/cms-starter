<?php

namespace Master\Upload;

use App;
use Master\Upload\Traits\FileDisplay;
use Master\Upload\Traits\Uploader;

class Filer
{
    use FileDisplay, Uploader;

    public function __construct()
    {
        $this->image = App::make('image');
    }
}
