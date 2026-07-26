@extends('layouts.app')

@section('title', 'Endereço')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Editar Endereço Ecommerce</h1>
</section>

<!-- Main content -->
<section class="content">
  @php
  $__f1 = ['options' => ['url' => action('EnderecoEcommerceController@update'), 'method' => 'post', 'id' => 'natureza_add_form' ]];
  @endphp
  <x-form.open :options="$__f1['options']" />
  <div class="row">
    <div class="col-md-12">
      @component('components.widget')
      <input type="hidden" name="id" value="{{$endereco->id}}">
      <div class="col-md-6">
        <div class="form-group">
          @php
          $__f2 = ['name' => 'rua', 'value' => 'Rua' . ':*'];
          @endphp
          <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'rua', 'value' => $endereco->rua, 'options' => ['class' => 'form-control', 'placeholder' => 'Rua' ]];
          @endphp
          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          @if($errors->has('rua'))
          <span class="text-danger">
            {{ $errors->first('rua') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f4 = ['name' => 'numero', 'value' => 'Número' . ':*'];
          @endphp
          <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'numero', 'value' => $endereco->numero, 'options' => ['class' => 'form-control', 'placeholder' => 'Número' ]];
          @endphp
          <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
          @if($errors->has('numero'))
          <span class="text-danger">
            {{ $errors->first('numero') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f6 = ['name' => 'bairro', 'value' => 'Bairro' . ':*'];
          @endphp
          <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
          @php
          $__f7 = ['name' => 'bairro', 'value' => $endereco->bairro, 'options' => ['class' => 'form-control', 'placeholder' => 'Bairro' ]];
          @endphp
          <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
          @if($errors->has('bairro'))
          <span class="text-danger">
            {{ $errors->first('bairro') }}
          </span>
          @endif
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-4 customer_fields">
        <div class="form-group">
          @php
          $__f8 = ['name' => 'city_id', 'value' => 'Cidade:*'];
          @endphp
          <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
          @php
          $__f9 = ['name' => 'city_id', 'list' => $cities, 'selected' => $cidade->id, 'options' => ['id' => 'cidade', 'class' => 'form-control select2', 'required']];
          @endphp
          <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f10 = ['name' => 'cep', 'value' => 'CEP' . ':*', 'options' => ['id' => 'lbl_doc']];
          @endphp
          <x-form.label :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
          @php
          $__f11 = ['name' => 'cep', 'value' => $endereco->cep, 'options' => ['class' => 'form-control', 'placeholder' => 'CEP', 'data-mask="00000-000"', 'data-mask-reverse="true"', 'id' => 'doc' ]];
          @endphp
          <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
          @if($errors->has('cep'))
          <span class="text-danger">
            {{ $errors->first('cep') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-5">
        <div class="form-group">
          @php
          $__f12 = ['name' => 'complemento', 'value' => 'Complemento' . ':*'];
          @endphp
          <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
          @php
          $__f13 = ['name' => 'complemento', 'value' => $endereco->complemento, 'options' => ['class' => 'form-control', 'placeholder' => 'Complemento' ]];
          @endphp
          <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
          @if($errors->has('complemento'))
          <span class="text-danger">
            {{ $errors->first('complemento') }}
          </span>
          @endif
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
  
