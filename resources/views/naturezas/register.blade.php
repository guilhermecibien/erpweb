@extends('layouts.app')

@section('title', 'Adicionar Natureza de Operação')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Adicionar Natureza de Operação</h1>
</section>

<!-- Main content -->
<section class="content">
  @php
  $__f1 = ['options' => ['url' => action('NaturezaController@save'), 'method' => 'post', 'id' => 'natureza_form' ]];
  @endphp
  <x-form.open :options="$__f1['options']" />
  <div class="row">
    <div class="col-md-12">
      @component('components.widget', ['class' => 'box-primary'])
      
      <div class="col-md-5">
        <div class="form-group">
          @php
          $__f2 = ['name' => 'natureza', 'value' => 'Natureza' . ':*'];
          @endphp
          <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'natureza', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Natureza' ]];
          @endphp
          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
        </div>
      </div>

      <div class="col-md-3 customer_fields">
        <div class="form-group">

          @php
          $__f4 = ['name' => 'sobrescreve_cfop', 'value' => 'Sobrescrever CFOP do produto' . ':'];
          @endphp
          <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'sobrescreve_cfop', 'list' => ['0' => 'Não', '1' => 'Sim'], 'selected' => '', 'options' => ['id' => 'sobrescreve_cfop', 'class' => 'form-control select2', 'required']];
          @endphp
          <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
        </div>
      </div>

      <div class="col-md-2 customer_fields">
        <div class="form-group">

          @php
          $__f6 = ['name' => 'finNFe', 'value' => 'Finalidade' . ':'];
          @endphp
          <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
          @php
          $__f7 = ['name' => 'finNFe', 'list' => App\Models\NaturezaOperacao::finalidades(), 'selected' => '', 'options' => ['id' => 'finNFe', 'class' => 'form-control select2', 'required']];
          @endphp
          <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
        </div>
      </div>

      <div class="col-md-2 customer_fields">
        <div class="form-group">

          @php
          $__f8 = ['name' => 'tipo', 'value' => 'Tipo' . ':'];
          @endphp
          <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
          @php
          $__f9 = ['name' => 'tipo', 'list' => ['1' => 'Saída', '0' => 'Entrada'], 'selected' => '', 'options' => ['id' => 'tipo', 'class' => 'form-control select2', 'required']];
          @endphp
          <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
        </div>
      </div>
      
      <div class="clearfix"></div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f10 = ['name' => 'cfop_entrada_estadual', 'value' => 'CFOP entrada estadual' . '*:'];
          @endphp
          <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
          @php
          $__f11 = ['name' => 'cfop_entrada_estadual', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CFOP entrada estadual', 'data-mask="0000"' ]];
          @endphp
          <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f12 = ['name' => 'cfop_saida_estadual', 'value' => 'CFOP saida estadual' . '*:'];
          @endphp
          <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
          @php
          $__f13 = ['name' => 'cfop_saida_estadual', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CFOP saida estadual', 'data-mask="0000"' ]];
          @endphp
          <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f14 = ['name' => 'cfop_entrada_inter_estadual', 'value' => 'CFOP entrada outro estado' . '*:'];
          @endphp
          <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
          @php
          $__f15 = ['name' => 'cfop_entrada_inter_estadual', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CFOP entrada outro estado', 'data-mask="0000"' ]];
          @endphp
          <x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f16 = ['name' => 'cfop_saida_inter_estadual', 'value' => 'CFOP saida outro estado' . '*:'];
          @endphp
          <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
          @php
          $__f17 = ['name' => 'cfop_saida_inter_estadual', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CFOP saida outro estado', 'data-mask="0000"' ]];
          @endphp
          <x-form.input type="text" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
        </div>
      </div>

      @endcomponent
    </div>

  </div>

  @if(!empty($form_partials))
  @foreach($form_partials as $partial)
  {!! $partial !!}
  @endforeach
  @endif
  <div class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary pull-right" id="submit_button">@lang( 'messages.save' )</button>
    </div>
  </div>
  <x-form.close />
  @stop
  @section('javascript')
  <script type="text/javascript">
    $(document).ready(function(){
    });
    $(document).on('click', '#submit_button', function(e) {
      e.preventDefault();

      $('form#natureza_form').validate()
      if ($('form#natureza_form').valid()) {
        $('form#natureza_form').submit();
      }
    })

    $('#cfop_entrada_estadual').blur(() => {
      let cfop = $('#cfop_entrada_estadual').val()
      if(cfop.length == 4){
        let temp = cfop.substring(1,4)
        $('#cfop_saida_estadual').val('5'+temp)
        $('#cfop_entrada_inter_estadual').val('2'+temp)
        $('#cfop_saida_inter_estadual').val('6'+temp)
      }
    })
  </script>
  @endsection
