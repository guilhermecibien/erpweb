@props(['name', 'value' => null, 'checked' => null, 'options' => []])
@php
    $resolver = app(\App\Support\FormHtml\FormFieldResolver::class);
    $value = $value ?? $name;
    if ($resolver->radioChecked($name, $value, $checked)) {
        $options['checked'] = 'checked';
    }
    if (! isset($options['name'])) {
        $options['name'] = $name;
    }
    $id = $resolver->resolveId($name, $options);
    $attrs = array_merge($options, ['type' => 'radio', 'value' => $value, 'id' => $id]);
@endphp
<input{!! $resolver->attributes($attrs) !!}>
