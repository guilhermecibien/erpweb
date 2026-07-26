@props(['type', 'name' => null, 'value' => null, 'options' => []])
@php
    $resolver = app(\App\Support\FormHtml\FormFieldResolver::class);
    if (! isset($options['name']) && ! is_null($name)) {
        $options['name'] = $name;
    }
    $id = $resolver->resolveId($name, $options);
    if (! in_array($type, ['file', 'password', 'checkbox', 'radio'])) {
        $value = $resolver->resolveValue($name, $value);
    }
    $attrs = array_merge($options, compact('type', 'value', 'id'));
@endphp
<input{!! $resolver->attributes($attrs) !!}>
