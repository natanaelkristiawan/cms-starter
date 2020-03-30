<?php

namespace Master\Upload\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Master\Upload\Filer;
use Illuminate\Support\Facades\Hash;
use Upload;
use Master\Upload\Http\Traits\UploadTrait;

class UploadResourceController extends Controller
{	
    use UploadTrait;
    public $filer;

	public function __construct(Filer $filer)
	{
  		$this->middleware('auth:admin');
        $this->filer = $filer;
	}

    public function render(Request $request)
    {
        $field = $request['field'];
        $config = $request['config'];
        $files = is_null($request['files']) ? array() : $request['files'];

        $params = array(
            'field' => $field,
            'url'   => route('admin.upload', ['config' => $config, 'path' => date('Y/m/d').'/'.$field.'/file']),
            'count' => 10,
            'files' => $files
        );

        return view('upload::admin.dropzone-ajax')->with($params)->render();
    }

}