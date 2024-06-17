<?php

namespace App\Providers;

use App\DB\DatabaseConnection;
use App\Helper\FileLogger;
use App\Helper\LoggerInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(LoggerInterface::class, FileLogger::class);
        $this->app->bind(DatabaseConnection::class, function($app) {
            return DatabaseConnection::getInstance();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
