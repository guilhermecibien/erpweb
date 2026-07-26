@extends('layouts.app')

@section('title', 'Adicionar Veiculo')

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>Adicionar Veículo</h1>
    </div>
    <a href="/veiculos" class="sa-header-action">
        <i class="fa fa-arrow-left"></i> Voltar
    </a>
</section>

<section class="content sa-dashboard">

    <div class="sa-page-card">
        <div class="sa-page-card-body sa-business-form">
            {!! Form::open(['url' => action('VeiculoController@save'), 'method' => 'post', 'id' => 'veiculo_form' ]) !!}

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('placa', 'Placa' . ':*') !!}
                        {!! Form::text('placa', null, ['class' => 'form-control', 'required', 'placeholder' => 'Placa', 'data-mask="AAA-AAAA"' ]); !!}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::label('uf', 'UF' . ':*') !!}
                        {!! Form::select('uf', $ufs, '', ['class' => 'form-control select2', 'id' => 'contact_type', 'required']); !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('modelo', 'Modelo' . ':*') !!}
                        {!! Form::text('modelo', null, ['class' => 'form-control', 'required', 'placeholder' => 'Modelo' ]); !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('marca', 'Marca' . ':*') !!}
                        {!! Form::text('marca', null, ['class' => 'form-control', 'required', 'placeholder' => 'Marca' ]); !!}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::label('cor', 'Cor' . ':*') !!}
                        {!! Form::text('cor', null, ['class' => 'form-control', 'required', 'placeholder' => 'Cor' ]); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('tipo_carroceira', 'Tipo da carroceria' . ':*') !!}
                        {!! Form::select('tipo_carroceira', $tiposCarroceria, '', ['class' => 'form-control select2', 'id' => 'contact_type', 'required']); !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('tipo_rodado', 'Tipo de rodado' . ':*') !!}
                        {!! Form::select('tipo_rodado', $tiposRodado, '', ['class' => 'form-control select2', 'id' => 'contact_type', 'required']); !!}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::label('tara', 'Tara' . ':*') !!}
                        {!! Form::text('tara', null, ['class' => 'form-control', 'required', 'placeholder' => 'Tara', 'data-mask="0000000"' ]); !!}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::label('capacidade', 'Capacidade' . ':*') !!}
                        {!! Form::text('capacidade', null, ['class' => 'form-control', 'required', 'placeholder' => 'Capacidade', 'data-mask="0000000"' ]); !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('proprietario_nome', 'Nome Proprietário' . ':*') !!}
                        {!! Form::text('proprietario_nome', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nome Proprietário' ]); !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('proprietario_documento', 'Documento Proprietário' . ':*') !!}
                        {!! Form::text('proprietario_documento', null, ['class' => 'form-control cpf_cnpj', 'required', 'placeholder' => 'Documento Proprietário' ]); !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('proprietario_ie', 'I.E Proprietário' . '*:') !!}
                        {!! Form::text('proprietario_ie', null, ['class' => 'form-control', 'required', 'placeholder' => 'I.E Proprietário' ]); !!}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::label('proprietario_uf', 'Proprietário UF' . ':*') !!}
                        {!! Form::select('proprietario_uf', $ufs, '', ['class' => 'form-control select2', 'id' => 'contact_type', 'required']); !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('proprietario_tp', 'Tipo de Proprietário' . ':*') !!}
                        {!! Form::select('proprietario_tp', $tiposProprietario, '', ['class' => 'form-control select2', 'id' => 'contact_type', 'required']); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('rntrc', 'RNTRC' . '*:') !!}
                        {!! Form::text('rntrc', null, ['class' => 'form-control', 'required, minlength:8', 'placeholder' => 'RNTRC', 'required' ]); !!}
                    </div>
                </div>
            </div>

            @if(!empty($form_partials))
            @foreach($form_partials as $partial)
            {!! $partial !!}
            @endforeach
            @endif

            <div class="sa-form-actions">
                {!! Form::submit(__('messages.save'), ['class' => 'sa-btn-pill sa-btn-pill-primary', 'id' => 'submit_button']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</section>
@stop
@section('javascript')
<script type="text/javascript">
    $(document).on('click', '#submit_button', function(e) {
        e.preventDefault();

        $('form#veiculo_form').validate()
        if ($('form#veiculo_form').valid()) {
            $('form#veiculo_form').submit();
        }
    })
</script>
@endsection
