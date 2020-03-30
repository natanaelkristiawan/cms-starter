<?php

namespace Master\Upload;

use Illuminate\Support\ServiceProvider;

class UploadServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
         // Load view
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'upload');
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'upload');

        $this->publishResources();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/filer.php', 'filer');
        $this->mergeConfigFrom(__DIR__ . '/../config/image.php', 'image');

        $this->app->register(\Master\Upload\Providers\RouteServiceProvider::class);

        // Bind facade
        $this->app->bind('master.upload', function ($app) {
            return $this->app->make('Master\Upload\Upload');
        });


    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['master.upload'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/../config/config.php' => config_path('master/upload.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/upload')], 'view-upload');
    }
}
