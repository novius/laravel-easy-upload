<?php

namespace Novius\EasyUpload;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class EasyUploadServiceProvider extends LaravelServiceProvider
{
    const PACKAGE_NAME = 'laravel-easy-upload';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'easyupload');
        $this->publishes([__DIR__.'/resources/views' => resource_path('views/vendor/easyupload')], 'views');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(
            __DIR__.'/routes/easyupload.php'
        );
    }
}
