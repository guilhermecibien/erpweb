<?php

namespace App\Support\FormHtml;

use BadMethodCallException;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

/**
 * Substituto local do Collective\Html\FormBuilder (laravelcollective/html, abandonado,
 * última versão em 2023, sem suporte a Laravel 11+). Reimplementa só a API realmente
 * usada nas views Blade do sistema (Form::open/close/token/label/text/password/hidden/
 * email/tel/number/file/textarea/select/checkbox/radio/submit), preservando o
 * comportamento de repopulação via old() e de valores vindos de model binding.
 */
class FormBuilder
{
    protected HtmlBuilder $html;

    protected UrlGenerator $url;

    protected string $csrfToken;

    protected ?Request $request;

    protected ?Session $session = null;

    protected mixed $model = null;

    protected array $labels = [];

    protected ?string $type = null;

    protected array $reserved = ['method', 'url', 'route', 'action', 'files'];

    protected array $spoofedMethods = ['DELETE', 'PATCH', 'PUT'];

    protected array $skipValueTypes = ['file', 'password', 'checkbox', 'radio'];

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

    public function open(array $options = [])
    {
        $method = Arr::get($options, 'method', 'post');

        $attributes['method'] = $this->getMethod($method);
        $attributes['action'] = $this->getAction($options);
        $attributes['accept-charset'] = 'UTF-8';

        $append = $this->getAppendage($method);

        if (isset($options['files']) && $options['files']) {
            $options['enctype'] = 'multipart/form-data';
        }

        $attributes = array_merge($attributes, Arr::except($options, $this->reserved));

        $attributes = $this->html->attributes($attributes);

        return $this->toHtmlString('<form' . $attributes . '>' . $append);
    }

    public function close()
    {
        $this->labels = [];
        $this->model = null;

        return $this->toHtmlString('</form>');
    }

    public function token()
    {
        $token = ! empty($this->csrfToken) ? $this->csrfToken : $this->session?->token();

        return $this->hidden('_token', $token);
    }

    public function label($name, $value = null, $options = [], $escape_html = true)
    {
        $this->labels[] = $name;

        $optionsHtml = $this->html->attributes($options);

        $value = $this->formatLabel($name, $value);

        if ($escape_html) {
            $value = $this->html->entities($value);
        }

        return $this->toHtmlString('<label for="' . $name . '"' . $optionsHtml . '>' . $value . '</label>');
    }

    protected function formatLabel($name, $value)
    {
        return $value ?: ucwords(str_replace('_', ' ', $name));
    }

    public function input($type, $name, $value = null, $options = [])
    {
        $this->type = $type;

        if (! isset($options['name'])) {
            $options['name'] = $name;
        }

        $id = $this->getIdAttribute($name, $options);

        if (! in_array($type, $this->skipValueTypes)) {
            $value = $this->getValueAttribute($name, $value);
        }

        $merge = compact('type', 'value', 'id');

        $options = array_merge($options, $merge);

        return $this->toHtmlString('<input' . $this->html->attributes($options) . '>');
    }

    public function text($name, $value = null, $options = [])
    {
        return $this->input('text', $name, $value, $options);
    }

    public function password($name, $options = [])
    {
        return $this->input('password', $name, '', $options);
    }

    public function hidden($name, $value = null, $options = [])
    {
        return $this->input('hidden', $name, $value, $options);
    }

    public function email($name, $value = null, $options = [])
    {
        return $this->input('email', $name, $value, $options);
    }

    public function tel($name, $value = null, $options = [])
    {
        return $this->input('tel', $name, $value, $options);
    }

    public function number($name, $value = null, $options = [])
    {
        return $this->input('number', $name, $value, $options);
    }

    public function file($name, $options = [])
    {
        return $this->input('file', $name, null, $options);
    }

    public function submit($value = null, $options = [])
    {
        return $this->input('submit', null, $value, $options);
    }

    public function textarea($name, $value = null, $options = [])
    {
        $this->type = 'textarea';

        if (! isset($options['name'])) {
            $options['name'] = $name;
        }

        $options = $this->setTextAreaSize($options);

        $options['id'] = $this->getIdAttribute($name, $options);

        $value = (string) $this->getValueAttribute($name, $value);

        unset($options['size']);

        $optionsHtml = $this->html->attributes($options);

        return $this->toHtmlString('<textarea' . $optionsHtml . '>' . e($value, false) . '</textarea>');
    }

    protected function setTextAreaSize($options)
    {
        if (isset($options['size'])) {
            $segments = explode('x', $options['size']);

            return array_merge($options, ['cols' => $segments[0], 'rows' => $segments[1]]);
        }

        $cols = Arr::get($options, 'cols', 50);
        $rows = Arr::get($options, 'rows', 10);

        return array_merge($options, compact('cols', 'rows'));
    }

    public function select(
        $name,
        $list = [],
        $selected = null,
        array $selectAttributes = [],
        array $optionsAttributes = [],
        array $optgroupsAttributes = []
    ) {
        $this->type = 'select';

        $selected = $this->getValueAttribute($name, $selected);

        $selectAttributes['id'] = $this->getIdAttribute($name, $selectAttributes);

        if (! isset($selectAttributes['name'])) {
            $selectAttributes['name'] = $name;
        }

        $html = [];

        if (isset($selectAttributes['placeholder'])) {
            $html[] = $this->placeholderOption($selectAttributes['placeholder'], $selected);
            unset($selectAttributes['placeholder']);
        }

        foreach ($list as $value => $display) {
            $optionAttributes = $optionsAttributes[$value] ?? [];
            $optgroupAttributes = $optgroupsAttributes[$value] ?? [];
            $html[] = $this->getSelectOption($display, $value, $selected, $optionAttributes, $optgroupAttributes);
        }

        $selectAttributesHtml = $this->html->attributes($selectAttributes);

        $listHtml = implode('', $html);

        return $this->toHtmlString("<select{$selectAttributesHtml}>{$listHtml}</select>");
    }

    public function getSelectOption($display, $value, $selected, array $attributes = [], array $optgroupAttributes = [])
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

        return $this->toHtmlString('<optgroup label="' . e($space . $label, false) . '"' . $this->html->attributes($attributes) . '>' . implode('', $html) . '</optgroup>');
    }

    protected function option($display, $value, $selected, array $attributes = [])
    {
        $selected = $this->getSelectedValue($value, $selected);

        $options = array_merge(['value' => $value, 'selected' => $selected], $attributes);

        $string = '<option' . $this->html->attributes($options) . '>';

        if ($display !== null) {
            $string .= e($display, false) . '</option>';
        }

        return $this->toHtmlString($string);
    }

    protected function placeholderOption($display, $selected)
    {
        $selected = $this->getSelectedValue(null, $selected);

        $options = [
            'selected' => $selected,
            'value' => '',
        ];

        return $this->toHtmlString('<option' . $this->html->attributes($options) . '>' . e($display, false) . '</option>');
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

    public function checkbox($name, $value = 1, $checked = null, $options = [])
    {
        return $this->checkable('checkbox', $name, $value, $checked, $options);
    }

    public function radio($name, $value = null, $checked = null, $options = [])
    {
        if (is_null($value)) {
            $value = $name;
        }

        return $this->checkable('radio', $name, $value, $checked, $options);
    }

    protected function checkable($type, $name, $value, $checked, $options)
    {
        $this->type = $type;

        $checked = $this->getCheckedState($type, $name, $value, $checked);

        if ($checked) {
            $options['checked'] = 'checked';
        }

        return $this->input($type, $name, $value, $options);
    }

    protected function getCheckedState($type, $name, $value, $checked)
    {
        return match ($type) {
            'checkbox' => $this->getCheckboxCheckedState($name, $value, $checked),
            'radio' => $this->getRadioCheckedState($name, $value, $checked),
            default => $this->compareValues($name, $value),
        };
    }

    protected function getCheckboxCheckedState($name, $value, $checked)
    {
        $request = $this->requestValue($name);

        if (isset($this->session) && ! $this->oldInputIsEmpty() && is_null($this->old($name)) && ! $request) {
            return false;
        }

        if ($this->missingOldAndModel($name) && is_null($request)) {
            return $checked;
        }

        $posted = $this->getValueAttribute($name, $checked);

        if (is_array($posted)) {
            return in_array($value, $posted);
        } elseif ($posted instanceof Collection) {
            return $posted->contains('id', $value);
        }

        return (bool) $posted;
    }

    protected function getRadioCheckedState($name, $value, $checked)
    {
        $request = $this->requestValue($name);

        if ($this->missingOldAndModel($name) && ! $request) {
            return $checked;
        }

        return $this->compareValues($name, $value);
    }

    protected function compareValues($name, $value)
    {
        return $this->getValueAttribute($name) == $value;
    }

    protected function missingOldAndModel($name)
    {
        return is_null($this->old($name)) && is_null($this->getModelValueAttribute($name));
    }

    protected function getMethod($method)
    {
        $method = strtoupper($method);

        return $method !== 'GET' ? 'POST' : $method;
    }

    protected function getAction(array $options)
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

    protected function getAppendage($method)
    {
        [$method, $appendage] = [strtoupper($method), ''];

        if (in_array($method, $this->spoofedMethods)) {
            $appendage .= $this->hidden('_method', $method);
        }

        if ($method !== 'GET') {
            $appendage .= $this->token();
        }

        return $appendage;
    }

    public function getIdAttribute($name, $attributes)
    {
        if (array_key_exists('id', $attributes)) {
            return $attributes['id'];
        }

        if (in_array($name, $this->labels)) {
            return $name;
        }

        return null;
    }

    public function getValueAttribute($name, $value = null)
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

        if (! is_null($value)) {
            return $value;
        }

        if (isset($this->model)) {
            return $this->getModelValueAttribute($name);
        }

        return null;
    }

    protected function requestValue($name)
    {
        if (! isset($this->request)) {
            return null;
        }

        return $this->request->input($this->transformKey($name));
    }

    protected function getModelValueAttribute($name)
    {
        $key = $this->transformKey($name);

        if ((is_string($this->model) || is_object($this->model)) && method_exists($this->model, 'getFormValue')) {
            return $this->model->getFormValue($key);
        }

        return data_get($this->model, $key);
    }

    public function old($name)
    {
        if (! isset($this->session)) {
            return null;
        }

        $key = $this->transformKey($name);

        return $this->session->getOldInput($key);
    }

    public function oldInputIsEmpty()
    {
        return isset($this->session) && count((array) $this->session->getOldInput()) === 0;
    }

    protected function transformKey($key)
    {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $key);
    }

    protected function toHtmlString($html)
    {
        return new HtmlString($html);
    }

    public function __call($method, $parameters)
    {
        throw new BadMethodCallException("Method {$method} does not exist.");
    }
}
