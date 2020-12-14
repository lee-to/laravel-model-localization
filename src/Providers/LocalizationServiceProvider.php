<?php

namespace Leeto\Localization\Providers;

use Illuminate\Support\ServiceProvider;

class LocalizationServiceProvider extends ServiceProvider
{
    protected $namespace = "localization";

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $path = __DIR__ . "/..";

        /* Config */
        $this->publishes([
            $path . '/config/'.$this->namespace.'.php' => config_path($this->namespace . '.php'),
        ]);

        /* Migrations */
        $this->loadMigrationsFrom($path . '/database/migrations');
    }
}
