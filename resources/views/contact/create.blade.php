<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">
    @php
    $form_id = 'contact_add_form';
    if(isset($quick_add)){
      $form_id = 'quick_add_contact';
    }

    if(isset($store_action)) {
      $url = $store_action;
      $type = 'lead';
      $customer_groups = [];
    } else {
      $url = action('ContactController@store');
      $type = '';
      $sources = [];
      $life_stages = [];
      $users = [];
    }
    @endphp
    @php
    $__f1 = ['options' => ['url' => $url, 'method' => 'post', 'id' => $form_id ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Novo {{$tipo == 'customer' ? 'Cliente' : 'Contato'}}</h4>
    </div>

    <div class="modal-body">
      <div class="row">

        <div class="col-md-2">
          <div class="form-group">
            @php
            $__f2 = ['name' => 'tipo', 'value' => 'Tipo' . ':'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            <div class="input-group" style="width: 100%;">

              @php
              $__f3 = ['name' => 'tipo', 'list' => ['j' => 'Juridica', 'f' => 'Fisica'], 'selected' => '', 'options' => ['class' => 'form-control']];
              @endphp
              <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">

            <label for="product_custom_field2">CNPJ/CPF:</label>

            <input class="form-control featured-field" required placeholder="CPF/CNPJ" data-mask="00.000.000/0000-00" name="cpf_cnpj" type="text" id="cpf_cnpj">
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

        <div class="col-md-4">
          <div class="form-group">
            <label for="product_custom_field2">INS.ESTADUAL / RG:</label>
            <input class="form-control featured-field" placeholder="I.E/RG" name="ie_rg" id="ie_rg">
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f6 = ['name' => 'name', 'value' => 'Razão social/Nome' . ':*'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user"></i>
              </span>
              @php
              $__f7 = ['name' => 'name', 'value' => null, 'options' => ['id' => 'name', 'class' => 'form-control featured-field','placeholder' => 'Razão social', 'required']];
              @endphp
              <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f8 = ['name' => 'supplier_business_name', 'value' => __('business.business_name') . ':'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-briefcase"></i>
              </span>
              @php
              $__f9 = ['name' => 'supplier_business_name', 'value' => null, 'options' => ['id' => 'nome_fantasia', 'class' => 'form-control', 'required', 'placeholder' => __('business.business_name')]];
              @endphp
              <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-3 contact_type_div">
          <div class="form-group">

            @php
            $__f10 = ['name' => 'type', 'value' => __('contact.contact_type') . ':*'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user"></i>
              </span>
              @php
              $__f11 = ['name' => 'type', 'list' => $types, 'selected' => $tipo, 'options' => ['class' => 'form-control', 'id' => 'contact_type','placeholder' => __('messages.please_select'), 'required']];
              @endphp
              <x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-2 customer_fields">
          <div class="form-group">

            @php
            $__f12 = ['name' => 'consumidor_final', 'value' => 'Consumidor final' . ':'];
            @endphp
            <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
            @php
            $__f13 = ['name' => 'consumidor_final', 'list' => ['1' => 'Sim', '0' => 'Não'], 'selected' => '', 'options' => ['id' => 'consumidor_final', 'class' => 'form-control select2 featured-field', 'required']];
            @endphp
            <x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
          </div>
        </div>

        <div class="col-md-2 customer_fields">
          <div class="form-group">

            @php
            $__f14 = ['name' => 'contribuinte', 'value' => 'Contribuinte' . ':'];
            @endphp
            <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
            @php
            $__f15 = ['name' => 'contribuinte', 'list' => ['1' => 'Sim', '0' => 'Não'], 'selected' => '', 'options' => ['id' => 'contribuinte', 'class' => 'form-control select2 featured-field', 'required']];
            @endphp
            <x-form.select :name="$__f15['name']" :list="$__f15['list']" :selected="$__f15['selected']" :options="$__f15['options']" />
          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-12">
          <hr/>
        </div>

        <div class="col-md-2 ">
          <div class="form-group">
            <label for="product_custom_field2">CEP*:</label>
            <input class="form-control  featured-field" required placeholder="CEP" name="cep" data-mask="00000-000" type="text" id="cep">
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label for="product_custom_field2">Rua*:</label>
            <input class="form-control featured-field" required placeholder="Rua" name="rua" type="text" id="rua">
          </div>
        </div>
        <div class="col-md-2 ">
          <div class="form-group">
            <label for="product_custom_field2">Nº*:</label>
            <input class="form-control featured-field" required placeholder="Nº" name="numero" type="text" id="numero">
          </div>
        </div>

        <div class="col-md-3 ">
          <div class="form-group">
            @php
            $__f16 = ['name' => 'complement', 'value' => 'Complemento:'];
            @endphp
            <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
              </span>
              @php
              $__f17 = ['name' => 'complement', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Complemento']];
              @endphp
              <x-form.input type="text" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            <label for="product_custom_field2">Bairro*:</label>
            <input class="form-control featured-field" required placeholder="Bairro" name="bairro" type="text" id="bairro">
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group">
            @php
            $__f18 = ['name' => 'city_id', 'value' => 'Cidade:*'];
            @endphp
            <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
            @php
            $__f19 = ['name' => 'city_id', 'list' => $cities, 'selected' => '', 'options' => ['id' => 'cidade', 'class' => 'form-control select2 featured-field', 'required']];
            @endphp
            <x-form.select :name="$__f19['name']" :list="$__f19['list']" :selected="$__f19['selected']" :options="$__f19['options']" />
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f20 = ['name' => 'email', 'value' => __('business.email') . ':'];
            @endphp
            <x-form.label :name="$__f20['name']" :value="$__f20['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </span>
              @php
              $__f21 = ['name' => 'email', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __('business.email')]];
              @endphp
              <x-form.input type="text" :name="$__f21['name']" :value="$__f21['value']" :options="$__f21['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f22 = ['name' => 'landmark', 'value' => __('business.landmark') . ':'];
            @endphp
            <x-form.label :name="$__f22['name']" :value="$__f22['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
              </span>
              @php
              $__f23 = ['name' => 'landmark', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('business.landmark')]];
              @endphp
              <x-form.input type="text" :name="$__f23['name']" :value="$__f23['value']" :options="$__f23['options']" />
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-3">
          <div class="form-group">
            @php
            $__f24 = ['name' => 'landline', 'value' => 'Fixo:'];
            @endphp
            <x-form.label :name="$__f24['name']" :value="$__f24['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-phone"></i>
              </span>
              @php
              $__f25 = ['name' => 'landline', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Fixo']];
              @endphp
              <x-form.input type="text" :name="$__f25['name']" :value="$__f25['value']" :options="$__f25['options']" />
            </div>
          </div>
        </div>


        <div class="col-md-3">
          <div class="form-group">
            @php
            $__f26 = ['name' => 'alternate_number', 'value' => 'Telefone alternativo' . ':'];
            @endphp
            <x-form.label :name="$__f26['name']" :value="$__f26['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-phone"></i>
              </span>
              @php
              $__f27 = ['name' => 'alternate_number', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('contact.alternate_contact_number')]];
              @endphp
              <x-form.input type="text" :name="$__f27['name']" :value="$__f27['value']" :options="$__f27['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            @php
            $__f28 = ['name' => 'mobile', 'value' => 'Celular' . ':'];
            @endphp
            <x-form.label :name="$__f28['name']" :value="$__f28['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-mobile"></i>
              </span>
              @php
              $__f29 = ['name' => 'mobile', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Celular']];
              @endphp
              <x-form.input type="text" :name="$__f29['name']" :value="$__f29['value']" :options="$__f29['options']" />
            </div>
          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-12">
          <hr/>
        </div>

        <!-- <div class="col-md-8" >
          <strong>{{__('lang_v1.shipping_address')}}</strong><br>
          @php
          $__f30 = ['name' => 'shipping_address', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Endeço de entrega', 'id' => 'shipping_address']];
          @endphp
          <x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
          <div id="map"></div>
        </div> -->
        <div class="col-md-12">
          <h5>Endereço de entrega</h5>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label for="product_custom_field2">CEP:</label>
            <input class="form-control  featured-field" placeholder="CEP" name="cep_entrega" data-mask="00000-000" type="text" id="cep_entrega">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="product_custom_field2">Rua:</label>
            <input class="form-control featured-field" placeholder="Rua" name="rua_entrega" type="text" id="rua_entrega">
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label for="product_custom_field2">Nº:</label>
            <input class="form-control featured-field" placeholder="Nº" name="numero_entrega" type="text" id="numero_entrega">
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label for="product_custom_field2">Bairro:</label>
            <input class="form-control featured-field" placeholder="Bairro" name="bairro_entrega" type="text" id="bairro_entrega">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f31 = ['name' => 'city_id_entrega', 'value' => 'Cidade:'];
            @endphp
            <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
            @php
            $__f32 = ['name' => 'city_id_entrega', 'list' => $cities, 'selected' => '', 'options' => ['id' => 'cidade_entrega', 'class' => 'form-control select2 featured-field']];
            @endphp
            <x-form.select :name="$__f32['name']" :list="$__f32['list']" :selected="$__f32['selected']" :options="$__f32['options']" />
          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-12">
          <hr/>
        </div>

        <div class="col-md-4 customer_fields">
          <div class="form-group">
            @php
            $__f33 = ['name' => 'credit_limit', 'value' => __('lang_v1.credit_limit') . ':'];
            @endphp
            <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              @php
              $__f34 = ['name' => 'credit_limit', 'value' => null, 'options' => ['class' => 'form-control input_number']];
              @endphp
              <x-form.input type="text" :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />
            </div>
            <p class="help-block">@lang('lang_v1.credit_limit_help')</p>
          </div>
        </div>

        <div class="col-md-4 opening_balance">
          <div class="form-group">
            @php
            $__f35 = ['name' => 'opening_balance', 'value' => __('lang_v1.opening_balance') . ':'];
            @endphp
            <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              @php
              $__f36 = ['name' => 'opening_balance', 'value' => 0, 'options' => ['class' => 'form-control input_number']];
              @endphp
              <x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-4 pay_term">
          <div class="form-group">
            <div class="multi-input">
              @php
              $__f37 = ['name' => 'pay_term_number', 'value' => __('contact.pay_term') . ':'];
              @endphp
              <x-form.label :name="$__f37['name']" :value="$__f37['value']" /> @show_tooltip(__('tooltip.pay_term'))
              <br/>
              @php
              $__f38 = ['name' => 'pay_term_number', 'value' => null, 'options' => ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]];
              @endphp
              <x-form.input type="number" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />

              @php
              $__f39 = ['name' => 'pay_term_type', 'list' => ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], 'selected' => '', 'options' => ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select')]];
              @endphp
              <x-form.select :name="$__f39['name']" :list="$__f39['list']" :selected="$__f39['selected']" :options="$__f39['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-4 lead_additional_div">
          <div class="form-group">
            @php
            $__f40 = ['name' => 'crm_life_stage', 'value' => __('lang_v1.life_stage') . ':'];
            @endphp
            <x-form.label :name="$__f40['name']" :value="$__f40['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa fa-life-ring"></i>
              </span>
              @php
              $__f41 = ['name' => 'crm_life_stage', 'list' => $life_stages, 'selected' => null, 'options' => ['class' => 'form-control', 'id' => 'crm_life_stage','placeholder' => __('messages.please_select')]];
              @endphp
              <x-form.select :name="$__f41['name']" :list="$__f41['list']" :selected="$__f41['selected']" :options="$__f41['options']" />
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f42 = ['name' => 'tax_number', 'value' => __('contact.tax_no') . ':'];
            @endphp
            <x-form.label :name="$__f42['name']" :value="$__f42['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-info"></i>
              </span>
              @php
              $__f43 = ['name' => 'tax_number', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('contact.tax_no')]];
              @endphp
              <x-form.input type="text" :name="$__f43['name']" :value="$__f43['value']" :options="$__f43['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f44 = ['name' => 'contact_id', 'value' => __('lang_v1.contact_id') . ':'];
            @endphp
            <x-form.label :name="$__f44['name']" :value="$__f44['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-id-badge"></i>
              </span>
              @php
              $__f45 = ['name' => 'contact_id', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.contact_id')]];
              @endphp
              <x-form.input type="text" :name="$__f45['name']" :value="$__f45['value']" :options="$__f45['options']" />
            </div>
          </div>
        </div>


        <!-- lead additional field -->
        <div class="col-md-4 lead_additional_div">
          <div class="form-group">
            @php
            $__f46 = ['name' => 'crm_source', 'value' => __('lang_v1.source') . ':'];
            @endphp
            <x-form.label :name="$__f46['name']" :value="$__f46['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa fa-search"></i>
              </span>
              @php
              $__f47 = ['name' => 'crm_source', 'list' => $sources, 'selected' => null, 'options' => ['class' => 'form-control', 'id' => 'crm_source','placeholder' => __('messages.please_select')]];
              @endphp
              <x-form.select :name="$__f47['name']" :list="$__f47['list']" :selected="$__f47['selected']" :options="$__f47['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-6 lead_additional_div">
          <div class="form-group">
            @php
            $__f48 = ['name' => 'user_id', 'value' => __('lang_v1.assigned_to') . ':*'];
            @endphp
            <x-form.label :name="$__f48['name']" :value="$__f48['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user"></i>
              </span>
              @php
              $__f49 = ['name' => 'user_id[]', 'list' => $users, 'selected' => null, 'options' => ['class' => 'form-control select2', 'id' => 'user_id', 'multiple', 'required', 'style' => 'width: 100%;']];
              @endphp
              <x-form.select :name="$__f49['name']" :list="$__f49['list']" :selected="$__f49['selected']" :options="$__f49['options']" />
            </div>
          </div>
        </div>

        <div class="clearfix"></

          <div class="clearfix"></div>


          <div class="col-md-12">
            <hr/>
          </div>


          @php
          $custom_labels = json_decode(session('business.custom_labels'), true);
          $contact_custom_field1 = !empty($custom_labels['contact']['custom_field_1']) ? $custom_labels['contact']['custom_field_1'] : __('lang_v1.contact_custom_field1');
          $contact_custom_field2 = !empty($custom_labels['contact']['custom_field_2']) ? $custom_labels['contact']['custom_field_2'] : __('lang_v1.contact_custom_field2');
          $contact_custom_field3 = !empty($custom_labels['contact']['custom_field_3']) ? $custom_labels['contact']['custom_field_3'] : __('lang_v1.contact_custom_field3');
          $contact_custom_field4 = !empty($custom_labels['contact']['custom_field_4']) ? $custom_labels['contact']['custom_field_4'] : __('lang_v1.contact_custom_field4');
          @endphp
          <div class="col-md-3">
            <div class="form-group">
              @php
              $__f50 = ['name' => 'custom_field1', 'value' => $contact_custom_field1 . ':'];
              @endphp
              <x-form.label :name="$__f50['name']" :value="$__f50['value']" />
              @php
              $__f51 = ['name' => 'custom_field1', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.contact_custom_field1')]];
              @endphp
              <x-form.input type="text" :name="$__f51['name']" :value="$__f51['value']" :options="$__f51['options']" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              @php
              $__f52 = ['name' => 'custom_field2', 'value' => $contact_custom_field2 . ':'];
              @endphp
              <x-form.label :name="$__f52['name']" :value="$__f52['value']" />
              @php
              $__f53 = ['name' => 'custom_field2', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => $contact_custom_field2]];
              @endphp
              <x-form.input type="text" :name="$__f53['name']" :value="$__f53['value']" :options="$__f53['options']" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              @php
              $__f54 = ['name' => 'custom_field3', 'value' => $contact_custom_field3 . ':'];
              @endphp
              <x-form.label :name="$__f54['name']" :value="$__f54['value']" />
              @php
              $__f55 = ['name' => 'custom_field3', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => $contact_custom_field3]];
              @endphp
              <x-form.input type="text" :name="$__f55['name']" :value="$__f55['value']" :options="$__f55['options']" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              @php
              $__f56 = ['name' => 'custom_field4', 'value' => $contact_custom_field4 . ':'];
              @endphp
              <x-form.label :name="$__f56['name']" :value="$__f56['value']" />
              @php
              $__f57 = ['name' => 'custom_field4', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => $contact_custom_field4]];
              @endphp
              <x-form.input type="text" :name="$__f57['name']" :value="$__f57['value']" :options="$__f57['options']" />
            </div>
          </div>
          @php
          $__f58 = ['name' => 'position', 'value' => null, 'options' => ['id' => 'position']];
          @endphp
          <x-form.input type="hidden" :name="$__f58['name']" :value="$__f58['value']" :options="$__f58['options']" />

        </div>
      </div>



      <div class="col-md-3" style="display: none">
        <div class="form-group">
          @php
          $__f59 = ['name' => 'city', 'value' => __('business.city') . ':'];
          @endphp
          <x-form.label :name="$__f59['name']" :value="$__f59['value']" />
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-map-marker"></i>
            </span>
            @php
            $__f60 = ['name' => 'city', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('business.city')]];
            @endphp
            <x-form.input type="text" :name="$__f60['name']" :value="$__f60['value']" :options="$__f60['options']" />
          </div>
        </div>
      </div>
      <div class="col-md-3" style="display: none">
        <div class="form-group">
          @php
          $__f61 = ['name' => 'state', 'value' => __('business.state') . ':'];
          @endphp
          <x-form.label :name="$__f61['name']" :value="$__f61['value']" />
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-map-marker"></i>
            </span>
            @php
            $__f62 = ['name' => 'state', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('business.state')]];
            @endphp
            <x-form.input type="text" :name="$__f62['name']" :value="$__f62['value']" :options="$__f62['options']" />
          </div>
        </div>
      </div>

      <div class="col-md-3" style="display: none">
        <div class="form-group">
          @php
          $__f63 = ['name' => 'country', 'value' => __('business.country') . ':'];
          @endphp
          <x-form.label :name="$__f63['name']" :value="$__f63['value']" />
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-globe"></i>
            </span>
            @php
            $__f64 = ['name' => 'country', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('business.country')]];
            @endphp
            <x-form.input type="text" :name="$__f64['name']" :value="$__f64['value']" :options="$__f64['options']" />
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
      </div>

      <x-form.close />



    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->


  <script type="text/javascript">
    $('#cpf_cnpj').mask('00.000.000/0000-00')
    $('#cep').mask('00000-000')
    $('#tipo').change((val) => {
      let t = $('#tipo').val()

      if(t == 'j'){
        $('#cpf_cnpj').mask('00.000.000/0000-00')
      }else{
        $('#cpf_cnpj').mask('000.000.000-00')
        $('#nome_fantasia').removeAttr('required')

      }
    })

    function buscaDados(){
      let uf = $('#uf2').val();
      let cnpj = $('#cpf_cnpj').val();

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
          // console.log(e)
          if(e.infCons.infCad){
            let info = e.infCons.infCad;
            // console.log(info)

            $('#ie_rg').val(info.IE)
            $('#name').val(info.xNome)
            $('#nome_fantasia').val(info.xFant ? info.xFant : info.xNome)

            $('#rua').val(info.ender.xLgr)
            $('#rua_entrega').val(info.ender.xLgr)
            $('#numero').val(info.ender.nro)
            $('#numero_entrega').val(info.ender.nro)
            $('#bairro').val(info.ender.xBairro)
            $('#bairro_entrega').val(info.ender.xBairro)
            let cep = info.ender.CEP;
            $('#cep').val(cep.substring(0, 5) + '-' + cep.substring(5, 9))
            $('#cep_entrega').val(cep.substring(0, 5) + '-' + cep.substring(5, 9))

            findCidade(info.ender.xMun, (res) => {

              if(res){
                // console.log(res)
                // var $option = $("<option selected></option>").val(res.id).text(res.nome + " (" + res.uf + ")");
                // $('#cidade').append($option).trigger('change');
                $('#cidade').val(res.id).change();
                $('#cidade_entrega').val(res.id).change();
                // $('#cidade_entrega').append($option).trigger('change');

              }
            })

          }else{
            swal('Algo deu errado', e.infCons.xMotivo, 'warning')
          }
        },
        error: function(e){
          console.log("err", e.responseText)
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

  /**
    Busca os dados do CNPJ na API
    */
    // function getDataFromCNPJ(cnpj) {
    //   if (cnpj.length < 18 ) {
    //     return false;
    //   }
    //   cnpj = cnpj.replaceAll('-', '');
    //   cnpj = cnpj.replaceAll('.', '');
    //   cnpj = cnpj.replaceAll('/', '');
    //   $.get('http://gestor.sefacilsistemas.com.br/consult/cnpj', { cnpj: cnpj })
    //   .done((response) => {
    //     $('#name').val(response.nome);
    //     $('#nome_fantasia').val(response.fantasia);
    //   });
    // }

    // $('#cpf_cnpj').keyup((event) => {
    //   getDataFromCNPJ(event.target.value);
    // }); 

  /**
    Busca os dados do CEP na API
    */
    function getDataFromCep(cep) {
      if (cep.length < 9 ) {
        return false;
      }else{
        cep = cep.replace("-", "")
        $.get('https://ws.apicep.com/cep.json', { code: cep })
        .done((response) => {
          $('#bairro').val(response.district);
          $('#bairro_entrega').val(response.district);
          $('#rua').val(response.address);
          $('#rua_entrega').val(response.address);
          $('#uf2').val(response.state);
          $('#uf2').select2();
          findCidade(response.city, (res) => {
            console.log(res)
            if(res){
              // var $option = $("<option selected></option>").val(res.id).change()
              // var $option = $("<option selected></option>").val(res.id).text(res.nome + " (" + res.uf + ")");
              // $('#cidade').append($option).trigger('change');
              $('#cidade').val(res.id).change()
              $('#cidade_entrega').val(res.id).change()
            }
          });
        })
      }
    }

    $('#cep').keyup((event) => {
      getDataFromCep(event.target.value);
    });

  </script>



