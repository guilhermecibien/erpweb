<?php

namespace App\Providers;

use App\Support\Menu\Menu;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('menus', function () {
            return new Menu();
        });
    }
}
