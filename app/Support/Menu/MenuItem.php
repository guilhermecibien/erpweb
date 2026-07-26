<?php

namespace App\Support\Menu;

use Closure;
use Illuminate\Support\Arr;

/**
 * @property string|null url
 * @property array|null route
 * @property string|null title
 * @property string|null name
 * @property string|null icon
 * @property array|null attributes
 * @property int|null order
 */
class MenuItem
{
    protected $properties = [];

    protected $childs = [];

    protected $fillable = [
        'url',
        'route',
        'title',
        'name',
        'icon',
        'attributes',
        'order',
    ];

    protected $hideWhen;

    public function __construct(array $properties = [])
    {
        $this->fill($properties);
    }

    protected static function setIconAttribute(array $properties)
    {
        $icon = Arr::get($properties, 'attributes.icon');

        if ($icon !== null) {
            $properties['icon'] = $icon;
            Arr::forget($properties, 'attributes.icon');
        }

        return $properties;
    }

    public static function make(array $properties)
    {
        return new static(self::setIconAttribute($properties));
    }

    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->{$key} = $value;
            }
        }
    }

    public function dropdown($title, Closure $callback, $order = 0, array $attributes = [])
    {
        if (func_num_args() === 3) {
            $arguments = func_get_args();
            $title = Arr::get($arguments, 0);
            $attributes = Arr::get($arguments, 2);
        }

        $child = static::make(compact('title', 'attributes'));

        call_user_func($callback, $child);

        $this->childs[] = $child;

        return $child;
    }

    public function url($url, $title, $order = 0, array $attributes = [])
    {
        if (func_num_args() === 3) {
            $arguments = func_get_args();

            return $this->add([
                'url' => Arr::get($arguments, 0),
                'title' => Arr::get($arguments, 1),
                'attributes' => Arr::get($arguments, 2),
            ]);
        }

        return $this->add(compact('url', 'title', 'order', 'attributes'));
    }

    public function add(array $properties)
    {
        $item = static::make($properties);

        $this->childs[] = $item;

        return $item;
    }

    public function getChilds()
    {
        return collect($this->childs)->sortBy('order')->values()->all();
    }

    public function getUrl()
    {
        if (!empty($this->url)) {
            return url($this->url);
        }

        return url('/#');
    }

    public function getIcon($default = null)
    {
        if (!empty($this->icon)) {
            return '<i class="' . $this->icon . '"></i>';
        }

        return $default === null ? $default : '<i class="' . $default . '"></i>';
    }

    public function getAttributes()
    {
        $attributes = $this->attributes ?: [];

        Arr::forget($attributes, ['active', 'icon']);

        $html = [];

        foreach ($attributes as $key => $value) {
            if ($value === null || $value === false) {
                continue;
            }

            $html[] = $value === true ? e($key) : e($key) . '="' . e($value) . '"';
        }

        return implode(' ', $html);
    }

    public function isDivider()
    {
        return $this->is('divider');
    }

    public function isHeader()
    {
        return $this->is('header');
    }

    public function is($name)
    {
        return $this->name == $name;
    }

    public function hasSubMenu()
    {
        return !empty($this->childs);
    }

    public function hasActiveOnChild()
    {
        if (!$this->hasSubMenu()) {
            return false;
        }

        foreach ($this->getChilds() as $child) {
            if ($child->hasSubMenu() && $child->hasActiveOnChild()) {
                return true;
            }

            if ($child->isActive()) {
                return true;
            }
        }

        return false;
    }

    public function getActiveAttribute()
    {
        return Arr::get($this->attributes, 'active');
    }

    public function isActive()
    {
        $active = $this->getActiveAttribute();

        if (is_bool($active)) {
            return $active;
        }

        if ($active instanceof Closure) {
            return call_user_func($active);
        }

        return request()->is(ltrim(str_replace(url('/'), '', $this->getUrl()), '/'));
    }

    public function order($order)
    {
        $this->order = $order;

        return $this;
    }

    public function hideWhen(Closure $callback)
    {
        $this->hideWhen = $callback;

        return $this;
    }

    public function hidden()
    {
        if ($this->hideWhen === null) {
            return false;
        }

        return call_user_func($this->hideWhen) == true;
    }

    public function __get($key)
    {
        return $this->$key ?? null;
    }
}
