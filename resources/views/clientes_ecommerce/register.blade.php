@extends('layouts.app')

@section('title', 'Adicionar Cliente')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Adicionar Cliente Ecommerce</h1>
</section>

<!-- Main content -->
<section class="content">
  @php
  $__f1 = ['options' => ['url' => action('ClienteEcommerceController@save'), 'method' => 'post', 'id' => 'natureza_add_form' ]];
  @endphp
  <x-form.open :options="$__f1['options']" />
  <div class="row">
    <div class="col-md-12">
      @component('components.widget')
      
      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f2 = ['name' => 'nome', 'value' => 'Nome' . ':*'];
          @endphp
          <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'nome', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Nome' ]];
          @endphp
          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          @if($errors->has('nome'))
          <span class="text-danger">
            {{ $errors->first('nome') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f4 = ['name' => 'sobre_nome', 'value' => 'Sobre Nome' . ':*'];
          @endphp
          <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'sobre_nome', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Sobre Nome' ]];
          @endphp
          <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
          @if($errors->has('sobre_nome'))
          <span class="text-danger">
            {{ $errors->first('sobre_nome') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f6 = ['name' => 'email', 'value' => 'Email' . ':*'];
          @endphp
          <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
          @php
          $__f7 = ['name' => 'email', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Email' ]];
          @endphp
          <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
          @if($errors->has('email'))
          <span class="text-danger">
            {{ $errors->first('email') }}
          </span>
          @endif
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-2 customer_fields">
        <div class="form-group">

          @php
          $__f8 = ['name' => 'tipo', 'value' => 'Tipo' . ':'];
          @endphp
          <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
          @php
          $__f9 = ['name' => 'tipo', 'list' => ['f' => 'Fisica', 'j' => 'Juridica'], 'selected' => '', 'options' => ['id' => 'tipo', 'class' => 'form-control select2', 'id' => 'tipo']];
          @endphp
          <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f10 = ['name' => 'cpf', 'value' => 'CPF' . ':*', 'options' => ['id' => 'lbl_doc']];
          @endphp
          <x-form.label :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
          @php
          $__f11 = ['name' => 'cpf', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'CPF', 'data-mask="000.000.000-00"', 'data-mask-reverse="true"', 'id' => 'doc' ]];
          @endphp
          <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
          @if($errors->has('cpf'))
          <span class="text-danger">
            {{ $errors->first('cpf') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f12 = ['name' => 'telefone', 'value' => 'Telefone' . ':*'];
          @endphp
          <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
          @php
          $__f13 = ['name' => 'telefone', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Telefone', 'data-mask="00 00000-0000"', 'data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
          @if($errors->has('telefone'))
          <span class="text-danger">
            {{ $errors->first('telefone') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f14 = ['name' => 'senha', 'value' => 'Senha' . ':*'];
          @endphp
          <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
          <input type="password" name="senha" class="form-control">
          @if($errors->has('senha'))
          <span class="text-danger">
            {{ $errors->first('senha') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-2 customer_fields">
        <div class="form-group">

          @php
          $__f15 = ['name' => 'status', 'value' => 'Ativo' . ':'];
          @endphp
          <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
          @php
          $__f16 = ['name' => 'status', 'list' => ['1' => 'Sim', '0' => 'Não'], 'selected' => '', 'options' => ['id' => 'tipo', 'class' => 'form-control select2', 'required']];
          @endphp
          <x-form.select :name="$__f16['name']" :list="$__f16['list']" :selected="$__f16['selected']" :options="$__f16['options']" />
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
      <button type="submit" class="btn btn-primary pull-right" id="submit_user_button">@lang( 'messages.save' )</button>
    </div>
  </div>
  <x-form.close />
  @stop
  @section('javascript')
  <script type="text/javascript">
    $('#tipo').change(() => {
      let t = $('#tipo').val()
      if(t == 'f'){
        $('#lbl_doc').html('CPF:*')
        $('#doc').mask('000.000.000-00', {reverse: true});
        $('#doc').attr({placeholder:"CPF"})
      }else{
        $('#lbl_doc').html('CNPJ:*')
        $('#doc').mask('00.000.000/0000-00', {reverse: true});
        $('#doc').attr({placeholder:"CNPJ"})

      }
    })

  </script>
  @endsection
