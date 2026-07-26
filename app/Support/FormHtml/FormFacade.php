<?php

namespace App\Support\FormHtml;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Support\FormHtml\FormBuilder
 */
class FormFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'form';
    }
}
