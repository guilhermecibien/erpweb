<?php

namespace App\Support\FormHtml;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Support\FormHtml\HtmlBuilder
 */
class HtmlFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'html';
    }
}
