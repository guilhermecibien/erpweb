@extends('layouts.auth2')
@section('title', __('lang_v1.register'))

@section('content')
<div class="login-form col-md-12 col-xs-12 right-col-content-register">
    
    <p class="form-header text-white">@lang('business.register_and_get_started_in_minutes')</p>
    @php
    $__f1 = ['options' => ['url' => route('business.postRegister'), 'method' => 'post', 'id' => 'business_register_form','files' => true ]];
    @endphp
    <x-form.open :options="$__f1['options']" />
        @include('business.partials.register_form')
        @php
        $__f2 = ['name' => 'package_id', 'value' => $package_id];
        @endphp
        <x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" />
    <x-form.close />
</div>
@stop
@section('javascript')

<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "{{ route('business.getRegister') }}?lang=" + $(this).val();
        });
    })
</script>
@endsection