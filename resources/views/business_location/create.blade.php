<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('BusinessLocationController@store'), 'method' => 'post', 'id' => 'business_location_add_form', 'files' => true ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'business.add_business_location' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f2 = ['name' => 'cnpj', 'value' => 'CNPJ' . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            @php
            $__f3 = ['name' => 'cnpj', 'value' => '', 'options' => ['class' => 'form-control cpf_cnpj', 'required', 'placeholder' => 'CNPJ']];
            @endphp
            <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            @php
            $__f4 = ['name' => 'tipo', 'value' => 'UF' . ':'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            <div class="input-group" style="width: 100%;">
              <span class="input-group-addon">
                <a onclick="buscaDados()"><i class="fa fa-search"></i></a>
              </span>
              @php
              $__f5 = ['name' => 'uf', 'list' => $estados, 'selected' => '', 'options' => ['id' => 'uf2', 'class' => 'form-control select2 featured-field']];
              @endphp
              <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
            </div>
          </div>
        </div>
        <div class="col-sm-7">
          <div class="form-group">
            @php
            $__f6 = ['name' => 'name', 'value' => 'Nome Fantasia' . ':*'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            @php
            $__f7 = ['name' => 'name', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Nome' ]];
            @endphp
            <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f8 = ['name' => 'razao_social', 'value' => __('business.business_razao') . ':*'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            @php
            $__f9 = ['name' => 'razao_social', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('business.business_razao')]];
            @endphp
            <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
            @if($errors->has('razao_social'))
            <span class="text-danger">{{ $errors->first('razao_social') }}</span>
            @endif

          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-sm-2">
          <div class="form-group">
            @php
            $__f10 = ['name' => 'location_id', 'value' => __( 'lang_v1.location_id' ) . ':'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
            @php
            $__f11 = ['name' => 'location_id', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.location_id' ) ]];
            @endphp
            <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f12 = ['name' => 'landmark', 'value' => __( 'business.landmark' ) . ':'];
            @endphp
            <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
            @php
            $__f13 = ['name' => 'landmark', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.landmark' ) ]];
            @endphp
            <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f14 = ['name' => 'zip_code', 'value' => __( 'business.zip_code' ) . ':*'];
            @endphp
            <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
            @php
            $__f15 = ['name' => 'zip_code', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.zip_code'), 'required', 'data-mask="00000-000"' ]];
            @endphp
            <x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f16 = ['name' => 'cidade_id', 'value' => 'Cidade:*'];
            @endphp
            <x-form.label :name="$__f16['name']" :value="$__f16['value']" /><br>
            @php
            $__f17 = ['name' => 'cidade_id', 'list' => $cities, 'selected' => '4000', 'options' => ['class' => 'form-control select2', 'required', 'style' => 'width: 100%']];
            @endphp
            <x-form.select :name="$__f17['name']" :list="$__f17['list']" :selected="$__f17['selected']" :options="$__f17['options']" />
          </div>
        </div>


        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f18 = ['name' => 'ie', 'value' => 'IE' . ':*'];
            @endphp
            <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
            @php
            $__f19 = ['name' => 'ie', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'IE']];
            @endphp
            <x-form.input type="text" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
          </div>
        </div>


        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f20 = ['name' => 'rua', 'value' => 'Rua' . ':*'];
            @endphp
            <x-form.label :name="$__f20['name']" :value="$__f20['value']" />
            @php
            $__f21 = ['name' => 'rua', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Rua']];
            @endphp
            <x-form.input type="text" :name="$__f21['name']" :value="$__f21['value']" :options="$__f21['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f22 = ['name' => 'numero', 'value' => 'Número' . ':*'];
            @endphp
            <x-form.label :name="$__f22['name']" :value="$__f22['value']" />
            @php
            $__f23 = ['name' => 'numero', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Número']];
            @endphp
            <x-form.input type="text" :name="$__f23['name']" :value="$__f23['value']" :options="$__f23['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f24 = ['name' => 'bairro', 'value' => 'Bairro' . ':*'];
            @endphp
            <x-form.label :name="$__f24['name']" :value="$__f24['value']" />
            @php
            $__f25 = ['name' => 'bairro', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Bairro']];
            @endphp
            <x-form.input type="text" :name="$__f25['name']" :value="$__f25['value']" :options="$__f25['options']" />
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f26 = ['name' => 'telefone', 'value' => 'Telefone' . ':*'];
            @endphp
            <x-form.label :name="$__f26['name']" :value="$__f26['value']" />
            @php
            $__f27 = ['name' => 'telefone', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'data-mask="00 000000000"', 'placeholder' => 'Telefone']];
            @endphp
            <x-form.input type="text" :name="$__f27['name']" :value="$__f27['value']" :options="$__f27['options']" />
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">

            @php
            $__f28 = ['name' => 'regime', 'value' => 'Regime' . ':'];
            @endphp
            <x-form.label :name="$__f28['name']" :value="$__f28['value']" />
            @php
            $__f29 = ['name' => 'regime', 'list' => ['1' => 'Simples', '3' => 'Normal'], 'selected' => '', 'options' => ['class' => 'form-control select2', 'required']];
            @endphp
            <x-form.select :name="$__f29['name']" :list="$__f29['list']" :selected="$__f29['selected']" :options="$__f29['options']" />
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f30 = ['name' => 'ultimo_numero_nfe', 'value' => 'Ultimo Núm. NFe' . ':*'];
            @endphp
            <x-form.label :name="$__f30['name']" :value="$__f30['value']" />
            @php
            $__f31 = ['name' => 'ultimo_numero_nfe', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Ultimo Núm. NFe']];
            @endphp
            <x-form.input type="text" :name="$__f31['name']" :value="$__f31['value']" :options="$__f31['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f32 = ['name' => 'ultimo_numero_nfce', 'value' => 'Ultimo Núm. NFCe' . ':*'];
            @endphp
            <x-form.label :name="$__f32['name']" :value="$__f32['value']" />
            @php
            $__f33 = ['name' => 'ultimo_numero_nfce', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Ultimo Núm. NFCe']];
            @endphp
            <x-form.input type="text" :name="$__f33['name']" :value="$__f33['value']" :options="$__f33['options']" />
          </div>
        </div>

       
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f34 = ['name' => 'inscricao_municipal', 'value' => 'Inscrição municipal' . ':*'];
            @endphp
            <x-form.label :name="$__f34['name']" :value="$__f34['value']" />
            @php
            $__f35 = ['name' => 'inscricao_municipal', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Inscrição municipal']];
            @endphp
            <x-form.input type="text" :name="$__f35['name']" :value="$__f35['value']" :options="$__f35['options']" />
          </div>
        </div>

        <!-- <div class="clearfix"></div> -->

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f36 = ['name' => 'numero_serie_nfe', 'value' => 'Núm. Série NFe' . ':*'];
            @endphp
            <x-form.label :name="$__f36['name']" :value="$__f36['value']" />
            @php
            $__f37 = ['name' => 'numero_serie_nfe', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Núm. Série NF-e']];
            @endphp
            <x-form.input type="text" :name="$__f37['name']" :value="$__f37['value']" :options="$__f37['options']" />
          </div>
        </div>


        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f38 = ['name' => 'numero_serie_nfce', 'value' => 'Núm. Série NFCe' . ':*'];
            @endphp
            <x-form.label :name="$__f38['name']" :value="$__f38['value']" />
            @php
            $__f39 = ['name' => 'numero_serie_nfce', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Núm. Série NFCe']];
            @endphp
            <x-form.input type="text" :name="$__f39['name']" :value="$__f39['value']" :options="$__f39['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">

            @php
            $__f40 = ['name' => 'ambiente', 'value' => 'Ambiente' . ':'];
            @endphp
            <x-form.label :name="$__f40['name']" :value="$__f40['value']" />
            @php
            $__f41 = ['name' => 'ambiente', 'list' => ['2' => 'Homologação', '1' => 'Produção'], 'selected' => '', 'options' => ['class' => 'form-control select2', 'required']];
            @endphp
            <x-form.select :name="$__f41['name']" :list="$__f41['list']" :selected="$__f41['selected']" :options="$__f41['options']" />
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f42 = ['name' => 'csc_id', 'value' => 'CSCID' . ':*'];
            @endphp
            <x-form.label :name="$__f42['name']" :value="$__f42['value']" />
            @php
            $__f43 = ['name' => 'csc_id', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CSCID']];
            @endphp
            <x-form.input type="text" :name="$__f43['name']" :value="$__f43['value']" :options="$__f43['options']" />
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f44 = ['name' => 'csc', 'value' => 'CSC' . ':*'];
            @endphp
            <x-form.label :name="$__f44['name']" :value="$__f44['value']" />
            @php
            $__f45 = ['name' => 'csc', 'value' => '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CSC']];
            @endphp
            <x-form.input type="text" :name="$__f45['name']" :value="$__f45['value']" :options="$__f45['options']" />
          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f46 = ['name' => 'mobile', 'value' => 'Celular' . ':'];
            @endphp
            <x-form.label :name="$__f46['name']" :value="$__f46['value']" />
            @php
            $__f47 = ['name' => 'mobile', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Celular']];
            @endphp
            <x-form.input type="text" :name="$__f47['name']" :value="$__f47['value']" :options="$__f47['options']" />
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f48 = ['name' => 'alternate_number', 'value' => __( 'business.alternate_number' ) . ':'];
            @endphp
            <x-form.label :name="$__f48['name']" :value="$__f48['value']" />
            @php
            $__f49 = ['name' => 'alternate_number', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.alternate_number')]];
            @endphp
            <x-form.input type="text" :name="$__f49['name']" :value="$__f49['value']" :options="$__f49['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f50 = ['name' => 'email', 'value' => __( 'business.email' ) . ':'];
            @endphp
            <x-form.label :name="$__f50['name']" :value="$__f50['value']" />
            @php
            $__f51 = ['name' => 'email', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.email')]];
            @endphp
            <x-form.input type="email" :name="$__f51['name']" :value="$__f51['value']" :options="$__f51['options']" />
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f52 = ['name' => 'website', 'value' => __( 'lang_v1.website' ) . ':'];
            @endphp
            <x-form.label :name="$__f52['name']" :value="$__f52['value']" />
            @php
            $__f53 = ['name' => 'website', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.website')]];
            @endphp
            <x-form.input type="text" :name="$__f53['name']" :value="$__f53['value']" :options="$__f53['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f54 = ['name' => 'invoice_scheme_id', 'value' => __('invoice.invoice_scheme') . ':*'];
            @endphp
            <x-form.label :name="$__f54['name']" :value="$__f54['value']" /> @show_tooltip(__('tooltip.invoice_scheme'))
            @php
            $__f55 = ['name' => 'invoice_scheme_id', 'list' => $invoice_schemes, 'selected' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('messages.please_select')]];
            @endphp
            <x-form.select :name="$__f55['name']" :list="$__f55['list']" :selected="$__f55['selected']" :options="$__f55['options']" />
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f56 = ['name' => 'invoice_layout_id', 'value' => __('invoice.invoice_layout') . ':*'];
            @endphp
            <x-form.label :name="$__f56['name']" :value="$__f56['value']" /> @show_tooltip(__('tooltip.invoice_layout'))
            @php
            $__f57 = ['name' => 'invoice_layout_id', 'list' => $invoice_layouts, 'selected' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('messages.please_select')]];
            @endphp
            <x-form.select :name="$__f57['name']" :list="$__f57['list']" :selected="$__f57['selected']" :options="$__f57['options']" />
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f58 = ['name' => 'selling_price_group_id', 'value' => 'Grupo de preço de venda padrão' . ':'];
            @endphp
            <x-form.label :name="$__f58['name']" :value="$__f58['value']" /> 
            @php
            $__f59 = ['name' => 'selling_price_group_id', 'list' => $price_groups, 'selected' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('messages.please_select')]];
            @endphp
            <x-form.select :name="$__f59['name']" :list="$__f59['list']" :selected="$__f59['selected']" :options="$__f59['options']" />
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
            $__f60 = ['name' => 'custom_field1', 'value' => $location_custom_field1 . ':'];
            @endphp
            <x-form.label :name="$__f60['name']" :value="$__f60['value']" />
            @php
            $__f61 = ['name' => 'custom_field1', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => $location_custom_field1]];
            @endphp
            <x-form.input type="text" :name="$__f61['name']" :value="$__f61['value']" :options="$__f61['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f62 = ['name' => 'custom_field2', 'value' => $location_custom_field2 . ':'];
            @endphp
            <x-form.label :name="$__f62['name']" :value="$__f62['value']" />
            @php
            $__f63 = ['name' => 'custom_field2', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => $location_custom_field2]];
            @endphp
            <x-form.input type="text" :name="$__f63['name']" :value="$__f63['value']" :options="$__f63['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f64 = ['name' => 'custom_field3', 'value' => $location_custom_field3 . ':'];
            @endphp
            <x-form.label :name="$__f64['name']" :value="$__f64['value']" />
            @php
            $__f65 = ['name' => 'custom_field3', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => $location_custom_field3]];
            @endphp
            <x-form.input type="text" :name="$__f65['name']" :value="$__f65['value']" :options="$__f65['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f66 = ['name' => 'custom_field4', 'value' => $location_custom_field4 . ':'];
            @endphp
            <x-form.label :name="$__f66['name']" :value="$__f66['value']" />
            @php
            $__f67 = ['name' => 'custom_field4', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => $location_custom_field4]];
            @endphp
            <x-form.input type="text" :name="$__f67['name']" :value="$__f67['value']" :options="$__f67['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f68 = ['name' => 'featured_products', 'value' => __('lang_v1.pos_screen_featured_products') . ':'];
            @endphp
            <x-form.label :name="$__f68['name']" :value="$__f68['value']" /> @show_tooltip(__('lang_v1.featured_products_help'))
            @php
            $__f69 = ['name' => 'featured_products[]', 'list' => [], 'selected' => null, 'options' => ['class' => 'form-control', 'id' => 'featured_products', 'multiple']];
            @endphp
            <x-form.select :name="$__f69['name']" :list="$__f69['list']" :selected="$__f69['selected']" :options="$__f69['options']" />
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
                @foreach($payment_types as $key => $value)
                <tr>
                  <td class="text-center">{{$value}}</td>
                  <td class="text-center">@php
                  <td class="text-center">$__f70 = ['name' => 'default_payment_accounts[' . $key . '][is_enabled]', 'value' => 1, 'checked' => true];
                  <td class="text-center">@endphp
                  <td class="text-center"><x-form.checkbox :name="$__f70['name']" :value="$__f70['value']" :checked="$__f70['checked']" /></td>
                  <td class="text-center @if(empty($accounts)) hide @endif">
                    @php
                    $__f71 = ['name' => 'default_payment_accounts[' . $key . '][account]', 'list' => $accounts, 'selected' => null, 'options' => ['class' => 'form-control input-sm']];
                    @endphp
                    <x-form.select :name="$__f71['name']" :list="$__f71['list']" :selected="$__f71['selected']" :options="$__f71['options']" />
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