<?php 

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		/* Product Route */
		$route->group(['prefix' => 'upload'], function($route) {
			$route->post('render', 'UploadResourceController@render')->name('admin.upload.render');
			$route->post('{config}/{path?}/', 'UploadResourceController@upload')->where('path', '(.*)')->name('admin.upload');
		});
		/* Product Route */
	});
});

$route->group(['prefix' => 'upload','middleware' => 'web'], function($route) {
	$route->post('{config}/{path?}/', 'UploadPublicController@upload')->where('path', '(.*)')->name('public.upload');
});

