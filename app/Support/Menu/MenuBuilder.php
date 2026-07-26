<?php

namespace App\Support\Menu;

use Closure;

class MenuBuilder
{
    protected $name;

    protected $items = [];

    protected $presenter;

    public function __construct($name)
    {
        $this->name = $name;
        $this->presenter = config('menus.styles.adminltecustom');
    }

    public function getName()
    {
        return $this->name;
    }

    public function add(array $attributes = [])
    {
        $item = MenuItem::make($attributes);

        $this->items[] = $item;

        return $item;
    }

    public function dropdown($title, Closure $callback, $order = null, array $attributes = [])
    {
        if (func_num_args() === 3) {
            $arguments = func_get_args();
            $title = $arguments[0];
            $attributes = $arguments[2];
            $order = null;
        }

        $item = MenuItem::make(compact('title', 'order', 'attributes'));

        call_user_func($callback, $item);

        $this->items[] = $item;

        return $item;
    }

    public function url($url, $title, $order = 0, array $attributes = [])
    {
        if (func_num_args() === 3) {
            $arguments = func_get_args();

            return $this->add([
                'url' => $arguments[0],
                'title' => $arguments[1],
                'attributes' => $arguments[2],
            ]);
        }

        return $this->add(compact('url', 'title', 'order', 'attributes'));
    }

    public function getOrderedItems()
    {
        return collect($this->items)->sortBy('order')->values()->all();
    }

    public function render($presenter = null)
    {
        $presenterClass = $presenter ? config("menus.styles.{$presenter}", $this->presenter) : $this->presenter;

        /** @var \App\Support\Menu\Presenters\Presenter $presenterInstance */
        $presenterInstance = new $presenterClass();

        $html = $presenterInstance->getOpenTagWrapper();

        foreach ($this->getOrderedItems() as $item) {
            if ($item->hidden()) {
                continue;
            }

            if ($item->hasSubMenu()) {
                $html .= $presenterInstance->getMenuWithDropDownWrapper($item);
            } elseif ($item->isHeader()) {
                $html .= $presenterInstance->getHeaderWrapper($item);
            } elseif ($item->isDivider()) {
                $html .= $presenterInstance->getDividerWrapper();
            } else {
                $html .= $presenterInstance->getMenuWithoutDropdownWrapper($item);
            }
        }

        $html .= $presenterInstance->getCloseTagWrapper();

        return $html;
    }
}
