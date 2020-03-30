<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'articles'], function($route) {
			$route->get('/', 'ArticlesResourceController@index')->name('admin.articles');
			$route->get('/create', 'ArticlesResourceController@create')->name('admin.articles.create');
			$route->post('/create', 'ArticlesResourceController@store');
			$route->get('/edit/{id}', 'ArticlesResourceController@edit')->name('admin.articles.edit');
			$route->post('/edit/{id}', 'ArticlesResourceController@update');
			$route->get('delete/{id}', 'ArticlesResourceController@delete')->name('admin.articles.delete');
		});


		$route->group(['prefix' => 'categories'], function($route) {
			$route->get('/', 'CategoriesResourceController@index')->name('admin.categories');
			$route->get('/create', 'CategoriesResourceController@create')->name('admin.categories.create');
			$route->post('/create', 'CategoriesResourceController@store');
			$route->get('/edit/{id}', 'CategoriesResourceController@edit')->name('admin.categories.edit');
			$route->post('/edit/{id}', 'CategoriesResourceController@update');
			$route->get('delete/{id}', 'CategoriesResourceController@delete')->name('admin.categories.delete');
		});

	});
});