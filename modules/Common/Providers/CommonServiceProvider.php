<?php

namespace Modules\Common\Providers;

use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    protected string $path = __DIR__;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Load module migrations from
        $this->loadMigrationsFrom($this->path . '/../Database/Migrations');

        // Load routes
        $this->loadRoutesFrom($this->path . '/../Routes/web.php');
        $this->loadRoutesFrom($this->path . '/../Routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}