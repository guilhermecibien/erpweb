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
            @php
            $__f1 = ['options' => ['url' => action('VeiculoController@save'), 'method' => 'post', 'id' => 'veiculo_form' ]];
            @endphp
            <x-form.open :options="$__f1['options']" />

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f2 = ['name' => 'placa', 'value' => 'Placa' . ':*'];
                        @endphp
                        <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
                        @php
                        $__f3 = ['name' => 'placa', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Placa', 'data-mask="AAA-AAAA"' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        @php
                        $__f4 = ['name' => 'uf', 'value' => 'UF' . ':*'];
                        @endphp
                        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
                        @php
                        $__f5 = ['name' => 'uf', 'list' => $ufs, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'contact_type', 'required']];
                        @endphp
                        <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f6 = ['name' => 'modelo', 'value' => 'Modelo' . ':*'];
                        @endphp
                        <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
                        @php
                        $__f7 = ['name' => 'modelo', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Modelo' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f8 = ['name' => 'marca', 'value' => 'Marca' . ':*'];
                        @endphp
                        <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
                        @php
                        $__f9 = ['name' => 'marca', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Marca' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        @php
                        $__f10 = ['name' => 'cor', 'value' => 'Cor' . ':*'];
                        @endphp
                        <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
                        @php
                        $__f11 = ['name' => 'cor', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Cor' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        @php
                        $__f12 = ['name' => 'tipo_carroceira', 'value' => 'Tipo da carroceria' . ':*'];
                        @endphp
                        <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
                        @php
                        $__f13 = ['name' => 'tipo_carroceira', 'list' => $tiposCarroceria, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'contact_type', 'required']];
                        @endphp
                        <x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        @php
                        $__f14 = ['name' => 'tipo_rodado', 'value' => 'Tipo de rodado' . ':*'];
                        @endphp
                        <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
                        @php
                        $__f15 = ['name' => 'tipo_rodado', 'list' => $tiposRodado, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'contact_type', 'required']];
                        @endphp
                        <x-form.select :name="$__f15['name']" :list="$__f15['list']" :selected="$__f15['selected']" :options="$__f15['options']" />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        @php
                        $__f16 = ['name' => 'tara', 'value' => 'Tara' . ':*'];
                        @endphp
                        <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
                        @php
                        $__f17 = ['name' => 'tara', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Tara', 'data-mask="0000000"' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        @php
                        $__f18 = ['name' => 'capacidade', 'value' => 'Capacidade' . ':*'];
                        @endphp
                        <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
                        @php
                        $__f19 = ['name' => 'capacidade', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Capacidade', 'data-mask="0000000"' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f20 = ['name' => 'proprietario_nome', 'value' => 'Nome Proprietário' . ':*'];
                        @endphp
                        <x-form.label :name="$__f20['name']" :value="$__f20['value']" />
                        @php
                        $__f21 = ['name' => 'proprietario_nome', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Nome Proprietário' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f21['name']" :value="$__f21['value']" :options="$__f21['options']" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f22 = ['name' => 'proprietario_documento', 'value' => 'Documento Proprietário' . ':*'];
                        @endphp
                        <x-form.label :name="$__f22['name']" :value="$__f22['value']" />
                        @php
                        $__f23 = ['name' => 'proprietario_documento', 'value' => null, 'options' => ['class' => 'form-control cpf_cnpj', 'required', 'placeholder' => 'Documento Proprietário' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f23['name']" :value="$__f23['value']" :options="$__f23['options']" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f24 = ['name' => 'proprietario_ie', 'value' => 'I.E Proprietário' . '*:'];
                        @endphp
                        <x-form.label :name="$__f24['name']" :value="$__f24['value']" />
                        @php
                        $__f25 = ['name' => 'proprietario_ie', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'I.E Proprietário' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f25['name']" :value="$__f25['value']" :options="$__f25['options']" />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        @php
                        $__f26 = ['name' => 'proprietario_uf', 'value' => 'Proprietário UF' . ':*'];
                        @endphp
                        <x-form.label :name="$__f26['name']" :value="$__f26['value']" />
                        @php
                        $__f27 = ['name' => 'proprietario_uf', 'list' => $ufs, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'contact_type', 'required']];
                        @endphp
                        <x-form.select :name="$__f27['name']" :list="$__f27['list']" :selected="$__f27['selected']" :options="$__f27['options']" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f28 = ['name' => 'proprietario_tp', 'value' => 'Tipo de Proprietário' . ':*'];
                        @endphp
                        <x-form.label :name="$__f28['name']" :value="$__f28['value']" />
                        @php
                        $__f29 = ['name' => 'proprietario_tp', 'list' => $tiposProprietario, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'contact_type', 'required']];
                        @endphp
                        <x-form.select :name="$__f29['name']" :list="$__f29['list']" :selected="$__f29['selected']" :options="$__f29['options']" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f30 = ['name' => 'rntrc', 'value' => 'RNTRC' . '*:'];
                        @endphp
                        <x-form.label :name="$__f30['name']" :value="$__f30['value']" />
                        @php
                        $__f31 = ['name' => 'rntrc', 'value' => null, 'options' => ['class' => 'form-control', 'required, minlength:8', 'placeholder' => 'RNTRC', 'required' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f31['name']" :value="$__f31['value']" :options="$__f31['options']" />
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
                $__f32 = ['value' => __('messages.save'), 'options' => ['class' => 'sa-btn-pill sa-btn-pill-primary', 'id' => 'submit_button']];
                @endphp
                <x-form.submit :value="$__f32['value']" :options="$__f32['options']" />
            </div>
            <x-form.close />
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
