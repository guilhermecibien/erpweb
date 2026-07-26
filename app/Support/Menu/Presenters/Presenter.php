<?php

namespace App\Support\Menu\Presenters;

use App\Support\Menu\MenuItem;

abstract class Presenter
{
    public function getOpenTagWrapper()
    {
    }

    public function getCloseTagWrapper()
    {
    }

    public function getMenuWithoutDropdownWrapper($item)
    {
    }

    public function getDividerWrapper()
    {
    }

    public function getHeaderWrapper($item)
    {
    }

    public function getMenuWithDropDownWrapper($item)
    {
    }

    public function getMultiLevelDropdownWrapper($item)
    {
    }

    public function getChildMenuItems(MenuItem $item)
    {
        $results = '';

        foreach ($item->getChilds() as $child) {
            if ($child->hidden()) {
                continue;
            }

            if ($child->hasSubMenu()) {
                $results .= $this->getMultiLevelDropdownWrapper($child);
            } elseif ($child->isHeader()) {
                $results .= $this->getHeaderWrapper($child);
            } elseif ($child->isDivider()) {
                $results .= $this->getDividerWrapper();
            } else {
                $results .= $this->getMenuWithoutDropdownWrapper($child);
            }
        }

        return $results;
    }
}
