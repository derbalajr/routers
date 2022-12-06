<?php
namespace derbala\routers;

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
        $this->publishes([
            __DIR__ . '/../publish/Models/' => app_path('Models'),
        ]);
    }

    public function register()
    {
        $this->commands(
            'derbala\routers\FetchAppRoutesCommand',
            'derbala\routers\FetchPermissionRoutesCommand'
        );
    }
}
