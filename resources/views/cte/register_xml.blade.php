@extends('layouts.app')

@section('title', 'Adicionar CTe')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Adicionar </h1>  


</section>

<!-- Main content -->
<section class="content">


  @php
  $__f1 = ['options' => ['url' => action('CteController@save'), 'method' => 'post', 'id' => 'cte_add_form' ]];
  @endphp
  <x-form.open :options="$__f1['options']" />
  <div class="row">
    <div class="col-md-12">
      @component('components.widget')

      
      <div class="clearfix"></div>

      <div class="col-md-2">
        <div class="form-group">
          <h4>Ultima CTe: <strong>{{$lastCte}}</strong></h4>

        </div>
      </div>

      <input type="hidden" id="clientesAux" value="{{json_encode($clientesAux)}}" name="">

      <div class="clearfix"></div>

      
      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f2 = ['name' => 'natureza_id', 'value' => 'Natureza de operação' . ':*'];
          @endphp
          <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'natureza_id', 'list' => $naturezas, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'contact_type', 'required']];
          @endphp
          <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
        </div>
      </div>

      @if(is_null($default_location))

      <div class="col-md-4">
        <br>
        <div class="form-group" style="margin-top: 8px;">
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-map-marker"></i>
            </span>
            @php
            $__f4 = ['name' => 'select_location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.select_location'), 'id' => 'select_location_id', 'required', 'autofocus'], 'optionsAttributes' => $bl_attributes];
            @endphp
            <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" :options-attributes="$__f4['optionsAttributes']" />
            <span class="input-group-addon">
              @show_tooltip('Local da CTe')
            </span> 
          </div>
        </div>

      </div>
      @endif

      <div class="clearfix"></div>

      <div class="col-md-6">
        <div class="form-group">
          @php
          $__f5 = ['name' => 'remetente_id', 'value' => 'Remetente' . ':*'];
          @endphp
          <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
          @php
          $__f6 = ['name' => 'remetente_id', 'list' => $clientes, 'selected' => $dadosDaNFe['remetente'], 'options' => ['class' => 'form-control select2', 'id' => 'remetente_id', 'required', 'placeholder' => 'Selecione o remetente']];
          @endphp
          <x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
        </div>

        <div class="box box-success" id="box-remetente" style="display: none">
          <div class="box-body">
            <h5>Nome: <strong id="remetente-nome"></strong></h5>
            <h5>CNPJ: <strong id="remetente-cnpj"></strong></h5>
            <h5>IE: <strong id="remetente-ie"></strong></h5>
            <h5>Endereço: <strong id="remetente-endereco"></strong></h5>
            <h5>Cidade: <strong id="remetente-cidade"></strong></h5>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          @php
          $__f7 = ['name' => 'destinatario_id', 'value' => 'Destinatário' . ':*'];
          @endphp
          <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
          @php
          $__f8 = ['name' => 'destinatario_id', 'list' => $clientes, 'selected' => $dadosDaNFe['destinatario'], 'options' => ['class' => 'form-control select2', 'id' => 'destinatario_id', 'required', 'placeholder' => 'Selecione o destinatário']];
          @endphp
          <x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
        </div>
        <div class="box box-danger" id="box-destinatario" style="display: none">
          <div class="box-body">
            <h5>Nome: <strong id="destinatario-nome"></strong></h5>
            <h5>CNPJ: <strong id="destinatario-cnpj"></strong></h5>
            <h5>IE: <strong id="destinatario-ie"></strong></h5>
            <h5>Endereço: <strong id="destinatario-endereco"></strong></h5>
            <h5>Cidade: <strong id="destinatario-cidade"></strong></h5>

          </div>
        </div>

      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs nav-justified">
              <li class="active">
                <a href="#ledger_tab" data-toggle="tab" aria-expanded="true">NF-e</a>
              </li>
              <li class="''">
                <a href="#documents_and_notes_tab" data-toggle="tab" aria-expanded="false">Outros</a>
              </li>

            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="ledger_tab">
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label for="ledger_date_range">Chave NFe:</label>
                        <input placeholder="Chave NFe" class="form-control type-ref" data-mask="00000000000000000000000000000000000000000000" value="{{$dadosDaNFe['chave']}}" name="chave_nfe" type="text" id="chave_nfe">
                      </div>
                    </div>
                    <input type="hidden" id="chaves_nfe" name="chaves_nfe" value="">
                    <div class="col-md-1"><br>
                      <a id="addChave" class="btn btn-success" style="margin-top: 4px;">
                        <i class="fa fa-plus"></i>
                        Adicionar
                      </a>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-9">
                      <div id="chaves_list">

                      </div>
                      
                    </div>
                  </div>
                  <div id="contact_ledger_div"></div>
                </div>                    
              </div>
              <div class="tab-pane ''" id="documents_and_notes_tab">
                <!-- model id like project_id, user_id -->
                <!-- model name like App\User -->

                <?php 
                $tipos = [
                  '00' => 'Declaração',
                  '10' => 'Dutoviário',
                  '59' => 'CF-e SAT',
                  '65' => 'NFC-e',
                  '99' => 'Outros'
                ];
                ?>
                <div class="row">
                  <div class="col-md-12">

                    <div class="col-md-3">
                      <div class="form-group">
                        @php
                        $__f9 = ['name' => 'tpDoc', 'value' => 'Tipo documento' . ':*'];
                        @endphp
                        <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
                        @php
                        $__f10 = ['name' => 'tpDoc', 'list' => $tipos, 'selected' => '', 'options' => ['class' => 'form-control', 'id' => 'tpDoc', 'required']];
                        @endphp
                        <x-form.select :name="$__f10['name']" :list="$__f10['list']" :selected="$__f10['selected']" :options="$__f10['options']" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f11 = ['name' => 'descOutros', 'value' => 'Descrição do Doc.' . ':*'];
                        @endphp
                        <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
                        @php
                        $__f12 = ['name' => 'descOutros', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Descrição do Doc.' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        @php
                        $__f13 = ['name' => 'nDoc', 'value' => 'Numero do Doc.' . ':*'];
                        @endphp
                        <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
                        @php
                        $__f14 = ['name' => 'nDoc', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Numero do Doc.' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        @php
                        $__f15 = ['name' => 'vDocFisc', 'value' => 'Valor do Documento' . ':*'];
                        @endphp
                        <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
                        @php
                        $__f16 = ['name' => 'vDocFisc', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Valor do Documento', 'data-mask="000000.00", data-mask-reverse="true"' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>
      <div class="col-md-12">
        <h4>INFORMAÇÕES DA CARGA</h4>
      </div>

      <div class="col-md-4">

        <div class="form-group">
          @php
          $__f17 = ['name' => 'veiculo_id', 'value' => 'Veiculo' . ':*'];
          @endphp
          <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
          @php
          $__f18 = ['name' => 'veiculo_id', 'list' => $veiculos, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'veiculo_id', 'required', 'placeholder' => 'Veiculo']];
          @endphp
          <x-form.select :name="$__f18['name']" :list="$__f18['list']" :selected="$__f18['selected']" :options="$__f18['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f19 = ['name' => 'prod_predominante', 'value' => 'Produto predominante' . ':*'];
          @endphp
          <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
          @php
          $__f20 = ['name' => 'prod_predominante', 'value' => $dadosDaNFe['produto_predominante'], 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'Produto predominante' ]];
          @endphp
          <x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f21 = ['name' => 'tomador', 'value' => 'Tomador' . ':*'];
          @endphp
          <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
          @php
          $__f22 = ['name' => 'tomador', 'list' => $tiposTomador, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'tomador', 'required']];
          @endphp
          <x-form.select :name="$__f22['name']" :list="$__f22['list']" :selected="$__f22['selected']" :options="$__f22['options']" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f23 = ['name' => 'valor_carga', 'value' => 'Valor da Carga' . ':*'];
          @endphp
          <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
          @php
          $__f24 = ['name' => 'valor_carga', 'value' => $dadosDaNFe['valor_carga'], 'options' => ['class' => 'form-control', 'required type-ref', 'placeholder' => 'Valor da Carga', 'data-mask="000000.00", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f25 = ['name' => 'modal_transp', 'value' => 'Modelo de Transporte' . ':*'];
          @endphp
          <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
          @php
          $__f26 = ['name' => 'modal_transp', 'list' => $modals, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'modal_transp', 'required']];
          @endphp
          <x-form.select :name="$__f26['name']" :list="$__f26['list']" :selected="$__f26['selected']" :options="$__f26['options']" />
        </div>
      </div>

      <div class="col-md-12">
        <h5 class="text-primary">INFORMAÇÕES DE QUANTIDADE</h5>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f27 = ['name' => 'unidade_medida', 'value' => 'Unidade medida' . ':*'];
          @endphp
          <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
          @php
          $__f28 = ['name' => 'unidade_medida', 'list' => $unidadesMedida, 'selected' => $dadosDaNFe['unidade'], 'options' => ['class' => 'form-control select2', 'id' => 'unidade_medida', 'required']];
          @endphp
          <x-form.select :name="$__f28['name']" :list="$__f28['list']" :selected="$__f28['selected']" :options="$__f28['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f29 = ['name' => 'tipo_medida', 'value' => 'Tipo de medida' . ':*'];
          @endphp
          <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
          @php
          $__f30 = ['name' => 'tipo_medida', 'list' => $tiposMedida, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'tipo_medida', 'required']];
          @endphp
          <x-form.select :name="$__f30['name']" :list="$__f30['list']" :selected="$__f30['selected']" :options="$__f30['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f31 = ['name' => 'quantidade_carga', 'value' => 'Quantidade' . ':*'];
          @endphp
          <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
          @php
          $__f32 = ['name' => 'quantidade_carga', 'value' => $dadosDaNFe['quantidade'], 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Quantidade',  'data-mask="000000.000", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <br>
          <a id="addMedida" class="btn btn-primary" style="margin-top: 3px;">
            <i class="fa fa-plus"></i>
            Adicionar
          </a>
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="prod">
            <thead>
              <tr>
                <th>Item</th>
                <th>Código Unidade</th>
                <th>Tipo de Medida</th>
                <th>Quantidade</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody>
              <tr>

              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-12">
        <h5 class="text-primary">COMPONENTES DA CARGA</h5>
        <p class="text-red">*A soma dos valores dos componentes deve ser igual ao valor a receber</p>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f33 = ['name' => 'nome_componente', 'value' => 'Nome do componente' . ':*'];
          @endphp
          <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
          @php
          $__f34 = ['name' => 'nome_componente', 'value' => $dadosDaNFe['componente'], 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Nome do componente' ]];
          @endphp
          <x-form.input type="text" :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f35 = ['name' => 'valor_componente', 'value' => 'Valor do componente' . ':*'];
          @endphp
          <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
          @php
          $__f36 = ['name' => 'valor_componente', 'value' => $dadosDaNFe['valor_frete'], 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Valor do componente', 'data-mask="000000.00", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <br>
          <a id="addComponente" class="btn btn-primary" style="margin-top: 3px;">
            <i class="fa fa-plus"></i>
            Adicionar
          </a>
        </div>
      </div>
      <div class="clearfix"></div>


      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="componentes">
            <thead>
              <tr>
                <th>Item</th>
                <th>Componente</th>
                <th>Valor</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody>
              <tr>

              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-12">
        <h4>INFORMAÇÕES DA ENTREGA</h4>
      </div>

      <div class="col-md-12">

        <h6>Endereço do Tomador</h6>
        <p>
          <input type="checkbox" id="endereco-destinatario" />
          <label for="endereco-destinatario">Endereço do Destinatário</label>
        </p>

        <p>
          <input type="checkbox" id="endereco-remetente" />
          <label for="endereco-remetente">Endereço do Rementente</label>
        </p>
      </div>

      <div class="col-md-12">
        <h5>Endereço do Tomador</h5>
      </div>
      <div class="col-md-5">
        <div class="form-group">
          @php
          $__f37 = ['name' => 'rua_tomador', 'value' => 'Rua' . ':*'];
          @endphp
          <x-form.label :name="$__f37['name']" :value="$__f37['value']" />
          @php
          $__f38 = ['name' => 'rua_tomador', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Rua' ]];
          @endphp
          <x-form.input type="text" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f39 = ['name' => 'numero_tomador', 'value' => 'Número' . ':*'];
          @endphp
          <x-form.label :name="$__f39['name']" :value="$__f39['value']" />
          @php
          $__f40 = ['name' => 'numero_tomador', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Número' ]];
          @endphp
          <x-form.input type="text" :name="$__f40['name']" :value="$__f40['value']" :options="$__f40['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f41 = ['name' => 'cep_tomador', 'value' => 'CEP' . ':*'];
          @endphp
          <x-form.label :name="$__f41['name']" :value="$__f41['value']" />
          @php
          $__f42 = ['name' => 'cep_tomador', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CEP' ]];
          @endphp
          <x-form.input type="text" :name="$__f42['name']" :value="$__f42['value']" :options="$__f42['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f43 = ['name' => 'bairro_tomador', 'value' => 'Bairro' . ':*'];
          @endphp
          <x-form.label :name="$__f43['name']" :value="$__f43['value']" />
          @php
          $__f44 = ['name' => 'bairro_tomador', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Bairro' ]];
          @endphp
          <x-form.input type="text" :name="$__f44['name']" :value="$__f44['value']" :options="$__f44['options']" />
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f45 = ['name' => 'cidade_tomador', 'value' => 'Cidade' . ':*'];
          @endphp
          <x-form.label :name="$__f45['name']" :value="$__f45['value']" />
          @php
          $__f46 = ['name' => 'cidade_tomador', 'list' => $cidades, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'cidade_tomador', 'required']];
          @endphp
          <x-form.select :name="$__f46['name']" :list="$__f46['list']" :selected="$__f46['selected']" :options="$__f46['options']" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f47 = ['name' => 'data_prevista_entrega', 'value' => 'Data previsa de entrega' . ':*'];
          @endphp
          <x-form.label :name="$__f47['name']" :value="$__f47['value']" />
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </span>
            @php
            $__f48 = ['name' => 'data_prevista_entrega', 'value' => $dadosDaNFe['data_entrega'], 'options' => ['class' => 'form-control type-ref', 'required', 'data-mask="00/00/0000"']];
            @endphp
            <x-form.input type="text" :name="$__f48['name']" :value="$__f48['value']" :options="$__f48['options']" />
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f49 = ['name' => 'valor_transporte', 'value' => 'Valor da Prestação de Serviço' . ':*'];
          @endphp
          <x-form.label :name="$__f49['name']" :value="$__f49['value']" />
          @php
          $__f50 = ['name' => 'valor_transporte', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'Valor da Prestação de Serviço' ]];
          @endphp
          <x-form.input type="text" :name="$__f50['name']" :value="$__f50['value']" :options="$__f50['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f51 = ['name' => 'valor_receber', 'value' => 'Valor a Receber' . ':*'];
          @endphp
          <x-form.label :name="$__f51['name']" :value="$__f51['value']" />
          @php
          $__f52 = ['name' => 'valor_receber', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Valor a Receber' ]];
          @endphp
          <x-form.input type="text" :name="$__f52['name']" :value="$__f52['value']" :options="$__f52['options']" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f53 = ['name' => 'cidade_envio', 'value' => 'Municipio envio' . ':*'];
          @endphp
          <x-form.label :name="$__f53['name']" :value="$__f53['value']" />
          @php
          $__f54 = ['name' => 'cidade_envio', 'list' => $cidades, 'selected' => $dadosDaNFe['munipio_envio'], 'options' => ['class' => 'form-control select2', 'id' => 'cidade_envio', 'required']];
          @endphp
          <x-form.select :name="$__f54['name']" :list="$__f54['list']" :selected="$__f54['selected']" :options="$__f54['options']" />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f55 = ['name' => 'cidade_inicio', 'value' => 'Municipio Inicio' . ':*'];
          @endphp
          <x-form.label :name="$__f55['name']" :value="$__f55['value']" />
          @php
          $__f56 = ['name' => 'cidade_inicio', 'list' => $cidades, 'selected' => $dadosDaNFe['munipio_envio'], 'options' => ['class' => 'form-control select2', 'id' => 'cidade_inicio', 'required']];
          @endphp
          <x-form.select :name="$__f56['name']" :list="$__f56['list']" :selected="$__f56['selected']" :options="$__f56['options']" />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f57 = ['name' => 'cidade_fim', 'value' => 'Municipio Fim' . ':*'];
          @endphp
          <x-form.label :name="$__f57['name']" :value="$__f57['value']" />
          @php
          $__f58 = ['name' => 'cidade_fim', 'list' => $cidades, 'selected' => $dadosDaNFe['munipio_final'], 'options' => ['class' => 'form-control select2', 'id' => 'cidade_fim', 'required']];
          @endphp
          <x-form.select :name="$__f58['name']" :list="$__f58['list']" :selected="$__f58['selected']" :options="$__f58['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f59 = ['name' => 'retira', 'value' => 'Retira' . ':*'];
          @endphp
          <x-form.label :name="$__f59['name']" :value="$__f59['value']" />
          @php
          $__f60 = ['name' => 'retira', 'list' => [1 => 'sim', 0 => 'não'], 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'retira', 'required']];
          @endphp
          <x-form.select :name="$__f60['name']" :list="$__f60['list']" :selected="$__f60['selected']" :options="$__f60['options']" />
        </div>
      </div>

      <div class="col-md-5">
        <div class="form-group">
          @php
          $__f61 = ['name' => 'detalhes_retira', 'value' => 'Detalhes(opcional)' . ':*'];
          @endphp
          <x-form.label :name="$__f61['name']" :value="$__f61['value']" />
          @php
          $__f62 = ['name' => 'detalhes_retira', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Detalhes(opcional)' ]];
          @endphp
          <x-form.input type="text" :name="$__f62['name']" :value="$__f62['value']" :options="$__f62['options']" />
        </div>
      </div>

      <div class="col-md-7">
        <div class="form-group">
          @php
          $__f63 = ['name' => 'obs', 'value' => 'Informação Adicional' . ':*'];
          @endphp
          <x-form.label :name="$__f63['name']" :value="$__f63['value']" />
          @php
          $__f64 = ['name' => 'obs', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Informação Adicional' ]];
          @endphp
          <x-form.input type="text" :name="$__f64['name']" :value="$__f64['value']" :options="$__f64['options']" />
        </div>
      </div>
      <input type="hidden" name="componentes" id="comps">
      <input type="hidden" name="medidas" id="meds">

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
      <button id="finalizar" type="submit" class="btn btn-primary pull-right disabled" id="submit_user_button">@lang( 'messages.save' ) CTe</button>
    </div>
  </div>
  <x-form.close />
  @stop
  @section('javascript')
  <script type="text/javascript">

    $('#file').change(function() {
      $('#form-import').submit();
    });

    var CLIENTES = []
    var MEDIDAS = []
    var COMPONENTES = []
    var REMETENTE = null;
    var DESTINATARIO = null;
    var CHAVES = [];
    $('#remetente_id').change(() => {
      selectRemetente();
    })

    function selectRemetente(){
      let id =  $('#remetente_id').val()
      CLIENTES.map((c) => {
        if(c.id == id){
          console.log(c)
          REMETENTE = c
          $('#remetente-nome').html(c.name)
          $('#remetente-cnpj').html(c.cpf_cnpj)
          $('#remetente-ie').html(c.ie_rg)
          $('#remetente-endereco').html(c.rua + ', ' + c.numero)
          $('#remetente-cidade').html(c.cidade.nome + ' (' + c.cidade.uf + ')')

          $('#box-remetente').css('display', 'block')
        }
      })
    }

    $('#destinatario_id').change(() => {
      selectDestinatario();
    })

    function selectDestinatario(){
      let id =  $('#destinatario_id').val()
      CLIENTES.map((c) => {
        if(c.id == id){
          DESTINATARIO = c
          $('#destinatario-nome').html(c.name)
          $('#destinatario-cnpj').html(c.cpf_cnpj)
          $('#destinatario-ie').html(c.ie_rg)
          $('#destinatario-endereco').html(c.rua + ', ' + c.numero)
          $('#destinatario-cidade').html(c.cidade.nome + ' (' + c.cidade.uf + ')')

          $('#box-destinatario').css('display', 'block')
        }
      })
    }

    $('#addChave').click(() => {
      let chave = $('#chave_nfe').val();
      if(chave.length == 44){
        adicionarChaveArray(chave)
      }else{
        swal('Erro', 'Informe 44 caracteres correspondentes a NF-e', 'error')
      }
    })

    function adicionarChaveArray(chave){
      if(!CHAVES.includes(chave)){

        CHAVES.push(chave)
        montaHtmlChaveNfe((html) => {
          $('#chaves_list').html(html)
        })
        $('#chaves_nfe').val(CHAVES)
        $('#chave_nfe').val('')
      }else{
        swal('Erro', 'Esta chave ja esta na lista', 'error')
      }


    }

    function montaHtmlChaveNfe(call){
      let html = '';
      CHAVES.map((ch) => {

        html += '<p><strong> '+ch+
        '<i onclick="deleteChave(\''+ch+'\')" class="fa fa-times text-danger"></i></strong></p>'

      })

      call(html)
    }

    function deleteChave(chave){
      let temp = [];
      CHAVES.map((ch) => {
        if(ch != chave) temp.push(ch)
      })

      CHAVES = temp;
      $('#chaves_nfe').val(CHAVES)

      montaHtmlChaveNfe((html) => {
        $('#chaves_list').html(html)
      })
    }


    // MEDIDAS CTE >>>>>>>

    $('#addMedida').click(() => {
      let unidade_medida = $('#unidade_medida').val();
      let tipo_medida = $('#tipo_medida').val();
      let quantidade = $('#quantidade_carga').val();
      MEDIDAS.push({id: (MEDIDAS.length+1), unidade_medida: unidade_medida,
        tipo_medida: tipo_medida, quantidade: quantidade});
      console.log(MEDIDAS)

      let t = montaTabela();
      $('#prod tbody').html(t)
    })

    function montaTabela(){
      let t = ""; 
      MEDIDAS.map((v) => {
        t += "<tr>";
        t += "<td>"+v.id+"</td>";
        t += "<td>"+unidadeMedidaExibe(v.unidade_medida)+"</td>";
        t += "<td>"+v.tipo_medida+"</td>";
        t += "<td>"+v.quantidade+"</td>";
        t += "<td><a href='#!' class='btn btn-danger btn-sm' onclick='deleteItem("+v.id+")'>"
        t += "<i class='fa fa-trash'></i></a></td>";
        t+= "</tr>";
      });
      $('#meds').val(JSON.stringify(MEDIDAS))

      habilitaBtnSalarCTe()
      return t;
    }

    function deleteItem(id){
      let temp = [];
      MEDIDAS.map((v) => {
        if(v.id != id){
          temp.push(v)
        }
      });
      MEDIDAS = temp;
      refatoreItens()
      let t = montaTabela(); 
      $('#prod tbody').html(t)

    }

    function refatoreItens(){
      let cont = 1;
      let temp = [];
      MEDIDAS.map((v) => {
        v.id = cont;
        temp.push(v)
        cont++;
      })
      MEDIDAS = temp;
    }

    function unidadeMedidaExibe(cod){
      if(cod == '00'){ 
        return 'M3'
      }else if(cod == '01'){ 
        return 'KG' 
      }else if(cod == '02'){
        return 'TON'
      }else if(cod == '03') {
        return 'UNIDADE'
      }else if(cod == '04') {
        return 'M2'
      }
    }

    // MEDIDAS CTE FIM >>>>>>>

    // COMPONENTES CTE >>>>>>>

    $('#addComponente').click(() => {
      let nome_componente = $('#nome_componente').val();
      let valor_componente = $('#valor_componente').val();
      COMPONENTES.push({id: (COMPONENTES.length+1), valor: valor_componente,
        nome: nome_componente});
      let t = montaTabelaComponentes();
      $('#componentes tbody').html(t)
      console.log(JSON.stringify(COMPONENTES))
      
      habilitaBtnSalarCTe();
    });

    function montaTabelaComponentes(){
      let t = ""; 
      SOMACOMPONENTES = 0;
      COMPONENTES.map((v) => {
        t += "<tr>";
        t += "<td>"+v.id+"</td>";
        t += "<td>"+v.nome+"</td>";
        t += "<td>"+v.valor+"</td>";
        t += "<td><a href='#!' class='btn btn-danger btn-sm'  onclick='deleteComponente("+v.id+")'>"
        t += "<i class='fa fa-trash'></i></a></td>";
        t+= "</tr>";

        SOMACOMPONENTES += parseFloat(v.valor.replace(',', '.'));
      });
      $('#comps').val(JSON.stringify(COMPONENTES))
      $('#valor_receber').val(SOMACOMPONENTES.toFixed(2));
      $('#valor_transporte').val(SOMACOMPONENTES.toFixed(2));
      habilitaBtnSalarCTe()
      return t;
    }

    function deleteComponente(id){
      let temp = [];
      COMPONENTES.map((v) => {
        if(v.id != id){
          temp.push(v)
        }
      });
      COMPONENTES = temp;
      refatoreComponentes()
      let t = montaTabelaComponentes(); 
      $('#componentes tbody').html(t)

    }

    function refatoreComponentes(){
      let cont = 1;
      let temp = [];
      COMPONENTES.map((v) => {
        v.id = cont;
        temp.push(v)
        cont++;
      })
      COMPONENTES = temp;
    }

    // COMPONENTES CTE  FIM >>>>>>>

    function habilitaBtnSalarCTe(){
      let tipoDocumento = false;
      let inputs = false;

      console.log(CHAVES.length)

      if(CHAVES.length == 0 && $('#descOutros').val() != "" && $('#nDoc').val() != "" && $('#vDocFisc').val() != ""){
        tipoDocumento = true;
      }else if(CHAVES.length >= 1 && $('#descOutros').val() == "" && $('#nDoc').val() == "" && 
        $('#vDocFisc').val() == ""){
        tipoDocumento = true
      }

      if($('#prod_predominante').val() != "" && $('#valor_carga').val() != "" && $('#valor_transporte').val() != "" && $('#valor_receber').val() != ""){
        inputs = true;
      }

      console.log(tipoDocumento)

      if(MEDIDAS.length > 0 && COMPONENTES.length > 0 && DESTINATARIO != null && REMETENTE != null &&tipoDocumento && inputs){
        $('#finalizar').removeClass('disabled')

      }
    }

    $('.type-ref').keyup(() => {
      habilitaBtnSalarCTe()
    })


    $('#endereco-destinatario').click(() => {
      let v = $('#endereco-destinatario').is(':checked');
      $('#endereco-remetente').prop('checked', false);
      if(v){
        if(DESTINATARIO){
          $('#rua_tomador').val(DESTINATARIO.rua)
          $('#numero_tomador').val(DESTINATARIO.numero)
          $('#bairro_tomador').val(DESTINATARIO.bairro)
          $('#cep_tomador').val(DESTINATARIO.cep)
          $('#cidade_tomador').val(DESTINATARIO.cidade.id).change()

          habilitaCampos();

        }else{

          swal("Erro!", "Destinatário não selecionado!", "warning")

          $('#endereco-destinatario').prop('checked', false); 

        }
      }else{
        desabilitaCampos();
      }
    })

    $('#endereco-remetente').click(() => {
      let v = $('#endereco-remetente').is(':checked');
      $('#endereco-destinatario').prop('checked', false);
      if(v){
        if(REMETENTE){
          $('#rua_tomador').val(REMETENTE.rua)
          $('#numero_tomador').val(REMETENTE.numero)
          $('#bairro_tomador').val(REMETENTE.bairro)
          $('#cep_tomador').val(REMETENTE.cep)
          $('#cidade_tomador').val(REMETENTE.cidade.id).change()

          habilitaCampos();

        }else{

          swal("Erro!", "Remetente não selecionado!", "warning")

          $('#endereco-remetente').prop('checked', false); 
        }
      }else{
        desabilitaCampos();
      }
    })

    function habilitaCampos(){
      // $('#rua_tomador').prop('disabled', true)
      // $('#numero_tomador').prop('disabled', true)
      // $('#bairro_tomador').prop('disabled', true)
      // $('#cep_tomador').prop('disabled', true)
      // $('#autocomplete-cidade-tomador').prop('disabled', true)
    }

    function desabilitaCampos(){
      // $('#rua_tomador').removeAttr('disabled')
      // $('#numero_tomador').removeAttr('disabled')
      // $('#bairro_tomador').removeAttr('disabled')
      // $('#cep_tomador').removeAttr('disabled')
      // $('#autocomplete-cidade-tomador').removeAttr('disabled')
    }



    $(document).ready(function(){

      CLIENTES = JSON.parse($('#clientesAux').val())

      selectRemetente();
      selectDestinatario();

      let chave = $('#chave_nfe').val();
      if(chave.length == 44){
        adicionarChaveArray(chave)
      }else{
      }


      $('#selected_contacts').on('ifChecked', function(event){
        $('div.selected_contacts_div').removeClass('hide');
      });
      $('#selected_contacts').on('ifUnchecked', function(event){
        $('div.selected_contacts_div').addClass('hide');
      });

      $('#allow_login').on('ifChecked', function(event){
        $('div.user_auth_fields').removeClass('hide');
      });
      $('#allow_login').on('ifUnchecked', function(event){
        $('div.user_auth_fields').addClass('hide');
      });
    });

    $('form#veiculo_add_form').validate({
      rules: {
        placa: {
          required: true,
          minlength: 8
        },
        rntrc: {
          required: true,
          minlength: 8
        },
      },
      messages: {
        placa: {
          required: 'Campo obrigatório',
          minlength: 'Valor inválido'

        },
        modelo: {
          required: 'Campo obrigatório' ,
        },
        modelo: {
          required: 'Campo obrigatório' ,
        },
        marca: {
          required: 'Campo obrigatório' ,
        },
        cor: {
          required: 'Campo obrigatório' ,
        },
        tara: {
          required: 'Campo obrigatório' ,
        },
        uf: {
          required: 'Campo obrigatório' ,
        },
        capacidade: {
          required: 'Campo obrigatório' ,
        },
        proprietario_nome: {
          required: 'Campo obrigatório' ,
        },
        proprietario_documento: {
          required: 'Campo obrigatório' ,
        },
        proprietario_ie: {
          required: 'Campo obrigatório' ,
        },
        rntrc: {
          required: 'Campo obrigatório',
          minlength: 'Informe no minimo 8 caracteres'
        },
      }
    });
    $('#username').change( function(){
      if($('#show_username').length > 0){
        if($(this).val().trim() != ''){
          $('#show_username').html("{{__('lang_v1.your_username_will_be')}}: <b>" + $(this).val() + "{{$username_ext}}</b>");
        } else {
          $('#show_username').html('');
        }
      }
    });
  </script>
  @endsection
