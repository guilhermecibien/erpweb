@props(['options' => []])
@php
    $resolver = app(\App\Support\FormHtml\FormFieldResolver::class);
    $method = $options['method'] ?? 'post';
    $formMethod = $resolver->formMethod($method);
    $formAction = $resolver->formAction($options);
    if (! empty($options['files'])) {
        $options['enctype'] = 'multipart/form-data';
    }
    $attributes = array_merge(
        ['method' => $formMethod, 'action' => $formAction, 'accept-charset' => 'UTF-8'],
        \Illuminate\Support\Arr::except($options, ['method', 'url', 'route', 'action', 'files'])
    );
    $appendage = $resolver->formAppendage($method);
@endphp
<form{!! $resolver->attributes($attributes) !!}>{!! $appendage !!}
