<?php

namespace VirtualProject\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        /* Require all extends files */
        $extends = ['Helpers', 'Validations'];
        foreach ($extends as $extend)
        {
            foreach (glob(app_path() . "/{$extend}/*.php") as $filename)
            {
                require_once ($filename);
            }
        }
        
        $this->app->bind('Illuminate\Contracts\Auth\Registrar', 'VirtualProject\Services\Registrar');
    }
}
