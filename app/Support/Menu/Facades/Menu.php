<?php

namespace App\Support\Menu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Support\Menu\MenuBuilder create(string $name, \Closure $resolver)
 * @method static bool has(string $name)
 * @method static \App\Support\Menu\MenuBuilder|null instance(string $name)
 * @method static string|null render(string $name, string $presenter = null)
 * @method static void destroy()
 */
class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'menus';
    }
}
