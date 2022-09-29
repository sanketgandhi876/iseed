<?php

namespace Orangehill\Iseed;

use Illuminate\Support\ServiceProvider;

class IseedServiceProvider extends ServiceProvider
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
        require base_path().'/vendor/autoload.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerResources();

        $this->app->singleton('iseed', function($app) {
            return new Iseed;
        });

		$this->app->boot(function() {
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Iseed', 'Orangehill\Iseed\Facades\Iseed');
		});

        $this->app->singleton('command.iseed', function($app) {
            return new IseedCommand;
        });

        $this->commands('command.iseed');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('iseed');
    }

    /**
     * Register the package resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $userConfigFile    = base_path().'/vendor/orangehill/iseed/src/Orangehill/Iseed/Iseed.php';
        $packageConfigFile = base_path().'/vendor/orangehill/iseed/src/config/config.php';
        $config            = $this->require($packageConfigFile);

        if (file_exists($userConfigFile)) {
            $userConfig = $this->require($userConfigFile);
        }

        app('config')->set('iseed::config', $config);
    }

	protected function require($path) {
        return require $path;
    }
}
