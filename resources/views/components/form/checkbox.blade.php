@props(['name', 'value' => 1, 'checked' => null, 'options' => []])
@php
    $resolver = app(\App\Support\FormHtml\FormFieldResolver::class);
    if ($resolver->checkboxChecked($name, $value, $checked)) {
        $options['checked'] = 'checked';
    }
    if (! isset($options['name'])) {
        $options['name'] = $name;
    }
    $id = $resolver->resolveId($name, $options);
    $attrs = array_merge($options, ['type' => 'checkbox', 'value' => $value, 'id' => $id]);
@endphp
<input{!! $resolver->attributes($attrs) !!}>
