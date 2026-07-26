@extends('layouts.app')

@section('title', 'Nova Cidade')

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>Nova Cidade</h1>
    </div>
    <a href="/cities" class="sa-header-action">
        <i class="fa fa-arrow-left"></i> Voltar
    </a>
</section>

<section class="content sa-dashboard">

    <div class="sa-page-card">
        <div class="sa-page-card-body sa-business-form">
            @php
            $__f1 = ['options' => ['url' => action('CityController@save'), 'method' => 'post', 'id' => 'natureza_add_form' ]];
            @endphp
            <x-form.open :options="$__f1['options']" />
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        @php
                        $__f2 = ['name' => 'nome', 'value' => 'Cidade' . ':*'];
                        @endphp
                        <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
                        @php
                        $__f3 = ['name' => 'nome', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Cidade' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        @php
                        $__f4 = ['name' => 'uf', 'value' => 'UF' . ':'];
                        @endphp
                        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
                        @php
                        $__f5 = ['name' => 'uf', 'list' => App\Models\City::ufs(), 'selected' => '', 'options' => ['id' => 'uf', 'class' => 'form-control select2', 'required']];
                        @endphp
                        <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f6 = ['name' => 'codigo', 'value' => 'Código' . ':*'];
                        @endphp
                        <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
                        @php
                        $__f7 = ['name' => 'codigo', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Código' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                    </div>
                </div>
            </div>

            @if(!empty($form_partials))
            @foreach($form_partials as $partial)
            {!! $partial !!}
            @endforeach
            @endif

            <div class="sa-form-actions">
                @php
                $__f8 = ['value' => __('messages.save'), 'options' => ['class' => 'sa-btn-pill sa-btn-pill-primary']];
                @endphp
                <x-form.submit :value="$__f8['value']" :options="$__f8['options']" />
            </div>
            <x-form.close />
        </div>
    </div>

</section>
@stop
