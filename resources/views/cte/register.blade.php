@extends('layouts.app')

@section('title', 'Adicionar CTe')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Adicionar </h1>  


</section>

<!-- Main content -->
<section class="content">

  @component('components.widget')

  <div class="col-md-4">
    <form id="form-import" method="post" action="/cte/importarXml" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label>Importar XML (Opcional)</label>
        <input name="file" type="file" accept=".xml" id="file">

      </div>
    </form>
  </div>
  @endcomponent

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

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f4 = ['name' => 'globalizado', 'value' => 'Tipo globalizado' . ':*'];
          @endphp
          <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'globalizado', 'list' => ['0' => 'Não', 1 => 'Sim'], 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'contact_type', 'required']];
          @endphp
          <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f6 = ['name' => 'cst', 'value' => 'CST' . ':*'];
          @endphp
          <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
          @php
          $__f7 = ['name' => 'cst', 'list' => App\Models\Cte::getCsts(), 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'contact_type', 'required']];
          @endphp
          <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f8 = ['name' => 'perc_icms', 'value' => '%ICMS' . ':*'];
          @endphp
          <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
          @php
          $__f9 = ['name' => 'perc_icms', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => '%ICMS', 'data-mask="00,00", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
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
            $__f10 = ['name' => 'select_location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.select_location'), 'id' => 'select_location_id', 'required', 'autofocus'], 'optionsAttributes' => $bl_attributes];
            @endphp
            <x-form.select :name="$__f10['name']" :list="$__f10['list']" :selected="$__f10['selected']" :options="$__f10['options']" :options-attributes="$__f10['optionsAttributes']" />
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
          $__f11 = ['name' => 'remetente_id', 'value' => 'Remetente' . ':*'];
          @endphp
          <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
          @php
          $__f12 = ['name' => 'remetente_id', 'list' => $clientes, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'remetente_id', 'required', 'placeholder' => 'Selecione o remetente']];
          @endphp
          <x-form.select :name="$__f12['name']" :list="$__f12['list']" :selected="$__f12['selected']" :options="$__f12['options']" />
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
          $__f13 = ['name' => 'destinatario_id', 'value' => 'Destinatário' . ':*'];
          @endphp
          <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
          @php
          $__f14 = ['name' => 'destinatario_id', 'list' => $clientes, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'destinatario_id', 'required', 'placeholder' => 'Selecione o destinatário']];
          @endphp
          <x-form.select :name="$__f14['name']" :list="$__f14['list']" :selected="$__f14['selected']" :options="$__f14['options']" />
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
                        <input placeholder="Chave NFe" class="form-control type-ref" data-mask="00000000000000000000000000000000000000000000" name="chave_nfe" type="text" id="chave_nfe">
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
                        $__f15 = ['name' => 'tpDoc', 'value' => 'Tipo documento' . ':*'];
                        @endphp
                        <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
                        @php
                        $__f16 = ['name' => 'tpDoc', 'list' => $tipos, 'selected' => '', 'options' => ['class' => 'form-control', 'id' => 'tpDoc', 'required']];
                        @endphp
                        <x-form.select :name="$__f16['name']" :list="$__f16['list']" :selected="$__f16['selected']" :options="$__f16['options']" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        @php
                        $__f17 = ['name' => 'descOutros', 'value' => 'Descrição do Doc.' . ':*'];
                        @endphp
                        <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
                        @php
                        $__f18 = ['name' => 'descOutros', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Descrição do Doc.' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        @php
                        $__f19 = ['name' => 'nDoc', 'value' => 'Numero do Doc.' . ':*'];
                        @endphp
                        <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
                        @php
                        $__f20 = ['name' => 'nDoc', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Numero do Doc.' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        @php
                        $__f21 = ['name' => 'vDocFisc', 'value' => 'Valor do Documento' . ':*'];
                        @endphp
                        <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
                        @php
                        $__f22 = ['name' => 'vDocFisc', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Valor do Documento', 'data-mask="000000,00", data-mask-reverse="true"' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
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
          $__f23 = ['name' => 'veiculo_id', 'value' => 'Veiculo' . ':*'];
          @endphp
          <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
          @php
          $__f24 = ['name' => 'veiculo_id', 'list' => $veiculos, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'veiculo_id', 'required', 'placeholder' => 'Veiculo']];
          @endphp
          <x-form.select :name="$__f24['name']" :list="$__f24['list']" :selected="$__f24['selected']" :options="$__f24['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f25 = ['name' => 'prod_predominante', 'value' => 'Produto predominante' . ':*'];
          @endphp
          <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
          @php
          $__f26 = ['name' => 'prod_predominante', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'Produto predominante' ]];
          @endphp
          <x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f27 = ['name' => 'tomador', 'value' => 'Tomador' . ':*'];
          @endphp
          <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
          @php
          $__f28 = ['name' => 'tomador', 'list' => $tiposTomador, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'tomador', 'required']];
          @endphp
          <x-form.select :name="$__f28['name']" :list="$__f28['list']" :selected="$__f28['selected']" :options="$__f28['options']" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f29 = ['name' => 'valor_carga', 'value' => 'Valor da Carga' . ':*'];
          @endphp
          <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
          @php
          $__f30 = ['name' => 'valor_carga', 'value' => null, 'options' => ['class' => 'form-control', 'required type-ref', 'placeholder' => 'Valor da Carga', 'data-mask="000000,00", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f31 = ['name' => 'modal_transp', 'value' => 'Modelo de Transporte' . ':*'];
          @endphp
          <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
          @php
          $__f32 = ['name' => 'modal_transp', 'list' => $modals, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'modal_transp', 'required']];
          @endphp
          <x-form.select :name="$__f32['name']" :list="$__f32['list']" :selected="$__f32['selected']" :options="$__f32['options']" />
        </div>
      </div>

      <div class="col-md-12">
        <h5 class="text-primary">INFORMAÇÕES DE QUANTIDADE</h5>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f33 = ['name' => 'unidade_medida', 'value' => 'Unidade medida' . ':*'];
          @endphp
          <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
          @php
          $__f34 = ['name' => 'unidade_medida', 'list' => $unidadesMedida, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'unidade_medida', 'required']];
          @endphp
          <x-form.select :name="$__f34['name']" :list="$__f34['list']" :selected="$__f34['selected']" :options="$__f34['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f35 = ['name' => 'tipo_medida', 'value' => 'Tipo de medida' . ':*'];
          @endphp
          <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
          @php
          $__f36 = ['name' => 'tipo_medida', 'list' => $tiposMedida, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'tipo_medida', 'required']];
          @endphp
          <x-form.select :name="$__f36['name']" :list="$__f36['list']" :selected="$__f36['selected']" :options="$__f36['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f37 = ['name' => 'quantidade_carga', 'value' => 'Quantidade' . ':*'];
          @endphp
          <x-form.label :name="$__f37['name']" :value="$__f37['value']" />
          @php
          $__f38 = ['name' => 'quantidade_carga', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Quantidade',  'data-mask="000000.000", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />
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
          $__f39 = ['name' => 'nome_componente', 'value' => 'Nome do componente' . ':*'];
          @endphp
          <x-form.label :name="$__f39['name']" :value="$__f39['value']" />
          @php
          $__f40 = ['name' => 'nome_componente', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Nome do componente' ]];
          @endphp
          <x-form.input type="text" :name="$__f40['name']" :value="$__f40['value']" :options="$__f40['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f41 = ['name' => 'valor_componente', 'value' => 'Valor do componente' . ':*'];
          @endphp
          <x-form.label :name="$__f41['name']" :value="$__f41['value']" />
          @php
          $__f42 = ['name' => 'valor_componente', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Valor do componente', 'data-mask="000000,00", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f42['name']" :value="$__f42['value']" :options="$__f42['options']" />
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
          $__f43 = ['name' => 'rua_tomador', 'value' => 'Rua' . ':*'];
          @endphp
          <x-form.label :name="$__f43['name']" :value="$__f43['value']" />
          @php
          $__f44 = ['name' => 'rua_tomador', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'Rua' ]];
          @endphp
          <x-form.input type="text" :name="$__f44['name']" :value="$__f44['value']" :options="$__f44['options']" />
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f45 = ['name' => 'numero_tomador', 'value' => 'Número' . ':*'];
          @endphp
          <x-form.label :name="$__f45['name']" :value="$__f45['value']" />
          @php
          $__f46 = ['name' => 'numero_tomador', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'Número' ]];
          @endphp
          <x-form.input type="text" :name="$__f46['name']" :value="$__f46['value']" :options="$__f46['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f47 = ['name' => 'cep_tomador', 'value' => 'CEP' . ':*'];
          @endphp
          <x-form.label :name="$__f47['name']" :value="$__f47['value']" />
          @php
          $__f48 = ['name' => 'cep_tomador', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'CEP' ]];
          @endphp
          <x-form.input type="text" :name="$__f48['name']" :value="$__f48['value']" :options="$__f48['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f49 = ['name' => 'bairro_tomador', 'value' => 'Bairro' . ':*'];
          @endphp
          <x-form.label :name="$__f49['name']" :value="$__f49['value']" />
          @php
          $__f50 = ['name' => 'bairro_tomador', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'Bairro' ]];
          @endphp
          <x-form.input type="text" :name="$__f50['name']" :value="$__f50['value']" :options="$__f50['options']" />
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f51 = ['name' => 'cidade_tomador', 'value' => 'Cidade' . ':*'];
          @endphp
          <x-form.label :name="$__f51['name']" :value="$__f51['value']" />
          @php
          $__f52 = ['name' => 'cidade_tomador', 'list' => $cidades, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'cidade_tomador', 'required']];
          @endphp
          <x-form.select :name="$__f52['name']" :list="$__f52['list']" :selected="$__f52['selected']" :options="$__f52['options']" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f53 = ['name' => 'data_prevista_entrega', 'value' => 'Data previsa de entrega' . ':*'];
          @endphp
          <x-form.label :name="$__f53['name']" :value="$__f53['value']" />
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </span>

            @php
            $__f54 = ['name' => 'data_prevista_entrega', 'value' => '', 'options' => ['class' => 'form-control', 'readonly', 'required', 'id' => 'vencimento']];
            @endphp
            <x-form.input type="text" :name="$__f54['name']" :value="$__f54['value']" :options="$__f54['options']" />
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f55 = ['name' => 'valor_transporte', 'value' => 'Valor da Prestação de Serviço' . ':*'];
          @endphp
          <x-form.label :name="$__f55['name']" :value="$__f55['value']" />
          @php
          $__f56 = ['name' => 'valor_transporte', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'required', 'placeholder' => 'Valor da Prestação de Serviço', 'data-mask="000000,00", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f56['name']" :value="$__f56['value']" :options="$__f56['options']" />
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f57 = ['name' => 'valor_receber', 'value' => 'Valor a Receber' . ':*'];
          @endphp
          <x-form.label :name="$__f57['name']" :value="$__f57['value']" />
          @php
          $__f58 = ['name' => 'valor_receber', 'value' => null, 'options' => ['class' => 'form-control', 'required type-ref', 'placeholder' => 'Valor a Receber', 'data-mask="000000,00", data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f58['name']" :value="$__f58['value']" :options="$__f58['options']" />
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f59 = ['name' => 'cidade_envio', 'value' => 'Municipio envio' . ':*'];
          @endphp
          <x-form.label :name="$__f59['name']" :value="$__f59['value']" />
          @php
          $__f60 = ['name' => 'cidade_envio', 'list' => $cidades, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'cidade_envio', 'required']];
          @endphp
          <x-form.select :name="$__f60['name']" :list="$__f60['list']" :selected="$__f60['selected']" :options="$__f60['options']" />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f61 = ['name' => 'cidade_inicio', 'value' => 'Municipio Inicio' . ':*'];
          @endphp
          <x-form.label :name="$__f61['name']" :value="$__f61['value']" />
          @php
          $__f62 = ['name' => 'cidade_inicio', 'list' => $cidades, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'cidade_inicio', 'required']];
          @endphp
          <x-form.select :name="$__f62['name']" :list="$__f62['list']" :selected="$__f62['selected']" :options="$__f62['options']" />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f63 = ['name' => 'cidade_fim', 'value' => 'Municipio Fim' . ':*'];
          @endphp
          <x-form.label :name="$__f63['name']" :value="$__f63['value']" />
          @php
          $__f64 = ['name' => 'cidade_fim', 'list' => $cidades, 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'cidade_fim', 'required']];
          @endphp
          <x-form.select :name="$__f64['name']" :list="$__f64['list']" :selected="$__f64['selected']" :options="$__f64['options']" />
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f65 = ['name' => 'retira', 'value' => 'Retira' . ':*'];
          @endphp
          <x-form.label :name="$__f65['name']" :value="$__f65['value']" />
          @php
          $__f66 = ['name' => 'retira', 'list' => [1 => 'sim', 0 => 'não'], 'selected' => '', 'options' => ['class' => 'form-control select2', 'id' => 'retira', 'required']];
          @endphp
          <x-form.select :name="$__f66['name']" :list="$__f66['list']" :selected="$__f66['selected']" :options="$__f66['options']" />
        </div>
      </div>

      <div class="col-md-5">
        <div class="form-group">
          @php
          $__f67 = ['name' => 'detalhes_retira', 'value' => 'Detalhes(opcional)' . ':*'];
          @endphp
          <x-form.label :name="$__f67['name']" :value="$__f67['value']" />
          @php
          $__f68 = ['name' => 'detalhes_retira', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Detalhes(opcional)' ]];
          @endphp
          <x-form.input type="text" :name="$__f68['name']" :value="$__f68['value']" :options="$__f68['options']" />
        </div>
      </div>

      <div class="col-md-7">
        <div class="form-group">
          @php
          $__f69 = ['name' => 'obs', 'value' => 'Informação Adicional' . ':*'];
          @endphp
          <x-form.label :name="$__f69['name']" :value="$__f69['value']" />
          @php
          $__f70 = ['name' => 'obs', 'value' => null, 'options' => ['class' => 'form-control type-ref', 'placeholder' => 'Informação Adicional' ]];
          @endphp
          <x-form.input type="text" :name="$__f70['name']" :value="$__f70['value']" :options="$__f70['options']" />
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
      <button id="finalizar" type="submit" class="btn btn-primary pull-right disabled">@lang( 'messages.save' ) CTe</button>
    </div>
  </div>
  <br><br>
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
      let id =  $('#remetente_id').val()
      CLIENTES.map((c) => {
        if(c.id == id){
          REMETENTE = c
          $('#remetente-nome').html(c.name)
          $('#remetente-cnpj').html(c.cpf_cnpj)
          $('#remetente-ie').html(c.ie_rg)
          $('#remetente-endereco').html(c.rua + ', ' + c.numero)
          $('#remetente-cidade').html(c.cidade.nome + ' (' + c.cidade.uf + ')')

          $('#box-remetente').css('display', 'block')
        }


      })
    })
    $('#destinatario_id').change(() => {
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
    })

    // Adicionando chave nfe

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
      $('#valor_receber').val(SOMACOMPONENTES.toFixed(2).replace(',', '.'));
      $('#valor_transporte').val(SOMACOMPONENTES.toFixed(2).replace(',', '.'));
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
          $('#cidade_envio').val(DESTINATARIO.cidade.id).change()
          $('#cidade_inicio').val(DESTINATARIO.cidade.id).change()
          $('#cidade_fim').val(DESTINATARIO.cidade.id).change()

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
          $('#cidade_envio').val(REMETENTE.cidade.id).change()
          $('#cidade_inicio').val(REMETENTE.cidade.id).change()
          $('#cidade_fim').val(DESTINATARIO.cidade.id).change()
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

      $('#remetente_id').val('').change()
      $('#destinatario_id').val('').change()

      CLIENTES = JSON.parse($('#clientesAux').val())

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

    $(document).on('click', '#finalizar', function(e) {
      e.preventDefault();

      $('form#cte_add_form').validate()
      if ($('form#cte_add_form').valid()) {
        $('form#cte_add_form').submit();
      }
    })
    
  </script>
  @endsection
