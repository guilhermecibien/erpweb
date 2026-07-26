<?php

namespace App\Support\Menu;

use Closure;

class Menu
{
    protected $menus = [];

    public function create($name, Closure $resolver)
    {
        $builder = new MenuBuilder($name);

        $this->menus[$name] = $builder;

        return $resolver($builder);
    }

    public function has($name)
    {
        return array_key_exists($name, $this->menus);
    }

    public function instance($name)
    {
        return $this->has($name) ? $this->menus[$name] : null;
    }

    public function render($name, $presenter = null)
    {
        return $this->has($name) ? $this->menus[$name]->render($presenter) : null;
    }

    public function destroy()
    {
        $this->menus = [];
    }
}
