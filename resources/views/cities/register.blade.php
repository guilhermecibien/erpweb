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
            {!! Form::open(['url' => action('CityController@save'), 'method' => 'post', 'id' => 'natureza_add_form' ]) !!}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('nome', 'Cidade' . ':*') !!}
                        {!! Form::text('nome', '', ['class' => 'form-control', 'required', 'placeholder' => 'Cidade' ]); !!}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::label('uf', 'UF' . ':') !!}
                        {!! Form::select('uf', App\Models\City::ufs(), '', ['id' => 'uf', 'class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('codigo', 'Código' . ':*') !!}
                        {!! Form::text('codigo', '', ['class' => 'form-control', 'required', 'placeholder' => 'Código' ]); !!}
                    </div>
                </div>
            </div>

            @if(!empty($form_partials))
            @foreach($form_partials as $partial)
            {!! $partial !!}
            @endforeach
            @endif

            <div class="sa-form-actions">
                {!! Form::submit(__('messages.save'), ['class' => 'sa-btn-pill sa-btn-pill-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</section>
@stop
