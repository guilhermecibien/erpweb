@extends('layouts.app')

@section('title', 'Gerar boleto')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Gerar boletos</h1>
</section>

<!-- Main content -->
<section class="content">
  @php
  $__f1 = ['options' => ['url' => action('BoletoController@storeMulti'), 'method' => 'post', 'id' => 'boleto_form' ]];
  @endphp
  <x-form.open :options="$__f1['options']" />
  <div class="row">
    <div class="col-md-12">
      @component('components.widget', ['class' => 'box-primary'])
      
      <div class="clearfix"></div>
      <hr>

      <p style="margin-left: 10px;" class="text-danger col-12"><i class="glyphicon glyphicon-info-sign text-danger"></i> Após gerar o boleto não será possível editar os dados da conta a receber.</p>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f2 = ['name' => 'banco', 'value' => 'Banco' . ':*'];
          @endphp
          <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'banco', 'list' => ['' => 'Selecione uma conta bancária'] + $banks->pluck('info', 'id')->all(), 'selected' => '', 'options' => ['id' => 'banco', 'class' => 'form-control select2', 'required']];
          @endphp
          <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f4 = ['name' => 'carteira', 'value' => 'Carteira' . '*:'];
          @endphp
          <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'carteira', 'value' => $padrao ? $padrao->carteira : '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Carteira' ]];
          @endphp
          <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f6 = ['name' => 'tipo', 'value' => 'Tipo' . ':'];
          @endphp
          <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
          @php
          $__f7 = ['name' => 'tipo', 'list' => ['Cnab400' => 'Cnab400', 'Cnab240' => 'Cnab240'], 'selected' => $padrao ? $padrao->tipo : '', 'options' => ['id' => 'tipo', 'class' => 'form-control', 'required']];
          @endphp
          <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
        </div>
      </div>
      
      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f8 = ['name' => 'logo', 'value' => 'Usar logo' . ':'];
          @endphp
          <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
          @php
          $__f9 = ['name' => 'logo', 'list' => ['0' => 'Não', '1' => 'Sim'], 'selected' => '', 'options' => ['id' => 'logo', 'class' => 'form-control', 'required']];
          @endphp
          <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f10 = ['name' => 'convenio', 'value' => 'Convênio' . '*:'];
          @endphp
          <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
          @php
          $__f11 = ['name' => 'convenio', 'value' => $padrao ? $padrao->convenio : '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Convênio', 'minlength' => '4']];
          @endphp
          <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />

          @if($errors->has('convenio'))
          <span class="text-danger">
            {{ $errors->first('convenio') }}
          </span>
          @endif
        </div>
      </div>

      <div class="clearfix"></div>
      <hr>

      @foreach($contas as $key => $c)
      @component('components.widget', ['class' => 'box-danger'])

      <div class="col-md-6">
        <div class="form-group">
          @php
          $__f12 = ['name' => 'info', 'value' => 'Cliente' . '*:'];
          @endphp
          <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
          @php
          $__f13 = ['name' => 'info', 'value' => $c->contact->name . " | CPF/CNPJ: " . $c->contact->cpf_cnpj, 'options' => ['class' => 'form-control', 'required', 'readonly']];
          @endphp
          <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f14 = ['name' => 'valor', 'value' => 'Valor' . '*:'];
          @endphp
          <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
          @php
          $__f15 = ['name' => 'valor', 'value' => number_format($c->valor_total, 2, ',', '.'), 'options' => ['class' => 'form-control', 'required', 'readonly']];
          @endphp
          <x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f16 = ['name' => 'vencimento', 'value' => 'Vencimento' . '*:'];
          @endphp
          <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
          @php
          $__f17 = ['name' => 'vencimento', 'value' => \Carbon\Carbon::parse($c->vencimento)->format('d/m/Y'), 'options' => ['class' => 'form-control', 'required', 'readonly']];
          @endphp
          <x-form.input type="text" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f18 = ['name' => 'numero', 'value' => 'Nº do boleto' . '*:'];
          @endphp
          <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
          @php
          $__f19 = ['name' => "payment[$key][numero]", 'value' => old('numero'), 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Nº do boleto', 'data-mask="00000000"' ]];
          @endphp
          <x-form.input type="text" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f20 = ['name' => 'numero_documento', 'value' => 'Nº do documento' . '*:'];
          @endphp
          <x-form.label :name="$__f20['name']" :value="$__f20['value']" />
          @php
          $__f21 = ['name' => "payment[$key][numero_documento]", 'value' => old('numero_documento'), 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Nº do documento', 'data-mask="00000000"' ]];
          @endphp
          <x-form.input type="text" :name="$__f21['name']" :value="$__f21['value']" :options="$__f21['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f22 = ['name' => 'juros', 'value' => 'Juros' . '*:'];
          @endphp
          <x-form.label :name="$__f22['name']" :value="$__f22['value']" />
          @php
          $__f23 = ['name' => "payment[$key][juros]", 'value' => $padrao ? $padrao->juros : '', 'options' => ['class' => 'form-control money juros', 'required', 'placeholder' => 'Juros' ]];
          @endphp
          <x-form.input type="text" :name="$__f23['name']" :value="$__f23['value']" :options="$__f23['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f24 = ['name' => 'multa', 'value' => 'Multa' . '*:'];
          @endphp
          <x-form.label :name="$__f24['name']" :value="$__f24['value']" />
          @php
          $__f25 = ['name' => "payment[$key][multa]", 'value' => $padrao ? $padrao->multa : '', 'options' => ['class' => 'form-control money multa', 'required', 'placeholder' => 'Multa' ]];
          @endphp
          <x-form.input type="text" :name="$__f25['name']" :value="$__f25['value']" :options="$__f25['options']" />
        </div>
      </div>


      @php
      $__f26 = ['name' => "payment[$key][id]", 'value' => $c->id, 'options' => ['class' => '', 'required', 'placeholder' => 'Multa', 'style' => 'display: none' ]];
      @endphp
      <x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />


      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f27 = ['name' => 'juros_apos', 'value' => 'Juros após (dias)' . '*:'];
          @endphp
          <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
          @php
          $__f28 = ['name' => "payment[$key][juros_apos]", 'value' => $padrao ? $padrao->juros_apos : '', 'options' => ['class' => 'form-control money juros_apos', 'required', 'placeholder' => 'Juros após (dias)' ]];
          @endphp
          <x-form.input type="text" :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
        </div>
      </div>

      @endcomponent
      @endforeach
      @endcomponent
    </div>

  </div>

  <div class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary pull-right" id="submit_button">Gerar Boletos</button>
    </div>
  </div>
  <x-form.close />
  @stop 
</section>

@section('javascript')
<script type="text/javascript">
  $(document).ready(function(){
  });
  $(document).on('click', '#submit_button', function(e) {
    e.preventDefault();

    $('form#boleto_form').validate()
    if ($('form#boleto_form').valid()) {
      $('form#boleto_form').submit();
    }
  })

  $('#banco').change(() => {
    var path = window.location.protocol + '//' + window.location.host

    let banco = $('#banco').val()
    $.get(path + '/api/bank/'+banco)
    .done((res) => {
      console.log(res)
      $('#carteira').val(res.carteira)
      $('#convenio').val(res.convenio)
      $('.multa').val(res.multa)
      $('.juros_apos').val(res.juros_apos)
      $('.juros').val(res.juros)
      $('#tipo').val(res.tipo).change()
    })
    .fail((err) => {
      console.log(err)
    })
  })
</script>
@endsection

