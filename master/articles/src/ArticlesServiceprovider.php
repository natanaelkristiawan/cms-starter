<?php

namespace Master\Articles;

use Illuminate\Support\ServiceProvider;

class ArticlesServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'articles');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'articles');

		// Call pblish redources function
		$this->publishResources();

	}

	/**
	* Register the service provider.
	*
	* @return void
	*/
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'master.articles');

		// Bind facade
		$this->app->bind('master.articles', function ($app) {
			return $this->app->make('Master\Articles\Articles');
		});   

		// Bind article to repository
		$this->app->bind(
			'Master\Articles\Interfaces\ArticlesRepositoryInterface',
			\Master\Articles\Repositories\Eloquent\ArticlesRepository::class
		);


		// Bind category to repository
		$this->app->bind(
			'Master\Articles\Interfaces\CategoriesRepositoryInterface',
			\Master\Articles\Repositories\Eloquent\CategoriesRepository::class
		);


		// Bind category to repository
		$this->app->bind(
			'Master\Articles\Interfaces\ArticlesToCategoryRepositoryInterface',
			\Master\Articles\Repositories\Eloquent\ArticlesToCategoryRepository::class
		);

		$this->app->register(\Master\Articles\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['master.articles'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/articles.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/articles')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}
