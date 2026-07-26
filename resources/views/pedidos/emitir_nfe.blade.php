@extends('layouts.app')

@section('title', 'Pedido')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Pedido {{$pedido->id}}</h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">



    <form method="post" action="/pedidosEcommerce/salvarVenda">

      @if(count($business_locations) == 1)
      @php 
      $default_location = current(array_keys($business_locations->toArray()));
      $search_disable = false; 
      @endphp
      @else
      @php $default_location = null;
      $search_disable = true;
      @endphp
      @endif
      <div class="col-sm-3">
        <div class="form-group">
          @php
          $__f1 = ['name' => 'location_id', 'value' => __('purchase.business_location').':*'];
          @endphp
          <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
          @show_tooltip(__('tooltip.purchase_location'))
          @php
          $__f2 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => $default_location, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
          @endphp
          <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
        </div>
      </div>
      <div class="clearfix"></div>
      
      @csrf
      <input type="hidden" value="{{$pedido->id}}" name="id">

      <div class="col-sm-6">
        @component('components.widget')

        <h3>Dados do cliente</h3>
        <div class="col-md-12">
          <h4>Cliente: <strong>{{$pedido->cliente->nome}} {{$pedido->cliente->sobre_nome}}</strong></h4>
          <h4>CPF: <strong>{{$pedido->cliente->cpf}}</strong></h4>
          <h4>Email: <strong>{{$pedido->cliente->email}}</strong></h4>
          <h4>Telefone: <strong>{{$pedido->cliente->telefone}}</strong></h4>
          <a href="/clienteEcommerce/edit/{{$pedido->cliente->id}}" class="btn btn-primary">
            <i class="fa fa-edit"></i>
          </a>
        </div>
        
        @endcomponent
      </div>

      <div class="col-sm-6">
        @component('components.widget')

        <h3>Endereço de entrega</h3>
        <div class="col-md-12">
          <h4>Rua: <strong>{{$pedido->endereco->rua}}, {{$pedido->endereco->numero}}</strong></h4>
          <h4>Bairro: <strong>{{$pedido->endereco->bairro}} - {{$pedido->endereco->complemento}}</strong></h4>
          <h4>Cep: <strong>{{$pedido->endereco->cep}}</strong></h4>
          <h4>Cidade: <strong>{{$pedido->endereco->cidade}} ({{$pedido->endereco->uf}})</strong></h4>
          <a href="/enderecosEcommerce/edit/{{$pedido->endereco->id}}" class="btn btn-primary">
            <i class="fa fa-edit"></i>
          </a>
        </div>
        @endcomponent

      </div>


      <div class="col-sm-12">
        @component('components.widget')

        
        <div class="col-md-3 customer_fields">
          <div class="form-group">

            @php
            $__f3 = ['name' => 'natureza', 'value' => 'Natureza de Operação' . ':'];
            @endphp
            <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
            @php
            $__f4 = ['name' => 'natureza', 'list' => $naturezas, 'selected' => '', 'options' => ['id' => 'tipo', 'class' => 'form-control select2', 'required']];
            @endphp
            <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
          </div>
        </div>

        <div class="col-md-3 customer_fields">
          <div class="form-group">

            @php
            $__f5 = ['name' => 'transportadora', 'value' => 'Transportadora' . ':'];
            @endphp
            <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
            @php
            $__f6 = ['name' => 'transportadora', 'list' => $transportadoras, 'selected' => '', 'options' => ['id' => 'tipo', 'class' => 'form-control select2']];
            @endphp
            <x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
          </div>
        </div>

        <div class="col-md-3 customer_fields">
          <div class="form-group">

            @php
            $__f7 = ['name' => 'frete', 'value' => 'Tipo frete' . ':'];
            @endphp
            <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
            @php
            $__f8 = ['name' => 'frete', 'list' => $tiposFrete, 'selected' => '', 'options' => ['id' => 'tipo', 'class' => 'form-control select2', 'required']];
            @endphp
            <x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            @php
            $__f9 = ['name' => 'valor_frete', 'value' => 'Valor do frete' . ':*'];
            @endphp
            <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
            @php
            $__f10 = ['name' => 'valor_frete', 'value' => $pedido->valor_frete, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Valor do frete' ]];
            @endphp
            <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            @php
            $__f11 = ['name' => 'placa', 'value' => 'Placa Veiculo' . ':*'];
            @endphp
            <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
            @php
            $__f12 = ['name' => 'placa', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Placa Veiculo', 'data-mask="AAA-AAAA"', 'data-mask-reverse="true"']];
            @endphp
            <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
          </div>
        </div>

        <div class="col-md-2 customer_fields">
          <div class="form-group">

            @php
            $__f13 = ['name' => 'uf_placa', 'value' => 'UF' . ':'];
            @endphp
            <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
            @php
            $__f14 = ['name' => 'uf_placa', 'list' => $ufs, 'selected' => '', 'options' => ['id' => 'tipo', 'class' => 'form-control select2']];
            @endphp
            <x-form.select :name="$__f14['name']" :list="$__f14['list']" :selected="$__f14['selected']" :options="$__f14['options']" />
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            @php
            $__f15 = ['name' => 'qtd_volumes', 'value' => 'Qtd Volumes' . ':*'];
            @endphp
            <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
            @php
            $__f16 = ['name' => 'qtd_volumes', 'value' => '1', 'options' => ['class' => 'form-control', 'placeholder' => 'Qtd Volumes']];
            @endphp
            <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            @php
            $__f17 = ['name' => 'numeracao_volumes', 'value' => 'Num. Volumes' . ':*'];
            @endphp
            <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
            @php
            $__f18 = ['name' => 'numeracao_volumes', 'value' => '1', 'options' => ['class' => 'form-control', 'placeholder' => 'Num. Volumes']];
            @endphp
            <x-form.input type="text" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            @php
            $__f19 = ['name' => 'especie', 'value' => 'Espécie' . ':*'];
            @endphp
            <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
            @php
            $__f20 = ['name' => 'especie', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Espécie']];
            @endphp
            <x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            @php
            $__f21 = ['name' => 'peso_liquido', 'value' => 'Peso liquído' . ':*'];
            @endphp
            <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
            @php
            $__f22 = ['name' => 'peso_liquido', 'value' => number_format($pedido->somaPeso(), 3), 'options' => ['class' => 'form-control', 'placeholder' => 'Peso liquído', 'data-mask="00000,000"', 'data-mask-reverse="true"']];
            @endphp
            <x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            @php
            $__f23 = ['name' => 'peso_bruto', 'value' => 'Peso bruto' . ':*'];
            @endphp
            <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
            @php
            $__f24 = ['name' => 'peso_bruto', 'value' => number_format($pedido->somaPeso(), 3), 'options' => ['class' => 'form-control', 'placeholder' => 'Peso bruto', 'data-mask="00000,000"', 'data-mask-reverse="true"']];
            @endphp
            <x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
          </div>
        </div>

        <div class="col-sm-12">
          <h3>Total do pedido: <strong>R$ {{ number_format($pedido->valor_total, 2, ',', '.')}}</strong></h3>
        </div>

        @endcomponent
      </div>



      <div class="col-sm-12">
        @if(sizeof($erros) == 0)
        <button class="btn btn-success btn-lg">
          <i class="fa fa-check"></i>
          Salvar
        </button>

        @else
        @foreach($erros as $e)
        <p>
          <span class="label label-xl label-inline label-light-danger">
            {{$e}}
          </span>
        </p>
        @endforeach
        @endif
      </div>

    </form>

  </div>
</section>


@stop



@section('javascript')

<script type="text/javascript">
  var path = window.location.protocol + '//' + window.location.host


</script>

@endsection
