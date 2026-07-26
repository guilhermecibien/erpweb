<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('BusinessLocationController@update', [$location->id]), 'method' => 'PUT', 'id' => 'business_location_add_form', 'files' => true ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    @php
    $__f2 = ['name' => 'hidden_id', 'value' => $location->id, 'options' => ['id' => 'hidden_id']];
    @endphp
    <x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'business.edit_business_location' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f3 = ['name' => 'cnpj', 'value' => 'CNPJ' . ':*'];
            @endphp
            <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
            @php
            $__f4 = ['name' => 'cnpj', 'value' => $location->cnpj, 'options' => ['class' => 'form-control cpf_cnpj', 'required', 'placeholder' => 'CNPJ']];
            @endphp
            <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            @php
            $__f5 = ['name' => 'tipo', 'value' => 'UF' . ':'];
            @endphp
            <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
            <div class="input-group" style="width: 100%;">
              <span class="input-group-addon">
                <a onclick="buscaDados()"><i class="fa fa-search"></i></a>
              </span>
              @php
              $__f6 = ['name' => 'uf', 'list' => $estados, 'selected' => '', 'options' => ['id' => 'uf2', 'class' => 'form-control select2 featured-field']];
              @endphp
              <x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
            </div>
          </div>
        </div>
       
        <div class="col-sm-7">
          <div class="form-group">
            @php
            $__f7 = ['name' => 'name', 'value' => 'Nome Fantasia' . ':*'];
            @endphp
            <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
            @php
            $__f8 = ['name' => 'name', 'value' => $location->name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Nome' ]];
            @endphp
            <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f9 = ['name' => 'razao_social', 'value' => __('business.business_razao') . ':*'];
            @endphp
            <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
            @php
            $__f10 = ['name' => 'razao_social', 'value' => $location->razao_social, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('business.business_razao')]];
            @endphp
            <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
            @if($errors->has('razao_social'))
            <span class="text-danger">{{ $errors->first('razao_social') }}</span>
            @endif

          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-sm-2">
          <div class="form-group">
            @php
            $__f11 = ['name' => 'location_id', 'value' => __( 'lang_v1.location_id' ) . ':'];
            @endphp
            <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
            @php
            $__f12 = ['name' => 'location_id', 'value' => $location->location_id, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.location_id' ) ]];
            @endphp
            <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f13 = ['name' => 'landmark', 'value' => __( 'business.landmark' ) . ':'];
            @endphp
            <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
            @php
            $__f14 = ['name' => 'landmark', 'value' => $location->landmark, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.landmark' ) ]];
            @endphp
            <x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f15 = ['name' => 'zip_code', 'value' => __( 'business.zip_code' ) . ':*'];
            @endphp
            <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
            @php
            $__f16 = ['name' => 'zip_code', 'value' => $location->cep, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.zip_code'), 'required', 'data-mask="00000-000"' ]];
            @endphp
            <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
          </div>
        </div>


        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f17 = ['name' => 'cidade_id', 'value' => 'Cidade:*'];
            @endphp
            <x-form.label :name="$__f17['name']" :value="$__f17['value']" /><br>
            @php
            $__f18 = ['name' => 'cidade_id', 'list' => $cities, 'selected' => $location->cidade ? $location->cidade->id : null, 'options' => ['class' => 'form-control select2', 'required', 'style' => 'width: 100%']];
            @endphp
            <x-form.select :name="$__f18['name']" :list="$__f18['list']" :selected="$__f18['selected']" :options="$__f18['options']" />
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f19 = ['name' => 'ie', 'value' => 'IE' . ':*'];
            @endphp
            <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
            @php
            $__f20 = ['name' => 'ie', 'value' => $location->ie, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'IE']];
            @endphp
            <x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f21 = ['name' => 'rua', 'value' => 'Rua' . ':*'];
            @endphp
            <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
            @php
            $__f22 = ['name' => 'rua', 'value' => $location->rua, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Rua']];
            @endphp
            <x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f23 = ['name' => 'numero', 'value' => 'Número' . ':*'];
            @endphp
            <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
            @php
            $__f24 = ['name' => 'numero', 'value' => $location->numero, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Número']];
            @endphp
            <x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f25 = ['name' => 'bairro', 'value' => 'Bairro' . ':*'];
            @endphp
            <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
            @php
            $__f26 = ['name' => 'bairro', 'value' => $location->bairro, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Bairro']];
            @endphp
            <x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
          </div>
        </div>


        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f27 = ['name' => 'telefone', 'value' => 'Telefone' . ':*'];
            @endphp
            <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
            @php
            $__f28 = ['name' => 'telefone', 'value' => $location->telefone, 'options' => ['class' => 'form-control', 'required', 'data-mask="00 000000000"', 'placeholder' => 'Telefone']];
            @endphp
            <x-form.input type="text" :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">

            @php
            $__f29 = ['name' => 'regime', 'value' => 'Regime' . ':'];
            @endphp
            <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
            @php
            $__f30 = ['name' => 'regime', 'list' => ['1' => 'Simples', '3' => 'Normal'], 'selected' => $location->regime, 'options' => ['class' => 'form-control select2', 'required']];
            @endphp
            <x-form.select :name="$__f30['name']" :list="$__f30['list']" :selected="$__f30['selected']" :options="$__f30['options']" />
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f31 = ['name' => 'ultimo_numero_nfe', 'value' => 'Ultimo Núm. NFe' . ':*'];
            @endphp
            <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
            @php
            $__f32 = ['name' => 'ultimo_numero_nfe', 'value' => $location->ultimo_numero_nfe, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Ultimo Núm. NFe']];
            @endphp
            <x-form.input type="text" :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f33 = ['name' => 'ultimo_numero_nfce', 'value' => 'Ultimo Núm. NFCe' . ':*'];
            @endphp
            <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
            @php
            $__f34 = ['name' => 'ultimo_numero_nfce', 'value' => $location->ultimo_numero_nfce, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Ultimo Núm. NFCe']];
            @endphp
            <x-form.input type="text" :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f35 = ['name' => 'ultimo_numero_cte', 'value' => 'Ultimo Núm. CTe' . ':*'];
            @endphp
            <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
            @php
            $__f36 = ['name' => 'ultimo_numero_cte', 'value' => $location->ultimo_numero_cte, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Ultimo Núm. CTe']];
            @endphp
            <x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f37 = ['name' => 'ultimo_numero_mdfe', 'value' => 'Ultimo Núm. MDFe' . ':*'];
            @endphp
            <x-form.label :name="$__f37['name']" :value="$__f37['value']" />
            @php
            $__f38 = ['name' => 'ultimo_numero_mdfe', 'value' => $location->ultimo_numero_mdfe, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Ultimo Núm. MDFe']];
            @endphp
            <x-form.input type="text" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f39 = ['name' => 'inscricao_municipal', 'value' => 'Inscrição municipal' . ':*'];
            @endphp
            <x-form.label :name="$__f39['name']" :value="$__f39['value']" />
            @php
            $__f40 = ['name' => 'inscricao_municipal', 'value' => $location->inscricao_municipal, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Inscrição municipal']];
            @endphp
            <x-form.input type="text" :name="$__f40['name']" :value="$__f40['value']" :options="$__f40['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f41 = ['name' => 'numero_serie_nfe', 'value' => 'Núm. Série NFe' . ':*'];
            @endphp
            <x-form.label :name="$__f41['name']" :value="$__f41['value']" />
            @php
            $__f42 = ['name' => 'numero_serie_nfe', 'value' => $location->numero_serie_nfe, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Núm. Série NFe']];
            @endphp
            <x-form.input type="text" :name="$__f42['name']" :value="$__f42['value']" :options="$__f42['options']" />
          </div>
        </div>


        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f43 = ['name' => 'numero_serie_nfce', 'value' => 'Núm. Série NFCe' . ':*'];
            @endphp
            <x-form.label :name="$__f43['name']" :value="$__f43['value']" />
            @php
            $__f44 = ['name' => 'numero_serie_nfce', 'value' => $location->numero_serie_nfce, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Núm. Série NFCe']];
            @endphp
            <x-form.input type="text" :name="$__f44['name']" :value="$__f44['value']" :options="$__f44['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">

            @php
            $__f45 = ['name' => 'ambiente', 'value' => 'Ambiente' . ':'];
            @endphp
            <x-form.label :name="$__f45['name']" :value="$__f45['value']" />
            @php
            $__f46 = ['name' => 'ambiente', 'list' => ['1' => 'Produção', '2' => 'Homologação'], 'selected' => $location->ambiente, 'options' => ['class' => 'form-control select2', 'required']];
            @endphp
            <x-form.select :name="$__f46['name']" :list="$__f46['list']" :selected="$__f46['selected']" :options="$__f46['options']" />
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f47 = ['name' => 'csc_id', 'value' => 'CSCID' . ':*'];
            @endphp
            <x-form.label :name="$__f47['name']" :value="$__f47['value']" />
            @php
            $__f48 = ['name' => 'csc_id', 'value' => $location->csc_id, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CSCID']];
            @endphp
            <x-form.input type="text" :name="$__f48['name']" :value="$__f48['value']" :options="$__f48['options']" />
          </div>
        </div>

        <div class="col-sm-5">
          <div class="form-group">
            @php
            $__f49 = ['name' => 'csc', 'value' => 'CSC' . ':*'];
            @endphp
            <x-form.label :name="$__f49['name']" :value="$__f49['value']" />
            @php
            $__f50 = ['name' => 'csc', 'value' => $location->csc, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CSC']];
            @endphp
            <x-form.input type="text" :name="$__f50['name']" :value="$__f50['value']" :options="$__f50['options']" />
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f51 = ['name' => 'aut_xml', 'value' => 'AUT XML' . ':*'];
            @endphp
            <x-form.label :name="$__f51['name']" :value="$__f51['value']" />
            @php
            $__f52 = ['name' => 'aut_xml', 'value' => $location->aut_xml, 'options' => ['class' => 'form-control cnpj', 'placeholder' => 'AUT XML', 'data-mask="00.000.000/0000-00"', 'data-mask-reverse="true"']];
            @endphp
            <x-form.input type="text" :name="$__f52['name']" :value="$__f52['value']" :options="$__f52['options']" />
          </div>
        </div>


        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f53 = ['name' => 'mobile', 'value' => __( 'business.mobile' ) . ':'];
            @endphp
            <x-form.label :name="$__f53['name']" :value="$__f53['value']" />
            @php
            $__f54 = ['name' => 'mobile', 'value' => $location->mobile, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.mobile')]];
            @endphp
            <x-form.input type="text" :name="$__f54['name']" :value="$__f54['value']" :options="$__f54['options']" />
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f55 = ['name' => 'alternate_number', 'value' => __( 'business.alternate_number' ) . ':'];
            @endphp
            <x-form.label :name="$__f55['name']" :value="$__f55['value']" />
            @php
            $__f56 = ['name' => 'alternate_number', 'value' => $location->alternate_number, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.alternate_number')]];
            @endphp
            <x-form.input type="text" :name="$__f56['name']" :value="$__f56['value']" :options="$__f56['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f57 = ['name' => 'email', 'value' => __( 'business.email' ) . ':'];
            @endphp
            <x-form.label :name="$__f57['name']" :value="$__f57['value']" />
            @php
            $__f58 = ['name' => 'email', 'value' => $location->email, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.email')]];
            @endphp
            <x-form.input type="email" :name="$__f58['name']" :value="$__f58['value']" :options="$__f58['options']" />
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f59 = ['name' => 'website', 'value' => __( 'lang_v1.website' ) . ':'];
            @endphp
            <x-form.label :name="$__f59['name']" :value="$__f59['value']" />
            @php
            $__f60 = ['name' => 'website', 'value' => $location->website, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.website')]];
            @endphp
            <x-form.input type="text" :name="$__f60['name']" :value="$__f60['value']" :options="$__f60['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f61 = ['name' => 'invoice_scheme_id', 'value' => __('invoice.invoice_scheme') . ':*'];
            @endphp
            <x-form.label :name="$__f61['name']" :value="$__f61['value']" /> @show_tooltip(__('tooltip.invoice_scheme'))
            @php
            $__f62 = ['name' => 'invoice_scheme_id', 'list' => $invoice_schemes, 'selected' => $location->invoice_scheme_id, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('messages.please_select')]];
            @endphp
            <x-form.select :name="$__f62['name']" :list="$__f62['list']" :selected="$__f62['selected']" :options="$__f62['options']" />
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f63 = ['name' => 'invoice_layout_id', 'value' => __('invoice.invoice_layout') . ':*'];
            @endphp
            <x-form.label :name="$__f63['name']" :value="$__f63['value']" /> @show_tooltip(__('tooltip.invoice_layout'))
            @php
            $__f64 = ['name' => 'invoice_layout_id', 'list' => $invoice_layouts, 'selected' => $location->invoice_layout_id, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('messages.please_select')]];
            @endphp
            <x-form.select :name="$__f64['name']" :list="$__f64['list']" :selected="$__f64['selected']" :options="$__f64['options']" />
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f65 = ['name' => 'selling_price_group_id', 'value' => 'Grupo de preço de venda padrão' . ':'];
            @endphp
            <x-form.label :name="$__f65['name']" :value="$__f65['value']" /> @show_tooltip(__('lang_v1.location_price_group_help'))
            @php
            $__f66 = ['name' => 'selling_price_group_id', 'list' => $price_groups, 'selected' => $location->selling_price_group_id, 'options' => ['class' => 'form-control', 'placeholder' => __('messages.please_select')]];
            @endphp
            <x-form.select :name="$__f66['name']" :list="$__f66['list']" :selected="$__f66['selected']" :options="$__f66['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        @php
        $custom_labels = json_decode(session('business.custom_labels'), true);
        $location_custom_field1 = !empty($custom_labels['location']['custom_field_1']) ? $custom_labels['location']['custom_field_1'] : __('lang_v1.location_custom_field1');
        $location_custom_field2 = !empty($custom_labels['location']['custom_field_2']) ? $custom_labels['location']['custom_field_2'] : __('lang_v1.location_custom_field2');
        $location_custom_field3 = !empty($custom_labels['location']['custom_field_3']) ? $custom_labels['location']['custom_field_3'] : __('lang_v1.location_custom_field3');
        $location_custom_field4 = !empty($custom_labels['location']['custom_field_4']) ? $custom_labels['location']['custom_field_4'] : __('lang_v1.location_custom_field4');
        @endphp
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f67 = ['name' => 'custom_field1', 'value' => $location_custom_field1 . ':'];
            @endphp
            <x-form.label :name="$__f67['name']" :value="$__f67['value']" />
            @php
            $__f68 = ['name' => 'custom_field1', 'value' => $location->custom_field1, 'options' => ['class' => 'form-control', 'placeholder' => $location_custom_field1]];
            @endphp
            <x-form.input type="text" :name="$__f68['name']" :value="$__f68['value']" :options="$__f68['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f69 = ['name' => 'custom_field2', 'value' => $location_custom_field2 . ':'];
            @endphp
            <x-form.label :name="$__f69['name']" :value="$__f69['value']" />
            @php
            $__f70 = ['name' => 'custom_field2', 'value' => $location->custom_field2, 'options' => ['class' => 'form-control', 'placeholder' => $location_custom_field2]];
            @endphp
            <x-form.input type="text" :name="$__f70['name']" :value="$__f70['value']" :options="$__f70['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f71 = ['name' => 'custom_field3', 'value' => $location_custom_field3 . ':'];
            @endphp
            <x-form.label :name="$__f71['name']" :value="$__f71['value']" />
            @php
            $__f72 = ['name' => 'custom_field3', 'value' => $location->custom_field3, 'options' => ['class' => 'form-control', 'placeholder' => $location_custom_field3]];
            @endphp
            <x-form.input type="text" :name="$__f72['name']" :value="$__f72['value']" :options="$__f72['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f73 = ['name' => 'custom_field4', 'value' => $location_custom_field4 . ':'];
            @endphp
            <x-form.label :name="$__f73['name']" :value="$__f73['value']" />
            @php
            $__f74 = ['name' => 'custom_field4', 'value' => $location->custom_field4, 'options' => ['class' => 'form-control', 'placeholder' => $location_custom_field4]];
            @endphp
            <x-form.input type="text" :name="$__f74['name']" :value="$__f74['value']" :options="$__f74['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f75 = ['name' => 'featured_products', 'value' => __('lang_v1.pos_screen_featured_products') . ':'];
            @endphp
            <x-form.label :name="$__f75['name']" :value="$__f75['value']" /> @show_tooltip(__('lang_v1.featured_products_help'))
            @php
            $__f76 = ['name' => 'featured_products[]', 'list' => $featured_products, 'selected' => $location->featured_products, 'options' => ['class' => 'form-control', 'id' => 'featured_products', 'multiple']];
            @endphp
            <x-form.select :name="$__f76['name']" :list="$__f76['list']" :selected="$__f76['selected']" :options="$__f76['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-sm-12">
          <strong>Formas de pagamento: @show_tooltip('habilite as formas de pagamento')</strong>
          <div class="form-group">
            <table class="table table-condensed table-striped">
              <thead>
                <tr>
                  <th class="text-center">@lang('lang_v1.payment_method')</th>
                  <th class="text-center">Ativo</th>
                  <th class="text-center @if(empty($accounts)) hide @endif">@lang('lang_v1.default_accounts') @show_tooltip(__('lang_v1.default_account_help'))</th>
                </tr>
              </thead>
              <tbody>
                @php
                $default_payment_accounts = !empty($location->default_payment_accounts) ?
                json_decode($location->default_payment_accounts, true) : [];
                @endphp
                @foreach($payment_types as $key => $value)
                <tr>
                  <td class="text-center">{{$value}}</td>
                  <td class="text-center">@php
                  <td class="text-center">$__f77 = ['name' => 'default_payment_accounts[' . $key . '][is_enabled]', 'value' => 1, 'checked' => !empty($default_payment_accounts[$key]['is_enabled'])];
                  <td class="text-center">@endphp
                  <td class="text-center"><x-form.checkbox :name="$__f77['name']" :value="$__f77['value']" :checked="$__f77['checked']" /></td>
                  <td class="text-center @if(empty($accounts)) hide @endif">
                    @php
                    $__f78 = ['name' => 'default_payment_accounts[' . $key . '][account]', 'list' => $accounts, 'selected' => !empty($default_payment_accounts[$key]['account']) ? $default_payment_accounts[$key]['account'] : null, 'options' => ['class' => 'form-control input-sm']];
                    @endphp
                    <x-form.select :name="$__f78['name']" :list="$__f78['list']" :selected="$__f78['selected']" :options="$__f78['options']" />
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('#cidade_id').select2();

        var cpfMascara = function(val) {
          return val.replace(/\D/g, "").length > 11
          ? "00.000.000/0000-00"
          : "000.000.000-009";
        },
        cpfOptions = {
          onKeyPress: function(val, e, field, options) {
            field.mask(cpfMascara.apply({}, arguments), options);
          }
        };

        $(".cpf_cnpj").mask(cpfMascara, cpfOptions);
      });

      function buscaDados(){
        let uf = $('#uf2').val();
        let cnpj = $('#cnpj').val();

        var path = window.location.protocol + '//' + window.location.host
        $.ajax
        ({
          type: 'GET',
          data: {
            cnpj: cnpj,
            uf: uf
          },
          url: path + '/nfe/consultaCadastro',

          dataType: 'json',
          success: function(e){
            console.log(e)
            if(e.infCons.infCad){
              let info = e.infCons.infCad;
              console.log(info)

              $('#ie_rg').val(info.IE)
              $('#razao_social').val(info.xNome)
              $('#name').val(info.xFant ? info.xFant : info.xNome)

              $('#rua').val(info.ender.xLgr)
              $('#numero').val(info.ender.nro)
              $('#bairro').val(info.ender.xBairro)
              let cep = info.ender.CEP;
              $('#zip_code').val(cep.substring(0, 5) + '-' + cep.substring(5, 9))

              findCidade(info.ender.xMun, (res) => {

                if(res){

                  var $option = $("<option selected></option>").val(res.id).text(res.nome + " (" + res.uf + ")");
                  $('#cidade_id').append($option).trigger('change');

                }
              })

            }else{
              swal('Algo deu errado', e.infCons.xMotivo, 'warning')
            }
          },
          error: function(e){
            console.log("err",e.responseText)
            swal('Algo deu errado', e.responseText, 'warning')

          }
        });
      }

      function findCidade(nomeCidade, call){
        var path = window.location.protocol + '//' + window.location.host
        $.get(path + '/nfe/findCidade', {nome: nomeCidade} )
        .done((success) => {
          call(success)
        })
        .fail((err) => {
          call(err)
        })
      }
    </script>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->