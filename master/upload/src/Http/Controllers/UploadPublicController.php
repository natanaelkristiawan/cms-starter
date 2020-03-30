<?php

namespace Master\Upload\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Master\Upload\Filer;
use Illuminate\Support\Facades\Hash;
use Upload;

use Master\Upload\Http\Traits\UploadTrait;

class UploadPublicController extends Controller
{	
    use UploadTrait;
    public $filer;
	public function __construct(Filer $filer)
	{
  		// $this->middleware('auth');
        $this->filer = $filer;
	}

}