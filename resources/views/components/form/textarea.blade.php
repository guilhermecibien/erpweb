@props(['name', 'value' => null, 'options' => []])
@php
    $resolver = app(\App\Support\FormHtml\FormFieldResolver::class);
    if (! isset($options['name'])) {
        $options['name'] = $name;
    }
    if (isset($options['size'])) {
        [$cols, $rows] = explode('x', $options['size']);
        $options = array_merge($options, ['cols' => $cols, 'rows' => $rows]);
    } else {
        $options = array_merge($options, [
            'cols' => $options['cols'] ?? 50,
            'rows' => $options['rows'] ?? 10,
        ]);
    }
    unset($options['size']);
    $options['id'] = $resolver->resolveId($name, $options);
    $value = (string) $resolver->resolveValue($name, $value);
@endphp
<textarea{!! $resolver->attributes($options) !!}>{!! e($value, false) !!}</textarea>
