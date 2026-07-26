<?php

namespace App\Support\FormHtml;

use Illuminate\Support\ServiceProvider;

class FormHtmlServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('html', function ($app) {
            return new HtmlBuilder();
        });

        $this->app->singleton('form', function ($app) {
            $form = new FormBuilder($app['html'], $app['url'], $app['session.store']->token(), $app['request']);

            return $form->setSessionStore($app['session.store']);
        });

        $this->app->alias('html', HtmlBuilder::class);
        $this->app->alias('form', FormBuilder::class);
    }
}
