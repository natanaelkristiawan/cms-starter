<?php

namespace Master\Articles\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Request;
use Route;

class RouteServiceProvider extends ServiceProvider
{
	protected $namespace = 'Master\Articles\Http\Controllers';

	public function boot()
	{
		parent::boot();
		if (Request::is('*/articles/edit/*') || Request::is('*/articles/delete/*')) {
			Route::bind('id', function ($id) {
				$model = $this->app->make('Master\Articles\Interfaces\ArticlesRepositoryInterface');
				return $model->find($id);
			});
		}


		if (Request::is('*/categories/edit/*') || Request::is('*/categories/delete/*')) {
			Route::bind('id', function ($id) {
				$model = $this->app->make('Master\Articles\Interfaces\CategoriesRepositoryInterface');
				return $model->find($id);
			});
		}

	}

	public function map()
	{
		$this->mapWebRoutes();
	}

	protected function mapWebRoutes()
	{
		Route::group([
		'namespace'  => $this->namespace,
		], function ($route) {
			require (__DIR__ . '/../../routes/web.php');
		});
	}

}
