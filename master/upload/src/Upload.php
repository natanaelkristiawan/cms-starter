<?php

namespace Master\Upload;
use View;

class Upload
{
	public function setForm($field, $config, $files = array(), $count = 10)
	{
		$params = array(
			'field' => $field,
			'url'	=> route('admin.upload', ['config' => $config, 'path' => date('Y/m/d').'/'.$field.'/file']),
			'count'	=> $count,
			'files' => $files
		);

		return view('upload::admin.dropzone')->with($params)->render();
	}
}