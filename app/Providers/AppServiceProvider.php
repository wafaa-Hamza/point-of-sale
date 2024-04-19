<?php

namespace App\Providers;

use App\Models\Pos;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * to set Config
     *  use Illuminate\Support\Facades\Config;
     * Config::set('app.general_variable', $new);
     * to get general config('app.general_variable')
     */

    public function register(): void

    { 

       

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
