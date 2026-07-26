<?php

namespace App\Support\FormHtml;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Lógica de repopulação de formulário (old()/request/checked-state) e montagem de
 * <select>/<option>, extraída do antigo FormBuilder (laravelcollective/html) para ser
 * reutilizada pelos componentes Blade em resources/views/components/form/. Sem Facade,
 * sem model binding (nunca usado nas views deste projeto).
 *
 * Registrado como singleton (uma instância por request) porque o id de um campo depende
 * de um <x-form.label> ter sido renderizado antes para o mesmo name, replicando o
 * comportamento do FormBuilder original.
 */
class FormFieldResolver
{
    protected HtmlBuilder $html;

    protected UrlGenerator $url;

    protected string $csrfToken;

    protected ?Request $request;

    protected ?Session $session = null;

    protected array $labels = [];

    protected array $spoofedMethods = ['DELETE', 'PATCH', 'PUT'];

    public function __construct(HtmlBuilder $html, UrlGenerator $url, string $csrfToken, ?Request $request = null)
    {
        $this->html = $html;
        $this->url = $url;
        $this->csrfToken = $csrfToken;
        $this->request = $request;
    }

    public function setSessionStore(Session $session): static
    {
        $this->session = $session;

        return $this;
    }

    public function attributes(array $attributes): string
    {
        return $this->html->attributes($attributes);
    }

    public function entities($value): string
    {
        return $this->html->entities($value);
    }

    public function formAction(array $options): string
    {
        if (isset($options['url'])) {
            return $this->getUrlAction($options['url']);
        }

        if (isset($options['route'])) {
            return $this->getRouteAction($options['route']);
        }

        if (isset($options['action'])) {
            return $this->getControllerAction($options['action']);
        }

        return $this->url->current();
    }

    protected function getUrlAction($options)
    {
        if (is_array($options)) {
            return $this->url->to($options[0], array_slice($options, 1));
        }

        return $this->url->to($options);
    }

    protected function getRouteAction($options)
    {
        if (is_array($options)) {
            $parameters = array_slice($options, 1);

            if (array_keys($options) === [0, 1]) {
                $parameters = head($parameters);
            }

            return $this->url->route($options[0], $parameters);
        }

        return $this->url->route($options);
    }

    protected function getControllerAction($options)
    {
        if (is_array($options)) {
            return $this->url->action($options[0], array_slice($options, 1));
        }

        return $this->url->action($options);
    }

    public function formMethod(string $method): string
    {
        $method = strtoupper($method);

        return $method !== 'GET' ? 'POST' : $method;
    }

    /**
     * HTML extra do <form>: hidden _method (spoofing) + hidden _token.
     */
    public function formAppendage(string $method): string
    {
        [$method, $appendage] = [strtoupper($method), ''];

        if (in_array($method, $this->spoofedMethods)) {
            $appendage .= $this->hiddenInput('_method', $method);
        }

        if ($method !== 'GET') {
            $appendage .= $this->token();
        }

        return $appendage;
    }

    public function token(): string
    {
        $token = ! empty($this->csrfToken) ? $this->csrfToken : $this->session?->token();

        return $this->hiddenInput('_token', $token);
    }

    protected function hiddenInput(string $name, $value): string
    {
        return '<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . e($value, false) . '">';
    }

    public function recordLabel(string $name): void
    {
        $this->labels[] = $name;
    }

    public function resolveId(?string $name, array $attributes): ?string
    {
        if (array_key_exists('id', $attributes)) {
            return $attributes['id'];
        }

        if (! is_null($name) && in_array($name, $this->labels)) {
            return $name;
        }

        return null;
    }

    public function resolveValue(?string $name, $value = null)
    {
        if (is_null($name)) {
            return $value;
        }

        $old = $this->old($name);

        if (! is_null($old) && $name !== '_method') {
            return $old;
        }

        $request = $this->requestValue($name);
        if (! is_null($request) && $name !== '_method') {
            return $request;
        }

        return $value;
    }

    protected function requestValue(string $name)
    {
        if (! isset($this->request)) {
            return null;
        }

        return $this->request->input($this->transformKey($name));
    }

    public function old(string $name)
    {
        if (! isset($this->session)) {
            return null;
        }

        return $this->session->getOldInput($this->transformKey($name));
    }

    public function oldInputIsEmpty(): bool
    {
        return isset($this->session) && count((array) $this->session->getOldInput()) === 0;
    }

    protected function transformKey(string $key): string
    {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $key);
    }

    public function checkboxChecked(string $name, $value, $checked): bool
    {
        $request = $this->requestValue($name);

        if (isset($this->session) && ! $this->oldInputIsEmpty() && is_null($this->old($name)) && ! $request) {
            return false;
        }

        if (is_null($this->old($name)) && is_null($request)) {
            return (bool) $checked;
        }

        $posted = $this->resolveValue($name, $checked);

        if (is_array($posted)) {
            return in_array($value, $posted);
        } elseif ($posted instanceof Collection) {
            return $posted->contains('id', $value);
        }

        return (bool) $posted;
    }

    public function radioChecked(string $name, $value, $checked): bool
    {
        $request = $this->requestValue($name);

        if (is_null($this->old($name)) && is_null($request)) {
            return (bool) $checked;
        }

        return $this->resolveValue($name) == $value;
    }

    /**
     * HTML das <option>/<optgroup> de um <select>, incluindo placeholder.
     */
    public function selectOptionsHtml($list, $selected, ?string $placeholder, array $optionsAttributes = [], array $optgroupsAttributes = []): string
    {
        $html = [];

        if (! is_null($placeholder)) {
            $html[] = $this->placeholderOption($placeholder, $selected);
        }

        foreach ($list as $value => $display) {
            $optionAttributes = $optionsAttributes[$value] ?? [];
            $optgroupAttributes = $optgroupsAttributes[$value] ?? [];
            $html[] = $this->getSelectOption($display, $value, $selected, $optionAttributes, $optgroupAttributes);
        }

        return implode('', $html);
    }

    protected function getSelectOption($display, $value, $selected, array $attributes = [], array $optgroupAttributes = [])
    {
        if (is_iterable($display)) {
            return $this->optionGroup($display, $value, $selected, $optgroupAttributes, $attributes);
        }

        return $this->option($display, $value, $selected, $attributes);
    }

    protected function optionGroup($list, $label, $selected, array $attributes = [], array $optionsAttributes = [], $level = 0)
    {
        $html = [];
        $space = str_repeat('&nbsp;', $level);

        foreach ($list as $value => $display) {
            $optionAttributes = $optionsAttributes[$value] ?? [];

            if (is_iterable($display)) {
                $html[] = $this->optionGroup($display, $value, $selected, $attributes, $optionAttributes, $level + 5);
            } else {
                $html[] = $this->option($space . $display, $value, $selected, $optionAttributes);
            }
        }

        return '<optgroup label="' . e($space . $label, false) . '"' . $this->html->attributes($attributes) . '>' . implode('', $html) . '</optgroup>';
    }

    protected function option($display, $value, $selected, array $attributes = [])
    {
        $selected = $this->getSelectedValue($value, $selected);

        $options = array_merge(['value' => $value, 'selected' => $selected], $attributes);

        $string = '<option' . $this->html->attributes($options) . '>';

        if ($display !== null) {
            $string .= e($display, false) . '</option>';
        }

        return $string;
    }

    protected function placeholderOption($display, $selected)
    {
        $selected = $this->getSelectedValue(null, $selected);

        $options = [
            'selected' => $selected,
            'value' => '',
        ];

        return '<option' . $this->html->attributes($options) . '>' . e($display, false) . '</option>';
    }

    protected function getSelectedValue($value, $selected)
    {
        if (is_array($selected)) {
            return in_array($value, $selected, true) || in_array((string) $value, $selected, true) ? 'selected' : null;
        } elseif ($selected instanceof Collection) {
            return $selected->contains($value) ? 'selected' : null;
        }

        if (is_int($value) && is_bool($selected)) {
            return (bool) $value === $selected;
        }

        return ((string) $value === (string) $selected) ? 'selected' : null;
    }
}
