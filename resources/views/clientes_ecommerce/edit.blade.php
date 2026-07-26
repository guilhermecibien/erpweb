@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Editar Cliente Ecommerce</h1>
</section>

<!-- Main content -->
<section class="content">
  @php
  $__f1 = ['options' => ['url' => action('ClienteEcommerceController@update', [$cliente->id]), 'method' => 'PUT', 'id' => 'natureza_add_form' ]];
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
          $__f3 = ['name' => 'nome', 'value' => $cliente->nome, 'options' => ['class' => 'form-control', 'placeholder' => 'Nome' ]];
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
          $__f5 = ['name' => 'sobre_nome', 'value' => $cliente->sobre_nome, 'options' => ['class' => 'form-control', 'placeholder' => 'Sobre Nome' ]];
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
          $__f7 = ['name' => 'email', 'value' => $cliente->email, 'options' => ['class' => 'form-control', 'placeholder' => 'Email' ]];
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
          $__f9 = ['name' => 'tipo', 'list' => ['f' => 'Fisica', 'j' => 'Juridica'], 'selected' => $tipo, 'options' => ['id' => 'tipo', 'class' => 'form-control select2', 'id' => 'tipo']];
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
          $__f11 = ['name' => 'cpf', 'value' => $cliente->cpf, 'options' => ['class' => 'form-control', 'placeholder' => 'CPF', 'id' => 'doc' ]];
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
          $__f12 = ['name' => 'ie', 'value' => 'IE' . ':*', 'options' => ['id' => 'lbl_ie']];
          @endphp
          <x-form.label :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
          @php
          $__f13 = ['name' => 'ie', 'value' => $cliente->ie, 'options' => ['class' => 'form-control', 'placeholder' => 'IE', 'id' => 'ie' ]];
          @endphp
          <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
          @if($errors->has('ie'))
          <span class="text-danger">
            {{ $errors->first('ie') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f14 = ['name' => 'telefone', 'value' => 'Telefone' . ':*'];
          @endphp
          <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
          @php
          $__f15 = ['name' => 'telefone', 'value' => $cliente->telefone, 'options' => ['class' => 'form-control', 'placeholder' => 'Telefone', 'data-mask="00 00000-0000"', 'data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
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
          $__f16 = ['name' => 'senha', 'value' => 'Senha' . ':*'];
          @endphp
          <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
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
          $__f17 = ['name' => 'status', 'value' => 'Ativo' . ':'];
          @endphp
          <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
          @php
          $__f18 = ['name' => 'status', 'list' => ['1' => 'Sim', '0' => 'Não'], 'selected' => $cliente->status, 'options' => ['id' => 'tipo', 'class' => 'form-control select2', 'required']];
          @endphp
          <x-form.select :name="$__f18['name']" :list="$__f18['list']" :selected="$__f18['selected']" :options="$__f18['options']" />
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
      <button type="submit" class="btn btn-primary pull-right" id="submit_user_button">
        Atualizar
      </button>
    </div>
  </div>
  <x-form.close />
  @stop
  @section('javascript')
  <script type="text/javascript">
    $(function(){
      changeTipo()
    })
    $('#tipo').change(() => {
      changeTipo()
    })

    function changeTipo(){
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
    }

  </script>
  @endsection
