<?php
namespace derbala\Routers;

use Illuminate\Support\ServiceProvider;

class RouterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../publish/migrations/' => database_path('migrations'),
        ]);
    }

    public function register()
    {
        $this->commands(
            'derbala\Routers\FetchAppRoutesCommand',
            'derbala\Routers\FetchPermissionRoutesCommand'
        );
    }
}
