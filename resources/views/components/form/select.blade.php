@props(['name', 'list' => [], 'selected' => null, 'options' => [], 'optionsAttributes' => [], 'optgroupsAttributes' => []])
@php
    $resolver = app(\App\Support\FormHtml\FormFieldResolver::class);
    $selectedValue = $resolver->resolveValue($name, $selected);
    $options['id'] = $resolver->resolveId($name, $options);
    if (! isset($options['name'])) {
        $options['name'] = $name;
    }
    $placeholder = $options['placeholder'] ?? null;
    unset($options['placeholder']);
    $optionsHtml = $resolver->selectOptionsHtml($list, $selectedValue, $placeholder, $optionsAttributes, $optgroupsAttributes);
@endphp
<select{!! $resolver->attributes($options) !!}>{!! $optionsHtml !!}</select>
