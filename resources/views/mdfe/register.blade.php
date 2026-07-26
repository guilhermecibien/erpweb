@extends('layouts.app')
@if($mdfe != null)
@section('title', 'Editar MDFe')
@else
@section('title', 'Adicionar MDFe')
@endif

@section('content')
<style type="text/css">
  .fa-trash:hover{
    cursor: pointer;
  }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  @if($mdfe != null)
  <h1>Editar </h1>
  @else
  <h1>Adicionar </h1>

  @endif
</section>

<!-- Main content -->
<section class="content">
  @if($mdfe != null)
  @php
  $__f1 = ['options' => ['url' => action('MdfeController@update'), 'method' => 'post', 'id' => 'mdfe_add_form' ]];
  @endphp
  <x-form.open :options="$__f1['options']" />
  @else
  @php
  $__f2 = ['options' => ['url' => action('MdfeController@save'), 'method' => 'post', 'id' => 'mdfe_add_form' ]];
  @endphp
  <x-form.open :options="$__f2['options']" />
  @endif
  <div class="row">
    <div class="col-md-12">
      @component('components.widget')


      <div class="col-md-2">
        <div class="form-group">
          <h4>Ultima MDFe: <strong>{{$lastMdfe}}</strong></h4>
        </div>
      </div>

      <input type="hidden" id="clientesAux" value="{{json_encode($clientesAux)}}" name="">

      <div class="clearfix"></div>

      @if(is_null($default_location))

      <div class="col-md-4">
        <br>
        <div class="form-group" style="margin-top: 8px;">
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-map-marker"></i>
            </span>
            @php
            $__f3 = ['name' => 'select_location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.select_location'), 'id' => 'select_location_id', 'required', 'autofocus'], 'optionsAttributes' => $bl_attributes];
            @endphp
            <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" :options-attributes="$__f3['optionsAttributes']" />
            <span class="input-group-addon">
              @show_tooltip('Local da MDFe')
            </span> 
          </div>
        </div>

      </div>
      @endif

      <div class="clearfix"></div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f4 = ['name' => 'uf_inicio', 'value' => 'UF início' . ':*'];
          @endphp
          <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'uf_inicio', 'list' => $ufs, 'selected' => $mdfe != null ? $mdfe->uf_inicio : '', 'options' => ['class' => 'form-control select2', 'id' => 'uf_inicio', 'required', 'placeholder' => 'Selecione a UF']];
          @endphp
          <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f6 = ['name' => 'uf_fim', 'value' => 'UF fim' . ':*'];
          @endphp
          <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
          @php
          $__f7 = ['name' => 'uf_fim', 'list' => $ufs, 'selected' => $mdfe != null ? $mdfe->uf_fim : '', 'options' => ['class' => 'form-control select2', 'id' => 'uf_fim', 'required', 'placeholder' => 'Selecione a UF']];
          @endphp
          <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f8 = ['name' => 'data_inicio_viagem', 'value' => 'Data início da viagem' . ':*'];
          @endphp
          <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </span>

            @php
            $__f9 = ['name' => 'data_inicio_viagem', 'value' => $mdfe != null ? \Carbon\Carbon::parse($mdfe->data_inicio_viagem)->format('d/m/Y') : '', 'options' => ['class' => 'form-control', 'readonly', 'required', 'id' => 'data_inicio_viagem']];
            @endphp
            <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
          </div>
        </div>
      </div>


      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f10 = ['name' => 'carga_posterior', 'value' => 'Carga posterior' . ':*'];
          @endphp
          <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
          @php
          $__f11 = ['name' => 'carga_posterior', 'list' => [0 => 'Não', 1 => 'Sim'], 'selected' => $mdfe != null ? $mdfe->carga_posterior : '', 'options' => ['class' => 'form-control select2', 'id' => 'carga_posterior', 'required']];
          @endphp
          <x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
        </div>
      </div>


      <div class="clearfix"></div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f12 = ['name' => 'tipo_emitente', 'value' => 'Tipo do emitente' . ':*'];
          @endphp
          <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
          @php
          $__f13 = ['name' => 'tipo_emitente', 'list' => [1 => '1 - Prestador de serviço de transporte', 2 => '2 - Transportador de Carga Própria'], 'selected' => $mdfe != null ? $mdfe->tp_emit : '', 'options' => ['class' => 'form-control select2', 'id' => 'tipo_emitente', 'required']];
          @endphp
          <x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f14 = ['name' => 'tipo_transportador', 'value' => 'Tipo do transportador' . ':*'];
          @endphp
          <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
          @php
          $__f15 = ['name' => 'tipo_transportador', 'list' => [1 => '1 - ETC', 2 => '2 - TAC', 3 => '3 - CTC'], 'selected' => $mdfe != null ? $mdfe->tp_transp : '', 'options' => ['class' => 'form-control select2', 'id' => 'tipo_transportador', 'required']];
          @endphp
          <x-form.select :name="$__f15['name']" :list="$__f15['list']" :selected="$__f15['selected']" :options="$__f15['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f16 = ['name' => 'lac_rodo', 'value' => 'Lacre rodoviário' . ':*'];
          @endphp
          <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
          @php
          $__f17 = ['name' => 'lac_rodo', 'value' => $mdfe != null ? $mdfe->lac_rodo : '', 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'Lacre rodoviário' ]];
          @endphp
          <x-form.input type="text" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f18 = ['name' => 'cnpj_contratante', 'value' => 'CNPJ contratante' . ':*'];
          @endphp
          <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
          @php
          $__f19 = ['name' => 'cnpj_contratante', 'value' => $mdfe != null ? $mdfe->cnpj_contratante : '', 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'CNPJ contratante', 'data-mask="00.000.000/0000-00", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f20 = ['name' => 'quantidade_carga', 'value' => 'Quantidade da carga' . ':*'];
          @endphp
          <x-form.label :name="$__f20['name']" :value="$__f20['value']" />
          @php
          $__f21 = ['name' => 'quantidade_carga', 'value' => $mdfe != null ? $mdfe->quantidade_carga : '', 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'Quantidade da carga', 'data-mask="00000000,0000", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f21['name']" :value="$__f21['value']" :options="$__f21['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f22 = ['name' => 'valor_carga', 'value' => 'Valor da carga' . ':*'];
          @endphp
          <x-form.label :name="$__f22['name']" :value="$__f22['value']" />
          @php
          $__f23 = ['name' => 'valor_carga', 'value' => $mdfe != null ? $mdfe->valor_carga : '', 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'Valor da carga', 'data-mask="0000000000,00", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f23['name']" :value="$__f23['value']" :options="$__f23['options']" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f24 = ['name' => 'veiculo_tracao_id', 'value' => 'Veiculo de tração' . ':*'];
          @endphp
          <x-form.label :name="$__f24['name']" :value="$__f24['value']" />
          @php
          $__f25 = ['name' => 'veiculo_tracao_id', 'list' => $veiculos, 'selected' => $mdfe != null ? $mdfe->veiculo_tracao_id : '', 'options' => ['class' => 'form-control select2', 'id' => 'veiculo_tracao_id', 'required']];
          @endphp
          <x-form.select :name="$__f25['name']" :list="$__f25['list']" :selected="$__f25['selected']" :options="$__f25['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f26 = ['name' => 'veiculo_reboque1_id', 'value' => 'Veiculo de reboque 1 (opcional)' . ':'];
          @endphp
          <x-form.label :name="$__f26['name']" :value="$__f26['value']" />
          @php
          $__f27 = ['name' => 'veiculo_reboque1_id', 'list' => $veiculos, 'selected' => $mdfe != null ? $mdfe->veiculo_reboque1_id : '', 'options' => ['class' => 'form-control select2', 'id' => 'veiculo_reboque1_id']];
          @endphp
          <x-form.select :name="$__f27['name']" :list="$__f27['list']" :selected="$__f27['selected']" :options="$__f27['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f28 = ['name' => 'veiculo_reboque2_id', 'value' => 'Veiculo de reboque 2 (opcional)' . ':'];
          @endphp
          <x-form.label :name="$__f28['name']" :value="$__f28['value']" />
          @php
          $__f29 = ['name' => 'veiculo_reboque2_id', 'list' => $veiculos, 'selected' => $mdfe != null ? $mdfe->veiculo_reboque2_id : '', 'options' => ['class' => 'form-control select2', 'id' => 'veiculo_reboque2_id']];
          @endphp
          <x-form.select :name="$__f29['name']" :list="$__f29['list']" :selected="$__f29['selected']" :options="$__f29['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f30 = ['name' => 'veiculo_reboque3_id', 'value' => 'Veiculo de reboque 3 (opcional)' . ':'];
          @endphp
          <x-form.label :name="$__f30['name']" :value="$__f30['value']" />
          @php
          $__f31 = ['name' => 'veiculo_reboque3_id', 'list' => $veiculos, 'selected' => $mdfe != null ? $mdfe->veiculo_reboque3_id : '', 'options' => ['class' => 'form-control select2', 'id' => 'veiculo_reboque3_id']];
          @endphp
          <x-form.select :name="$__f31['name']" :list="$__f31['list']" :selected="$__f31['selected']" :options="$__f31['options']" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f32 = ['name' => 'produto_pred_nome', 'value' => 'Produto predominante' . ':'];
          @endphp
          <x-form.label :name="$__f32['name']" :value="$__f32['value']" />
          @php
          $__f33 = ['name' => 'produto_pred_nome', 'value' => $mdfe != null ? $mdfe->produto_pred_nome : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Produto predominante' ]];
          @endphp
          <x-form.input type="text" :name="$__f33['name']" :value="$__f33['value']" :options="$__f33['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f34 = ['name' => 'produto_pred_cod_barras', 'value' => 'Código de barras' . ':'];
          @endphp
          <x-form.label :name="$__f34['name']" :value="$__f34['value']" />
          @php
          $__f35 = ['name' => 'produto_pred_cod_barras', 'value' => $mdfe != null ? $mdfe->produto_pred_cod_barras : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Código de barras' ]];
          @endphp
          <x-form.input type="text" :name="$__f35['name']" :value="$__f35['value']" :options="$__f35['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f36 = ['name' => 'produto_pred_ncm', 'value' => 'NCM' . ':'];
          @endphp
          <x-form.label :name="$__f36['name']" :value="$__f36['value']" />
          @php
          $__f37 = ['name' => 'produto_pred_ncm', 'value' => $mdfe != null ? $mdfe->produto_pred_ncm : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'NCM', 'data-mask="0000.00.00", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f37['name']" :value="$__f37['value']" :options="$__f37['options']" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f38 = ['name' => 'cep_carrega', 'value' => 'CEP Carrega' . ':'];
          @endphp
          <x-form.label :name="$__f38['name']" :value="$__f38['value']" />
          @php
          $__f39 = ['name' => 'cep_carrega', 'value' => $mdfe != null ? $mdfe->cep_carrega : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'CEP Carrega', 'data-mask="00000-000", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f39['name']" :value="$__f39['value']" :options="$__f39['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f40 = ['name' => 'latitude_carrega', 'value' => 'Latitude Carrega' . ':'];
          @endphp
          <x-form.label :name="$__f40['name']" :value="$__f40['value']" />
          @php
          $__f41 = ['name' => 'latitude_carrega', 'value' => $mdfe != null ? $mdfe->latitude_carregamento : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Latitude Carrega', 'data-mask="-00.000000"' ]];
          @endphp
          <x-form.input type="text" :name="$__f41['name']" :value="$__f41['value']" :options="$__f41['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f42 = ['name' => 'longitude_carrega', 'value' => 'Longitude Carrega' . ':'];
          @endphp
          <x-form.label :name="$__f42['name']" :value="$__f42['value']" />
          @php
          $__f43 = ['name' => 'longitude_carrega', 'value' => $mdfe != null ? $mdfe->longitude_carregamento : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Longitude Carrega', 'data-mask="-00.000000"' ]];
          @endphp
          <x-form.input type="text" :name="$__f43['name']" :value="$__f43['value']" :options="$__f43['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f44 = ['name' => 'cep_descarrega', 'value' => 'CEP Descarrega' . ':'];
          @endphp
          <x-form.label :name="$__f44['name']" :value="$__f44['value']" />
          @php
          $__f45 = ['name' => 'cep_descarrega', 'value' => $mdfe != null ? $mdfe->cep_descarrega : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'CEP Descarrega', 'data-mask="00000-000", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f45['name']" :value="$__f45['value']" :options="$__f45['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f46 = ['name' => 'latitude_descarrega', 'value' => 'Latitude Descarrega' . ':'];
          @endphp
          <x-form.label :name="$__f46['name']" :value="$__f46['value']" />
          @php
          $__f47 = ['name' => 'latitude_descarrega', 'value' => $mdfe != null ? $mdfe->latitude_descarregamento : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Latitude Descarrega', 'data-mask="-00.000000"' ]];
          @endphp
          <x-form.input type="text" :name="$__f47['name']" :value="$__f47['value']" :options="$__f47['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f48 = ['name' => 'longitude_descarrega', 'value' => 'Longitude Descarrega' . ':'];
          @endphp
          <x-form.label :name="$__f48['name']" :value="$__f48['value']" />
          @php
          $__f49 = ['name' => 'longitude_descarrega', 'value' => $mdfe != null ? $mdfe->longitude_descarregamento : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Longitude Descarrega', 'data-mask="-00.000000"' ]];
          @endphp
          <x-form.input type="text" :name="$__f49['name']" :value="$__f49['value']" :options="$__f49['options']" />
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f50 = ['name' => 'tp_carga', 'value' => 'Tipo de carga' . ':'];
          @endphp
          <x-form.label :name="$__f50['name']" :value="$__f50['value']" />
          @php
          $__f51 = ['name' => 'tp_carga', 'list' => App\Models\Mdfe::tiposCarga(), 'selected' => $mdfe != null ? $mdfe->tp_carga : '', 'options' => ['class' => 'form-control select2', 'id' => 'tp_carga', 'required', 'style' => 'width: 100%']];
          @endphp
          <x-form.select :name="$__f51['name']" :list="$__f51['list']" :selected="$__f51['selected']" :options="$__f51['options']" />
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs nav-justified">
              <li class="active">
                <a href="#geral" data-toggle="tab" aria-expanded="true">INFORMAÇÕES GERAIS</a>
              </li>
              <li class="''">
                <a href="#transp" data-toggle="tab" aria-expanded="false">INFORMAÇÕES DE TRANSPORTE</a>
              </li>
              <li class="''">
                <a href="#desc" data-toggle="tab" aria-expanded="false">INFORMAÇÕES DE DESCARREGAMENTO</a>
              </li>

            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="geral">
                <div class="row">
                  <div class="col-md-12" style="border: 1px solid #e0e0e0; border-radius: 5px;">
                    <div class="col-md-12">
                      <h3>Seguradora (opcional)</h3>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f52 = ['name' => 'seguradora_nome', 'value' => 'Nome da seguradora' . ':*'];
                        @endphp
                        <x-form.label :name="$__f52['name']" :value="$__f52['value']" />
                        @php
                        $__f53 = ['name' => 'seguradora_nome', 'value' => $mdfe != null ? $mdfe->seguradora_nome : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Nome da seguradora' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f53['name']" :value="$__f53['value']" :options="$__f53['options']" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f54 = ['name' => 'seguradora_cnpj', 'value' => 'CNPJ da seguradora' . ':*'];
                        @endphp
                        <x-form.label :name="$__f54['name']" :value="$__f54['value']" />
                        @php
                        $__f55 = ['name' => 'seguradora_cnpj', 'value' => $mdfe != null ? $mdfe->seguradora_cnpj : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'CNPJ da seguradora', 'data-mask="00.000.000/0000-00", data-mask-reverse="true"' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f55['name']" :value="$__f55['value']" :options="$__f55['options']" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f56 = ['name' => 'numero_apolice', 'value' => 'Número de apolice' . ':*'];
                        @endphp
                        <x-form.label :name="$__f56['name']" :value="$__f56['value']" />
                        @php
                        $__f57 = ['name' => 'numero_apolice', 'value' => $mdfe != null ? $mdfe->numero_apolice : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Número de apolice' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f57['name']" :value="$__f57['value']" :options="$__f57['options']" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f58 = ['name' => 'numero_averbacao', 'value' => 'Número da averbação' . ':*'];
                        @endphp
                        <x-form.label :name="$__f58['name']" :value="$__f58['value']" />
                        @php
                        $__f59 = ['name' => 'numero_averbacao', 'value' => $mdfe != null ? $mdfe->numero_averbacao : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Número da averbação' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f59['name']" :value="$__f59['value']" :options="$__f59['options']" />
                      </div>
                    </div>
                  </div>

                  <div class="clearfix"></div>
                  <div class="col-md-8" style="border: 1px solid #e0e0e0; border-radius: 5px; margin-top: 10px;">

                    <div class="col-md-12">
                      <h3>Municipios de carregamento</h3>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        @php
                        $__f60 = ['name' => 'municipio', 'value' => 'Selecione o municipio' . ':'];
                        @endphp
                        <x-form.label :name="$__f60['name']" :value="$__f60['value']" />
                        @php
                        $__f61 = ['name' => 'municipio', 'list' => $cidades, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'municipio', 'required']];
                        @endphp
                        <x-form.select :name="$__f61['name']" :list="$__f61['list']" :selected="$__f61['selected']" :options="$__f61['options']" />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <button type="button" id="add-cidade" class="btn btn-info" style="margin-top: 23px;">
                        Adicionar
                      </button>
                    </div>
                    <div class="col-md-12">

                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="cidades_table">
                          <thead>
                            <tr>
                              <th>Municipio</th>
                              <th>Ação</th>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div> 

                  <div class="col-md-4" style="border: 1px solid #e0e0e0; border-radius: 5px; margin-top: 10px;">

                    <div class="col-md-12">
                      <h3>Percurso</h3>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        @php
                        $__f62 = ['name' => 'uf', 'value' => 'Selecione a UF' . ':'];
                        @endphp
                        <x-form.label :name="$__f62['name']" :value="$__f62['value']" />
                        @php
                        $__f63 = ['name' => 'uf', 'list' => $ufs, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'uf', 'required']];
                        @endphp
                        <x-form.select :name="$__f63['name']" :list="$__f63['list']" :selected="$__f63['selected']" :options="$__f63['options']" />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <button type="button" id="add-uf" class="btn btn-info" style="margin-top: 23px;">
                        Adicionar
                      </button>
                    </div>
                    <div class="col-md-12">

                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="ufs_table">
                          <thead>
                            <tr>
                              <th>UF</th>
                              <th>Ação</th>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div> 

                </div>                    
              </div>

              <div class="tab-pane ''" id="transp">
                <div class="row">

                  <div class="col-md-12" style="border: 1px solid #e0e0e0; border-radius: 5px; margin-top: 10px;">
                    <div class="col-md-12">
                      <h3>CIOT (opcional)</h3>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f64 = ['name' => 'codigo_ciot', 'value' => 'Código CIOT' . ':*'];
                        @endphp
                        <x-form.label :name="$__f64['name']" :value="$__f64['value']" />
                        @php
                        $__f65 = ['name' => 'codigo_ciot', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Código CIOT' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f65['name']" :value="$__f65['value']" :options="$__f65['options']" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f66 = ['name' => 'doc_ciot', 'value' => 'CNPJ/CPF' . ':*'];
                        @endphp
                        <x-form.label :name="$__f66['name']" :value="$__f66['value']" />
                        @php
                        $__f67 = ['name' => 'doc_ciot', 'value' => null, 'options' => ['class' => 'form-control type-ref cpf_cnpj', 'placeholder' => 'CNPJ/CPF', ]];
                        @endphp
                        <x-form.input type="text" :name="$__f67['name']" :value="$__f67['value']" :options="$__f67['options']" />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <button type="button" id="add-ciot" class="btn btn-info" style="margin-top: 23px;">
                        Adicionar
                      </button>
                    </div>
                    <div class="col-md-12">

                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="ciot_table">
                          <thead>
                            <tr>
                              <th>Código</th>
                              <th>CPF/CNPJ</th>
                              <th>Ação</th>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>

                  <!-- Vale pedagio -->

                  <div class="col-md-12" style="border: 1px solid #e0e0e0; border-radius: 5px; margin-top: 10px;">
                    <div class="col-md-12">
                      <h3>Vale Pedagio (opcional)</h3>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        @php
                        $__f68 = ['name' => 'vale_cnpj_fornecedor', 'value' => 'CNPJ Fornecedor' . ':*'];
                        @endphp
                        <x-form.label :name="$__f68['name']" :value="$__f68['value']" />
                        @php
                        $__f69 = ['name' => 'vale_cnpj_fornecedor', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'CNPJ Fornecedor' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f69['name']" :value="$__f69['value']" :options="$__f69['options']" />
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        @php
                        $__f70 = ['name' => 'vale_doc_pagador', 'value' => 'CPF/CNPJ Pagador' . ':*'];
                        @endphp
                        <x-form.label :name="$__f70['name']" :value="$__f70['value']" />
                        @php
                        $__f71 = ['name' => 'vale_doc_pagador', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'CPF/CNPJ Pagador' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f71['name']" :value="$__f71['value']" :options="$__f71['options']" />
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        @php
                        $__f72 = ['name' => 'vale_numero_compra', 'value' => 'Nº da compra' . ':*'];
                        @endphp
                        <x-form.label :name="$__f72['name']" :value="$__f72['value']" />
                        @php
                        $__f73 = ['name' => 'vale_numero_compra', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Nº da compra', ]];
                        @endphp
                        <x-form.input type="text" :name="$__f73['name']" :value="$__f73['value']" :options="$__f73['options']" />
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        @php
                        $__f74 = ['name' => 'vale_valor', 'value' => 'Valor' . ':*'];
                        @endphp
                        <x-form.label :name="$__f74['name']" :value="$__f74['value']" />
                        @php
                        $__f75 = ['name' => 'vale_valor', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Valor', 'data-mask="00000,00", data-mask-reverse="true"' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f75['name']" :value="$__f75['value']" :options="$__f75['options']" />
                      </div>
                    </div>

                    <div class="col-md-2">
                      <button type="button" id="add-vale" class="btn btn-info" style="margin-top: 23px;">
                        Adicionar
                      </button>
                    </div>
                    <div class="col-md-12">

                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="vale_table">
                          <thead>
                            <tr>
                              <th>CNPJ Fornecedor</th>
                              <th>CPF/CNPJ do Pagador</th>
                              <th>Número da compra</th>
                              <th>Valor</th>
                              <th>Ação</th>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>

                  <div class="col-md-12" style="border: 1px solid #e0e0e0; border-radius: 5px; margin-top: 10px;">
                    <div class="col-md-12">
                      <h3>Condutor</h3>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f76 = ['name' => 'condutor_nome', 'value' => 'Condutor' . ':*'];
                        @endphp
                        <x-form.label :name="$__f76['name']" :value="$__f76['value']" />
                        @php
                        $__f77 = ['name' => 'condutor_nome', 'value' => $mdfe != null ? $mdfe->condutor_nome : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Condutor' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f77['name']" :value="$__f77['value']" :options="$__f77['options']" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f78 = ['name' => 'condutor_cpf', 'value' => 'CPF' . ':*'];
                        @endphp
                        <x-form.label :name="$__f78['name']" :value="$__f78['value']" />
                        @php
                        $__f79 = ['name' => 'condutor_cpf', 'value' => $mdfe != null ? $mdfe->condutor_cpf : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'CPF', 'data-mask="000.000.000-00", data-mask-reverse="true"' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f79['name']" :value="$__f79['value']" :options="$__f79['options']" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="tab-pane ''" id="desc">
                <div class="row">

                  <div class="col-md-12" style="border: 1px solid #e0e0e0; border-radius: 5px; margin-top: 10px;">
                    <div class="col-md-12">
                      <h3>Informações da Unidade de Transporte / Documentos Fiscais / Lacres</h3>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        @php
                        $__f80 = ['name' => 'tipo_unidade_transporte', 'value' => 'Tipo Unidade de Transporte' . ':*'];
                        @endphp
                        <x-form.label :name="$__f80['name']" :value="$__f80['value']" />
                        @php
                        $__f81 = ['name' => 'tipo_unidade_transporte', 'list' => $tiposUnidadeTransporte, 'selected' => '', 'options' => ['class' => 'form-control select2 full', 'id' => 'tipo_unidade_transporte', 'required', 'style' => 'width: 100%']];
                        @endphp
                        <x-form.select :name="$__f81['name']" :list="$__f81['list']" :selected="$__f81['selected']" :options="$__f81['options']" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f82 = ['name' => 'id_unidade_transporte', 'value' => 'ID da Unidade de Transporte (Placa)' . ':*'];
                        @endphp
                        <x-form.label :name="$__f82['name']" :value="$__f82['value']" />
                        @php
                        $__f83 = ['name' => 'id_unidade_transporte', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'ID da Unidade de Transporte (Placa)', 'data-mask="AAA-AAAA", data-mask-reverse="true"' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f83['name']" :value="$__f83['value']" :options="$__f83['options']" />
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        @php
                        $__f84 = ['name' => 'qtd_rateio_transporte', 'value' => 'Quantidade de Rateio (Transporte)' . ':*'];
                        @endphp
                        <x-form.label :name="$__f84['name']" :value="$__f84['value']" />
                        @php
                        $__f85 = ['name' => 'qtd_rateio_transporte', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Quantidade de Rateio (Transporte)' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f85['name']" :value="$__f85['value']" :options="$__f85['options']" />
                      </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-3">
                      <div class="form-group">
                        @php
                        $__f86 = ['name' => 'id_unidade_carga', 'value' => 'ID Unidade da Carga' . ':*'];
                        @endphp
                        <x-form.label :name="$__f86['name']" :value="$__f86['value']" />
                        @php
                        $__f87 = ['name' => 'id_unidade_carga', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'ID Unidade da Carga' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f87['name']" :value="$__f87['value']" :options="$__f87['options']" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f88 = ['name' => 'qtd_rateio_unidade', 'value' => 'Quantidade de Rateio (Unidade Carga)' . ':*'];
                        @endphp
                        <x-form.label :name="$__f88['name']" :value="$__f88['value']" />
                        @php
                        $__f89 = ['name' => 'qtd_rateio_unidade', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Quantidade de Rateio (Unidade Carga)' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f89['name']" :value="$__f89['value']" :options="$__f89['options']" />
                      </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-6">
                      <div class="form-group">
                        @php
                        $__f90 = ['name' => 'chave_nfe', 'value' => 'Chave NFe' . ':*'];
                        @endphp
                        <x-form.label :name="$__f90['name']" :value="$__f90['value']" />
                        @php
                        $__f91 = ['name' => 'chave_nfe', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Chave NFe' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f91['name']" :value="$__f91['value']" :options="$__f91['options']" />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        @php
                        $__f92 = ['name' => 'segunda_nfe', 'value' => 'Segundo Código de Barra NFe (Contigencia)' . ':*'];
                        @endphp
                        <x-form.label :name="$__f92['name']" :value="$__f92['value']" />
                        @php
                        $__f93 = ['name' => 'segunda_nfe', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Segundo Código de Barra NFe (Contigencia)' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f93['name']" :value="$__f93['value']" :options="$__f93['options']" />
                      </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-6">
                      <div class="form-group">
                        @php
                        $__f94 = ['name' => 'chave_cte', 'value' => 'Chave CTe' . ':*'];
                        @endphp
                        <x-form.label :name="$__f94['name']" :value="$__f94['value']" />
                        @php
                        $__f95 = ['name' => 'chave_cte', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Chave CTe' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f95['name']" :value="$__f95['value']" :options="$__f95['options']" />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        @php
                        $__f96 = ['name' => 'segunda_cte', 'value' => 'Segundo Código de Barra CTe (Contigencia)' . ':*'];
                        @endphp
                        <x-form.label :name="$__f96['name']" :value="$__f96['value']" />
                        @php
                        $__f97 = ['name' => 'segunda_cte', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Segundo Código de Barra CTe (Contigencia)' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f97['name']" :value="$__f97['value']" :options="$__f97['options']" />
                      </div>
                    </div>

                    <div class="col-md-5" style="border: 1px solid #e0e0e0; border-radius: 5px; margin-top: 5px; margin-left: 10px; margin-bottom: 10px;">

                      <div class="col-md-12">
                        <h3>Lacre de transporte</h3>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          @php
                          $__f98 = ['name' => 'lacre_transp', 'value' => 'Lacre' . ':'];
                          @endphp
                          <x-form.label :name="$__f98['name']" :value="$__f98['value']" />
                          @php
                          $__f99 = ['name' => 'lacre_transp', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Lacre', 'id' => 'lacre_transp' ]];
                          @endphp
                          <x-form.input type="text" :name="$__f99['name']" :value="$__f99['value']" :options="$__f99['options']" />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <button type="button" id="add-lacre-transp" class="btn btn-info" style="margin-top: 23px;">
                          Adicionar
                        </button>
                      </div>
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped" id="lacres_transp_table">
                            <thead>
                              <tr>
                                <th>Lacre</th>
                                <th>Ação</th>
                              </tr>
                            </thead>
                            <tbody>

                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div> 

                    <div class="col-md-5" style="border: 1px solid #e0e0e0; border-radius: 5px; margin-top: 5px; margin-left: 10px; margin-bottom: 10px;">

                      <div class="col-md-12">
                        <h3>Lacre da unidade da carga</h3>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          @php
                          $__f100 = ['name' => 'lacre_unid_carga', 'value' => 'Lacre' . ':'];
                          @endphp
                          <x-form.label :name="$__f100['name']" :value="$__f100['value']" />
                          @php
                          $__f101 = ['name' => 'lacre_transp', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Lacre', 'id' => 'lacre_unid_carga' ]];
                          @endphp
                          <x-form.input type="text" :name="$__f101['name']" :value="$__f101['value']" :options="$__f101['options']" />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <button type="button" id="add-lacre-unid" class="btn btn-info" style="margin-top: 23px;">
                          Adicionar
                        </button>
                      </div>
                      <div class="col-md-12">

                        <div class="table-responsive">
                          <table class="table table-bordered table-striped" id="lacres_unid_carga_table">
                            <thead>
                              <tr>
                                <th>Lacre</th>
                                <th>Ação</th>
                              </tr>
                            </thead>
                            <tbody>

                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div> 

                    <div class="clearfix"></div>

                    <div class="col-md-6">
                      <div class="form-group">
                        @php
                        $__f102 = ['name' => 'municipio_descarregamento', 'value' => 'Selecione o municipio de descarregamento' . ':'];
                        @endphp
                        <x-form.label :name="$__f102['name']" :value="$__f102['value']" />
                        @php
                        $__f103 = ['name' => 'municipio_descarregamento', 'list' => $cidades, 'selected' => '', 'options' => ['class' => 'form-control select2', 'style="width: 100%"', 'id' => 'municipio_descarregamento', 'required']];
                        @endphp
                        <x-form.select :name="$__f103['name']" :list="$__f103['list']" :selected="$__f103['selected']" :options="$__f103['options']" />
                      </div>
                    </div>

                    <div class="col-md-3">
                      <button style="margin-top: 24px; width: 100%" type="button" id="add-descarregamento" class="btn btn-info">
                        Adicionar
                      </button>
                    </div>

                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="descarregamento_table">
                          <thead>
                            <tr>
                              <th>Tipo transporte</th>
                              <th>Quantidade Rateio</th>
                              <th>NFe Referência</th>
                              <th>CTe Referência</th>
                              <th>Municipio descarregamento</th>
                              <th>Lacres de transp</th>
                              <th>Ações</th>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>
                </div>

              </div>


            </div>
          </div>
        </div>
      </div>

      <input type="hidden" name="municipios_descarregamentos" id="municipios_descarregamentos"> 
      <input type="hidden" name="descargas" id="descargas"> 
      <input type="hidden" name="ciots" id="ciots"> 
      <input type="hidden" name="vales" id="vales"> 
      <input type="hidden" name="percurso" id="percurso"> 

      <input type="hidden" value="{{$mdfe != null ? $mdfe->municipiosCarregamento : ''}}" id="init_municipios"> 
      <input type="hidden" value="{{$mdfe != null ? $mdfe->percurso : ''}}" id="init_percurso"> 
      <input type="hidden" value="{{$mdfe != null ? $mdfe->ciots : ''}}" id="init_ciot"> 
      <input type="hidden" value="{{$mdfe != null ? $mdfe->valesPedagio : ''}}" id="init_vale"> 

      <input type="hidden" value="{{$mdfe != null ? $mdfe->infoDescarga : ''}}" id="init_descargas"> 

      <input type="hidden" value="{{$mdfe != null ? $mdfe->id : ''}}" name="mdfe_id">
      <div class="col-md-12">
        <div class="col-md-5">
          <div class="form-group">
            @php
            $__f104 = ['name' => 'info_complementar', 'value' => 'Informação complementar' . ':'];
            @endphp
            <x-form.label :name="$__f104['name']" :value="$__f104['value']" />
            @php
            $__f105 = ['name' => 'info_complementar', 'value' => $mdfe != null ? $mdfe->info_complementar : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Info complementar' ]];
            @endphp
            <x-form.input type="text" :name="$__f105['name']" :value="$__f105['value']" :options="$__f105['options']" />
          </div>
        </div>

        <div class="col-md-7">
          <div class="form-group">
            @php
            $__f106 = ['name' => 'info_adicional_fisco', 'value' => 'Informação Fiscal' . ':*'];
            @endphp
            <x-form.label :name="$__f106['name']" :value="$__f106['value']" />
            @php
            $__f107 = ['name' => 'info_adicional_fisco', 'value' => $mdfe != null ? $mdfe->info_adicional_fisco : '', 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Informação Adicional' ]];
            @endphp
            <x-form.input type="text" :name="$__f107['name']" :value="$__f107['value']" :options="$__f107['options']" />
          </div>
        </div>
      </div>
      <input type="hidden" value="{{json_encode($cidades)}}" id="cidades">

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
      <button id="finalizar" type="submit" class="btn btn-primary pull-right disabled" id="submit_user_button">@if($mdfe != null) Atualizar @else Salvar @endif MDFe</button>
    </div>
  </div>
  <br><br>
  <x-form.close />
  @stop
  @section('javascript')
  <script type="text/javascript">
    var CIDADES = JSON.parse($('#cidades').val())
    var CIDADESADICIONADAS = [];
    var PERCURSO = [];
    var CIOT = [];
    var VALES = [];
    var LACRESTRANSPORTE = [];
    var LACRESUNIDADECARGA = [];
    var DESCARGAS = [];
    
    $('.type-ref').keyup(() => {
      habilitaBtnSalarMdfe()
    })

    $('#add-cidade').click(() => {
      let municipio = $('#municipio').val()
      CIDADESADICIONADAS.push(municipio);
      montaHtmlCidades((html) => {
        $('#cidades_table tbody').html(html)
        __set('municipios_descarregamentos', JSON.stringify(CIDADESADICIONADAS))
      });
      habilitaBtnSalarMdfe()
    })

    function montaHtmlCidades(call){
      let html = '';
      CIDADESADICIONADAS.map((c) => {
        let nomeCidade = CIDADES[c];
        html += '<tr>'
        html += '<td>'+nomeCidade+'</td>'
        html += '<td>'
        html += '<i onclick="removeCidade('+c+')" class="fa fa-trash text-danger"></i>'
        html += '</td>'
        html += '</tr>'
      })
      call(html)
    }

    function removeCidade(id){
      let temp = [];
      CIDADESADICIONADAS.map((c) => {
        if(c != id) temp.push(c)
      })
      CIDADESADICIONADAS = temp;
      setTimeout(() => {
        montaHtmlCidades((html) => {
          $('#cidades_table tbody').html(html)
          __set('municipios_descarregamentos', JSON.stringify(CIDADESADICIONADAS))
        });
      }, 300)
    }

    //estados

    $('#add-uf').click(() => {
      let uf = $('#uf').val()
      PERCURSO.push(uf);
      montaHtmlUF((html) => {
        $('#ufs_table tbody').html(html)
        __set('percurso', JSON.stringify(PERCURSO))
      });
      habilitaBtnSalarMdfe()

    })

    function montaHtmlUF(call){
      let html = '';
      PERCURSO.map((uf) => {
        html += '<tr>'
        html += '<td>'+uf+'</td>'
        html += '<td>'
        html += '<i onclick="removeUF(\''+uf+'\')" class="fa fa-trash text-danger"></i>'
        html += '</td>'
        html += '</tr>'
      })
      call(html)
    }

    function removeUF(uf){
      let temp = [];
      PERCURSO.map((c) => {
        if(c != uf) temp.push(c)
      })
      PERCURSO = temp;
      setTimeout(() => {
        montaHtmlUF((html) => {
          $('#ufs_table tbody').html(html)
          __set('percurso', JSON.stringify(PERCURSO))
        });
      }, 300)
    }

    //ciot

    $('#add-ciot').click(() => {
      if($('#codigo_ciot').val() && $('#doc_ciot').val()){
        let js = {
          'codigo': $('#codigo_ciot').val(),
          'doc_ciot': $('#doc_ciot').val()
        }
        CIOT.push(js);
        montaHtmlCiot((html) => {
          $('#ciot_table tbody').html(html)
          __set('ciots', JSON.stringify(CIOT))
        });
      }else{
        swal("Erro", "Informe código e documento", "error")
      }
    })

    function montaHtmlCiot(call){
      let html = '';
      CIOT.map((c) => {
        html += '<tr>'
        html += '<td>'+c.codigo+'</td>'
        html += '<td>'+c.doc_ciot+'</td>'
        html += '<td>'
        html += '<i onclick="removeCiot(\''+c.codigo+'\')" class="fa fa-trash text-danger"></i>'
        html += '</td>'
        html += '</tr>'
      })
      call(html)
    }

    function removeCiot(cod){
      let temp = [];
      CIOT.map((c) => {
        if(c.codigo != cod) temp.push(c)
      })
      CIOT = temp;
      setTimeout(() => {
        montaHtmlCiot((html) => {
          $('#ciot_table tbody').html(html)
          __set('ciots', JSON.stringify(CIOT))
        });
      }, 300)
    }

    $('#add-vale').click(() => {
      if($('#vale_cnpj_fornecedor').val() && $('#vale_doc_pagador').val() && 
        $('#vale_numero_compra').val() && $('#vale_valor').val()){
        let js = {
          'cnpj_fornecedor': $('#vale_cnpj_fornecedor').val(),
          'doc_pagador': $('#vale_doc_pagador').val(),
          'numero_compra': $('#vale_numero_compra').val(),
          'valor': $('#vale_valor').val(),
        }
        VALES.push(js);
        montaHtmlVale((html) => {
          $('#vale_table tbody').html(html)
          __set('vales', JSON.stringify(VALES))
        });
      }else{
        swal("Erro", "Informe os dados corretamente", "error")
      }
    })

    function montaHtmlVale(call){
      let html = '';
      VALES.map((c) => {
        html += '<tr>'
        html += '<td>'+c.cnpj_fornecedor+'</td>'
        html += '<td>'+c.doc_pagador+'</td>'
        html += '<td>'+c.numero_compra+'</td>'
        html += '<td>'+c.valor+'</td>'
        html += '<td>'
        html += '<i onclick="removeVale(\''+c.numero_compra+'\')" class="fa fa-trash text-danger"></i>'
        html += '</td>'
        html += '</tr>'
      })
      call(html)
    }

    function removeVale(numero_compra){
      let temp = [];
      VALES.map((c) => {
        if(c.numero_compra != numero_compra) temp.push(c)
      })
      VALES = temp;
      setTimeout(() => {
        montaHtmlCiot((html) => {
          $('#vale_table tbody').html(html)
          __set('vales', JSON.stringify(VALES))
        });
      }, 300)
    }

    //Lacre de transporte

    $('#add-lacre-transp').click(() => {
      if($('#lacre_transp').val()){

        LACRESTRANSPORTE.push($('#lacre_transp').val());
        montaHtmlLaresTransp((html) => {
          $('#lacres_transp_table tbody').html(html)
        });
      }else{
        swal("Erro", "Informe o lacre", "error")
      }
    })

    function montaHtmlLaresTransp(call){
      let html = '';
      LACRESTRANSPORTE.map((c) => {
        html += '<tr>'
        html += '<td>'+c+'</td>'
        html += '<td>'
        html += '<i onclick="removeLacreTransp(\''+c+'\')" class="fa fa-trash text-danger"></i>'
        html += '</td>'
        html += '</tr>'
      })
      call(html)
    }

    function removeLacreTransp(cod){
      let temp = [];
      LACRESTRANSPORTE.map((c) => {
        if(c != cod) temp.push(c)
      })
      LACRESTRANSPORTE = temp;
      setTimeout(() => {
        montaHtmlLaresTransp((html) => {
          $('#lacres_transp_table tbody').html(html)
        });
      }, 300)
    }

    //Lacre de unidade carga

    $('#add-lacre-unid').click(() => {
      if($('#lacre_transp').val()){
        LACRESUNIDADECARGA.push($('#lacre_unid_carga').val());
        montaHtmlLaresUnidade((html) => {
          $('#lacres_unid_carga_table tbody').html(html)
        });
      }else{
        swal("Erro", "Informe o lacre", "error")
      }
    })

    function montaHtmlLaresUnidade(call){
      let html = '';
      LACRESUNIDADECARGA.map((c) => {
        html += '<tr>'
        html += '<td>'+c+'</td>'
        html += '<td>'
        html += '<i onclick="removeLacreUnidade(\''+c+'\')" class="fa fa-trash text-danger"></i>'
        html += '</td>'
        html += '</tr>'
      })
      call(html)
    }

    function removeLacreUnidade(cod){
      let temp = [];
      LACRESUNIDADECARGA.map((c) => {
        if(c != cod) temp.push(c)
      })
      LACRESUNIDADECARGA = temp;
      setTimeout(() => {
        montaHtmlLaresUnidade((html) => {
          $('#lacres_unid_carga_table tbody').html(html)
        });
      }, 300)
    }

    // add descarregamento
    $('#add-descarregamento').click(() => {
      let tipo_unidade_transporte = $('#tipo_unidade_transporte').val();
      let id_unidade_transporte = $('#id_unidade_transporte').val();
      let qtd_rateio_transporte = $('#qtd_rateio_transporte').val();
      let id_unidade_carga = $('#id_unidade_carga').val();
      let qtd_rateio_unidade = $('#qtd_rateio_unidade').val();
      let chave_nfe = $('#chave_nfe').val();
      let segunda_nfe = $('#segunda_nfe').val();
      let chave_cte = $('#chave_cte').val();
      let segunda_cte = $('#segunda_cte').val();
      let municipio_descarregamento = $('#municipio_descarregamento').val();

      validaDescarregamento((valid) => {
        if(valid == ""){
          let js = {
            rand: Math.floor(Math.random() * 1000),
            tipo_unidade_transporte: tipo_unidade_transporte,
            id_unidade_transporte: id_unidade_transporte,
            qtd_rateio_transporte: qtd_rateio_transporte,
            id_unidade_carga: id_unidade_carga,
            qtd_rateio_unidade: qtd_rateio_unidade,
            chave_nfe: chave_nfe,
            segunda_nfe: segunda_nfe,
            chave_cte: chave_cte,
            segunda_cte: segunda_cte,
            municipio_descarregamento: municipio_descarregamento,
            lacres_transporte: LACRESTRANSPORTE,
            lacres_unidade_carga: LACRESUNIDADECARGA,
          }

          DESCARGAS.push(js)
          montaHtmlDescarregamento((html) => {
            $('#descarregamento_table tbody').html(html)
            __set('descargas', JSON.stringify(DESCARGAS))
          });
        }else{
          swal("Atenção", valid, "warning");
        }
      })
    })


    function montaHtmlDescarregamento(call){
      let html = '';
      DESCARGAS.map((d) => {
        html += '<tr>'
        html += '<td>'+d.tipo_unidade_transporte+'</td>'
        html += '<td>'+d.qtd_rateio_transporte+'</td>'
        html += '<td>'+d.chave_nfe+'</td>'
        html += '<td>'+d.chave_cte+'</td>'
        html += '<td>'+CIDADES[d.municipio_descarregamento]+'</td>'
        html += '<td>'+LACRESTRANSPORTE+'</td>'
        html += '<td>'
        html += '<i onclick="removeDescarregamento(\''+d.rand+'\')" class="fa fa-trash text-danger"></i>'
        html += '</td>'
        html += '</tr>'
      })
      call(html)
    }

    function removeDescarregamento(rand){
      let temp = [];
      DESCARGAS.map((c) => {
        if(c.rand != rand) temp.push(c)
      })
      DESCARGAS = temp;
      setTimeout(() => {
        montaHtmlDescarregamento((html) => {
          $('#descarregamento_table tbody').html(html)
          __set('descargas', JSON.stringify(DESCARGAS))
        });
      }, 300)
    }

    function validaDescarregamento(call){
      let msg = "";
      if(!$('#tipo_unidade_transporte').val()){
        msg = "Informe o tipo da unidade de transporte\n";
      }
      if(!$('#id_unidade_transporte').val()){
        msg += "Informe o ID unidade de transporte\n";
      }
      if(!$('#qtd_rateio_transporte').val()){
        msg += "Informe a quantidade de rateio\n";
      }
      if(!$('#id_unidade_carga').val()){
        msg += "Informe ID da unidade da carga\n";
      }
      if(!$('#qtd_rateio_unidade').val()){
        msg += "Informe a quantidade de rateio\n";
      }
      if(!$('#qtd_rateio_unidade').val()){
        msg += "Informe a quantidade de rateio da unidade\n";
      }

      let chave_nfe = $('#chave_nfe').val();
      let segunda_nfe = $('#segunda_nfe').val();
      let chave_cte = $('#chave_cte').val();
      let segunda_cte = $('#segunda_cte').val();

      if(!chave_nfe && !segunda_nfe && !chave_cte && !segunda_cte){
        msg += "Referêncie um documento\n"
      }
      call(msg);
    }

    function habilitaBtnSalarMdfe(){
      validaFormulario((res) => {
        if(res){
          $('#finalizar').removeClass('disabled')
        }
      })
    }

    function validaFormulario(call){
      let inputs = ['uf_inicio', 'uf_fim', 'data_inicio_viagem', 'lac_rodo', 
      'cnpj_contratante', 'quantidade_carga', 'valor_carga', 'veiculo_tracao_id', 'condutor_nome', 
      'condutor_cpf'];
      validaInputs(inputs, (res) => {
        call(res)
      })

    }

    function validaInputs(arr, call){
      let retorno = true
      arr.map((v) => {
        if(!$('#'+v).val()){
          retorno = false
          console.log("aqui", v)

          $('#'+v).addClass('is-invalid')
        }else{
          $('#'+v).removeClass('is-invalid')
        }
      })
      if(CIDADESADICIONADAS.length == 0) retorno = false;
      if(DESCARGAS.length == 0) retorno = false;

      call(retorno)
    }

    function __set(input, valor){
      habilitaBtnSalarMdfe()
      $('#'+input).val(valor)
    }

    //para edit
    $(function() {
      //iniciando munucipios
      if($('#init_municipios').val()){
        let municipios = JSON.parse($('#init_municipios').val())
        municipios.map((m) => {
          console.log(m)
          CIDADESADICIONADAS.push(m.cidade_id)
        })

        montaHtmlCidades((html) => {
          $('#cidades_table tbody').html(html)
          __set('municipios_descarregamentos', JSON.stringify(CIDADESADICIONADAS))
        });
      }

      //iniciando percurso
      if($('#init_percurso').val()){
        let percurso = JSON.parse($('#init_percurso').val())
        percurso.map((m) => {
          console.log(m)
          PERCURSO.push(m.uf)
        })

        montaHtmlUF((html) => {
          $('#ufs_table tbody').html(html)
          __set('percurso', JSON.stringify(PERCURSO))
        });
      }

      //iniciando ciot
      if($('#init_ciot').val()){
        let ciots = JSON.parse($('#init_ciot').val())
        ciots.map((c) => {
          console.log(c)
          let js = {
            'codigo': c.codigo,
            'doc_ciot': c.cpf_cnpj
          }
          CIOT.push(js);
        })

        montaHtmlCiot((html) => {
          $('#ciot_table tbody').html(html)
          __set('ciots', JSON.stringify(CIOT))
        });
      }

      if($('#init_vale').val()){
        let vales = JSON.parse($('#init_vale').val())
        vales.map((v) => {

          let js = {
            'cnpj_fornecedor': v.cnpj_fornecedor,
            'doc_pagador': v.cnpj_fornecedor_pagador,
            'numero_compra': v.numero_compra,
            'valor': v.valor,
          }
          VALES.push(js);
        })

        montaHtmlVale((html) => {
          $('#vale_table tbody').html(html)
          __set('vales', JSON.stringify(VALES))
        });
      }


      // iniciando descargas

      if($('#init_descargas').val()){
        let descargas = JSON.parse($('#init_descargas').val())
        descargas.map((v) => {
          console.log(v)
          preparaLacres(v.lacres_transp, (lacrestTransp) => {
            preparaLacres(v.lacres_unid_carga, (lacrestUnidCarga) => {
              let js = {
                rand: Math.floor(Math.random() * 1000),
                tipo_unidade_transporte: v.tp_unid_transp,
                id_unidade_transporte: v.id_unid_transp,
                qtd_rateio_transporte: v.quantidade_rateio,
                id_unidade_carga: v.unidade_carga.id_unidade_carga,
                qtd_rateio_unidade: v.unidade_carga.quantidade_rateio,
                chave_nfe: v.nfe.chave,
                segunda_nfe: v.nfe.seg_cod_barras,
                chave_cte: v.cte ? v.cte.chave : '',
                segunda_cte: v.cte ? v.cte.seg_cod_barras : '',
                municipio_descarregamento: v.cidade_id,
                lacres_transporte: lacrestTransp,
                lacres_unidade_carga: lacrestUnidCarga,
              }

              console.log(js)
              DESCARGAS.push(js)
            });
          });
        })

        montaHtmlDescarregamento((html) => {
          $('#descarregamento_table tbody').html(html)
          __set('descargas', JSON.stringify(DESCARGAS))
        });


      }
      setTimeout(() => {
        habilitaBtnSalarMdfe()
      },300)
    });

    function preparaLacres(objeto, call){
      let t = [];
      objeto.map((l) => {
        t.push(l.numero)
      })
      call(t)
    }

    $(document).on('click', '#finalizar', function(e) {
      e.preventDefault();

      $('form#mdfe_add_form').validate()
      if ($('form#mdfe_add_form').valid()) {
        $('form#mdfe_add_form').submit();
      }
    })

  </script>
  @endsection
