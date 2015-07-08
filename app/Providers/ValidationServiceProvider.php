<?php namespace VirtualProject\Providers;

use Illuminate\Support\ServiceProvider;
use VirtualProject\Validations\VirtualProjectValidator;

class ValidationServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	
	{
		// Register virtual project validation.
	    $this->app->validator->resolver(function($translator, $data, $rules, $messages)
	    {
	        return new VirtualProjectValidator($translator, $data, $rules, $messages);
	    });
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {}

}
