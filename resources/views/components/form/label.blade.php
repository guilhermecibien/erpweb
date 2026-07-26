@props(['name', 'value' => null, 'options' => [], 'escape' => true])
@php
    $resolver = app(\App\Support\FormHtml\FormFieldResolver::class);
    $resolver->recordLabel($name);
    $text = $value ?: ucwords(str_replace('_', ' ', $name));
    if ($escape) {
        $text = $resolver->entities($text);
    }
@endphp
<label for="{{ $name }}"{!! $resolver->attributes($options) !!}>{!! $text !!}</label>
