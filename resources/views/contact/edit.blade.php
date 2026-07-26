<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">

    @php

    if(isset($update_action)) {
      $url = $update_action;
      $customer_groups = [];
      $opening_balance = 0;
      $lead_users = $contact->leadUsers->pluck('id');
    } else {
      $url = action('ContactController@update', [$contact->id]);
      $sources = [];
      $life_stages = [];
      $users = [];
      $lead_users = [];
    }
    @endphp

    @php
    $__f1 = ['options' => ['url' => $url, 'method' => 'PUT', 'id' => 'contact_edit_form']];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Editar</h4>
    </div>

    <div class="modal-body">

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f2 = ['name' => 'type', 'value' => __('contact.contact_type') . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user"></i>
              </span>
              @php
              $__f3 = ['name' => 'type', 'list' => $types, 'selected' => $contact->type, 'options' => ['class' => 'form-control', 'id' => 'contact_type','placeholder' => __('messages.please_select'), 'required']];
              @endphp
              <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f4 = ['name' => 'name', 'value' => 'Razão social' . ':*'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user"></i>
              </span>
              @php
              $__f5 = ['name' => 'name', 'value' => $contact->name, 'options' => ['class' => 'form-control','placeholder' => 'Razão social', 'required']];
              @endphp
              <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f6 = ['name' => 'supplier_business_name', 'value' => __('business.business_name') . ':'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-briefcase"></i>
              </span>
              @php
              $__f7 = ['name' => 'supplier_business_name', 'value' => $contact->supplier_business_name, 'options' => ['class' => 'form-control', 'placeholder' => __('business.business_name')]];
              @endphp
              <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f8 = ['name' => 'contact_id', 'value' => __('lang_v1.contact_id') . ':'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-id-badge"></i>
              </span>
              <input type="hidden" id="hidden_id" value="{{$contact->id}}">
              @php
              $__f9 = ['name' => 'contact_id', 'value' => $contact->contact_id, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.contact_id')]];
              @endphp
              <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f10 = ['name' => 'tax_number', 'value' => __('contact.tax_no') . ':'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-info"></i>
              </span>
              @php
              $__f11 = ['name' => 'tax_number', 'value' => $contact->tax_number, 'options' => ['class' => 'form-control', 'placeholder' => __('contact.tax_no')]];
              @endphp
              <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
            </div>
          </div>
        </div>

        <!-- lead additional field -->
        <div class="col-md-4 lead_additional_div">
          <div class="form-group">
            @php
            $__f12 = ['name' => 'crm_source', 'value' => __('lang_v1.source') . ':'];
            @endphp
            <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa fa-search"></i>
              </span>
              @php
              $__f13 = ['name' => 'crm_source', 'list' => $sources, 'selected' => $contact->crm_source, 'options' => ['class' => 'form-control', 'id' => 'crm_source','placeholder' => __('messages.please_select')]];
              @endphp
              <x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-4 lead_additional_div">
          <div class="form-group">
            @php
            $__f14 = ['name' => 'crm_life_stage', 'value' => __('lang_v1.life_stage') . ':'];
            @endphp
            <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa fa-life-ring"></i>
              </span>
              @php
              $__f15 = ['name' => 'crm_life_stage', 'list' => $life_stages, 'selected' => $contact->crm_life_stage, 'options' => ['class' => 'form-control', 'id' => 'crm_life_stage','placeholder' => __('messages.please_select')]];
              @endphp
              <x-form.select :name="$__f15['name']" :list="$__f15['list']" :selected="$__f15['selected']" :options="$__f15['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-6 lead_additional_div">
          <div class="form-group">
            @php
            $__f16 = ['name' => 'user_id', 'value' => __('lang_v1.assigned_to') . ':*'];
            @endphp
            <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user"></i>
              </span>
              @php
              $__f17 = ['name' => 'user_id[]', 'list' => $users, 'selected' => $lead_users, 'options' => ['class' => 'form-control select2', 'id' => 'user_id', 'multiple', 'required', 'style' => 'width: 100%;']];
              @endphp
              <x-form.select :name="$__f17['name']" :list="$__f17['list']" :selected="$__f17['selected']" :options="$__f17['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-4 opening_balance">
          <div class="form-group">
            @php
            $__f18 = ['name' => 'opening_balance', 'value' => __('lang_v1.opening_balance') . ':'];
            @endphp
            <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              @php
              $__f19 = ['name' => 'opening_balance', 'value' => $opening_balance, 'options' => ['class' => 'form-control input_number']];
              @endphp
              <x-form.input type="text" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-4 pay_term">
          <div class="form-group">
            <div class="multi-input">
              @php
              $__f20 = ['name' => 'pay_term_number', 'value' => __('contact.pay_term') . ':'];
              @endphp
              <x-form.label :name="$__f20['name']" :value="$__f20['value']" /> @show_tooltip(__('tooltip.pay_term'))
              <br/>
              @php
              $__f21 = ['name' => 'pay_term_number', 'value' => $contact->pay_term_number, 'options' => ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]];
              @endphp
              <x-form.input type="number" :name="$__f21['name']" :value="$__f21['value']" :options="$__f21['options']" />

              @php
              $__f22 = ['name' => 'pay_term_type', 'list' => ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], 'selected' => $contact->pay_term_type, 'options' => ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select')]];
              @endphp
              <x-form.select :name="$__f22['name']" :list="$__f22['list']" :selected="$__f22['selected']" :options="$__f22['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-4 customer_fields">
          <div class="form-group">
            @php
            $__f23 = ['name' => 'customer_group_id', 'value' => __('lang_v1.customer_group') . ':'];
            @endphp
            <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-users"></i>
              </span>
              @php
              $__f24 = ['name' => 'customer_group_id', 'list' => $customer_groups, 'selected' => $contact->customer_group_id, 'options' => ['class' => 'form-control']];
              @endphp
              <x-form.select :name="$__f24['name']" :list="$__f24['list']" :selected="$__f24['selected']" :options="$__f24['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            @php
            $__f25 = ['name' => 'tipo', 'value' => 'Tipo' . ':'];
            @endphp
            <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
            <div class="input-group" style="width: 100%;">

              @php
              $__f26 = ['name' => 'tipo', 'list' => ['j' => 'Juridica', 'f' => 'Fisica'], 'selected' => $type, 'options' => ['class' => 'form-control']];
              @endphp
              <x-form.select :name="$__f26['name']" :list="$__f26['list']" :selected="$__f26['selected']" :options="$__f26['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="product_custom_field2">CNPJ/CPF:</label>
            <input class="form-control" value="{{$contact->cpf_cnpj}}" placeholder="CPF/CNPJ" name="cpf_cnpj" type="text" id="cpf_cnpj">
          </div>
        </div>

        <div class="col-md-4 ">
          <div class="form-group">
            <label for="product_custom_field2">INS.ESTADUAL / RG:</label>
            <input class="form-control" value="{{$contact->ie_rg}}" placeholder="I.E/RG" name="ie_rg" id="ie_rg">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f27 = ['name' => 'city_id', 'value' => 'Cidade:*'];
            @endphp
            <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
            @php
            $__f28 = ['name' => 'city_id', 'list' => $cities, 'selected' => $contact->city_id, 'options' => ['class' => 'form-control select2', 'required']];
            @endphp
            <x-form.select :name="$__f28['name']" :list="$__f28['list']" :selected="$__f28['selected']" :options="$__f28['options']" />
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">

            @php
            $__f29 = ['name' => 'consumidor_final', 'value' => 'Consumidor final' . ':'];
            @endphp
            <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
            @php
            $__f30 = ['name' => 'consumidor_final', 'list' => ['1' => 'Sim', '0' => 'Não'], 'selected' => $contact->consumidor_final, 'options' => ['class' => 'form-control select2', 'required']];
            @endphp
            <x-form.select :name="$__f30['name']" :list="$__f30['list']" :selected="$__f30['selected']" :options="$__f30['options']" />
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">

            @php
            $__f31 = ['name' => 'contribuinte', 'value' => 'Contribuinte' . ':'];
            @endphp
            <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
            @php
            $__f32 = ['name' => 'contribuinte', 'list' => ['1' => 'Sim', '0' => 'Não'], 'selected' => $contact->contribuinte, 'options' => ['class' => 'form-control select2', 'required']];
            @endphp
            <x-form.select :name="$__f32['name']" :list="$__f32['list']" :selected="$__f32['selected']" :options="$__f32['options']" />
          </div>
        </div>

        <div class="col-md-4 customer_fields">
          <div class="form-group">
            @php
            $__f33 = ['name' => 'cod_pais', 'value' => 'Pais:'];
            @endphp
            <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
            @php
            $__f34 = ['name' => 'cod_pais', 'list' => $paises, 'selected' => $contact->cod_pais, 'options' => ['id' => 'cod_pais', 'class' => 'form-control select2', 'required']];
            @endphp
            <x-form.select :name="$__f34['name']" :list="$__f34['list']" :selected="$__f34['selected']" :options="$__f34['options']" />
          </div>
        </div>

        <div class="col-md-4 customer_fields">
          <div class="form-group">

            @php
            $__f35 = ['name' => 'id_estrangeiro', 'value' => 'ID Estrangeiro' . ':'];
            @endphp
            <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
            @php
            $__f36 = ['name' => 'id_estrangeiro', 'value' => $contact->id_estrangeiro, 'options' => ['class' => 'form-control', 'placeholder' => 'ID Estrangeiro']];
            @endphp
            <x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
          </div>
        </div>

        <div class="col-md-4 customer_fields">
          <div class="form-group">
            @php
            $__f37 = ['name' => 'credit_limit', 'value' => __('lang_v1.credit_limit') . ':'];
            @endphp
            <x-form.label :name="$__f37['name']" :value="$__f37['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              @php
              $__f38 = ['name' => 'credit_limit', 'value' => number_format($contact->credit_limit, 2, ',', '.'), 'options' => ['class' => 'form-control input_number']];
              @endphp
              <x-form.input type="text" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />
            </div>
            <p class="help-block">@lang('lang_v1.credit_limit_help')</p>
          </div>
        </div>

        <div class="col-md-12">
          <hr/>
        </div>

        <div class="col-md-4 ">
          <div class="form-group">
            <label for="product_custom_field2">Rua*:</label>
            <input class="form-control" value="{{$contact->rua}}" required placeholder="Rua" name="rua" type="text" id="rua">
          </div>
        </div>
        <div class="col-md-2 ">
          <div class="form-group">
            <label for="product_custom_field2">Nº*:</label>
            <input class="form-control" value="{{$contact->numero}}" required placeholder="Nº" name="numero" type="text" id="numero">
          </div>
        </div>

        <div class="col-md-3 ">
          <div class="form-group">
            <label for="product_custom_field2">Bairro*:</label>
            <input class="form-control" value="{{$contact->bairro}}" required placeholder="Bairro" name="bairro" type="text" id="bairro">
          </div>
        </div>

        <div class="col-md-2 ">
          <div class="form-group">
            <label for="product_custom_field2">CEP*:</label>
            <input class="form-control" value="{{$contact->cep}}" required placeholder="CEP" name="cep" type="text" id="cep">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f39 = ['name' => 'email', 'value' => __('business.email') . ':'];
            @endphp
            <x-form.label :name="$__f39['name']" :value="$__f39['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </span>
              @php
              $__f40 = ['name' => 'email', 'value' => $contact->email, 'options' => ['class' => 'form-control','placeholder' => __('business.email')]];
              @endphp
              <x-form.input type="text" :name="$__f40['name']" :value="$__f40['value']" :options="$__f40['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            @php
            $__f41 = ['name' => 'mobile', 'value' => 'Celular' . ':'];
            @endphp
            <x-form.label :name="$__f41['name']" :value="$__f41['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-mobile"></i>
              </span>
              @php
              $__f42 = ['name' => 'mobile', 'value' => $contact->mobile, 'options' => ['class' => 'form-control', 'placeholder' => 'Celular']];
              @endphp
              <x-form.input type="text" :name="$__f42['name']" :value="$__f42['value']" :options="$__f42['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            @php
            $__f43 = ['name' => 'alternate_number', 'value' => 'Telefone alternativo' . ':'];
            @endphp
            <x-form.label :name="$__f43['name']" :value="$__f43['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-phone"></i>
              </span>
              @php
              $__f44 = ['name' => 'alternate_number', 'value' => $contact->alternate_number, 'options' => ['class' => 'form-control', 'placeholder' => __('contact.alternate_contact_number')]];
              @endphp
              <x-form.input type="text" :name="$__f44['name']" :value="$__f44['value']" :options="$__f44['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            @php
            $__f45 = ['name' => 'landline', 'value' => 'Fixo:'];
            @endphp
            <x-form.label :name="$__f45['name']" :value="$__f45['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-phone"></i>
              </span>
              @php
              $__f46 = ['name' => 'landline', 'value' => $contact->landline, 'options' => ['class' => 'form-control', 'placeholder' => 'Fixo']];
              @endphp
              <x-form.input type="text" :name="$__f46['name']" :value="$__f46['value']" :options="$__f46['options']" />
            </div>
          </div>
        </div>

        <div class="col-md-3" style="display: none">
          <div class="form-group">
            @php
            $__f47 = ['name' => 'city', 'value' => __('business.city') . ':'];
            @endphp
            <x-form.label :name="$__f47['name']" :value="$__f47['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
              </span>
              @php
              $__f48 = ['name' => 'city', 'value' => $contact->city, 'options' => ['class' => 'form-control', 'placeholder' => __('business.city')]];
              @endphp
              <x-form.input type="text" :name="$__f48['name']" :value="$__f48['value']" :options="$__f48['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-3" style="display: none">
          <div class="form-group">
            @php
            $__f49 = ['name' => 'state', 'value' => __('business.state') . ':'];
            @endphp
            <x-form.label :name="$__f49['name']" :value="$__f49['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
              </span>
              @php
              $__f50 = ['name' => 'state', 'value' => $contact->state, 'options' => ['class' => 'form-control', 'placeholder' => __('business.state')]];
              @endphp
              <x-form.input type="text" :name="$__f50['name']" :value="$__f50['value']" :options="$__f50['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-3" style="display: none">
          <div class="form-group">
            @php
            $__f51 = ['name' => 'country', 'value' => __('business.country') . ':'];
            @endphp
            <x-form.label :name="$__f51['name']" :value="$__f51['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-globe"></i>
              </span>
              @php
              $__f52 = ['name' => 'country', 'value' => $contact->country, 'options' => ['class' => 'form-control', 'placeholder' => __('business.country')]];
              @endphp
              <x-form.input type="text" :name="$__f52['name']" :value="$__f52['value']" :options="$__f52['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            @php
            $__f53 = ['name' => 'landmark', 'value' => __('business.landmark') . ':'];
            @endphp
            <x-form.label :name="$__f53['name']" :value="$__f53['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-map-marker"></i>
              </span>
              @php
              $__f54 = ['name' => 'landmark', 'value' => $contact->landmark, 'options' => ['class' => 'form-control', 'placeholder' => __('business.landmark')]];
              @endphp
              <x-form.input type="text" :name="$__f54['name']" :value="$__f54['value']" :options="$__f54['options']" />
            </div>
          </div>
        </div>
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
            $__f55 = ['name' => 'custom_field1', 'value' => $contact_custom_field1 . ':'];
            @endphp
            <x-form.label :name="$__f55['name']" :value="$__f55['value']" />
            @php
            $__f56 = ['name' => 'custom_field1', 'value' => $contact->custom_field1, 'options' => ['class' => 'form-control', 'placeholder' => $contact_custom_field1]];
            @endphp
            <x-form.input type="text" :name="$__f56['name']" :value="$__f56['value']" :options="$__f56['options']" />
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            @php
            $__f57 = ['name' => 'custom_field2', 'value' => $contact_custom_field2 . ':'];
            @endphp
            <x-form.label :name="$__f57['name']" :value="$__f57['value']" />
            @php
            $__f58 = ['name' => 'custom_field2', 'value' => $contact->custom_field2, 'options' => ['class' => 'form-control', 'placeholder' => $contact_custom_field2]];
            @endphp
            <x-form.input type="text" :name="$__f58['name']" :value="$__f58['value']" :options="$__f58['options']" />
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            @php
            $__f59 = ['name' => 'custom_field3', 'value' => $contact_custom_field3 . ':'];
            @endphp
            <x-form.label :name="$__f59['name']" :value="$__f59['value']" />
            @php
            $__f60 = ['name' => 'custom_field3', 'value' => $contact->custom_field3, 'options' => ['class' => 'form-control', 'placeholder' => $contact_custom_field3]];
            @endphp
            <x-form.input type="text" :name="$__f60['name']" :value="$__f60['value']" :options="$__f60['options']" />
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            @php
            $__f61 = ['name' => 'custom_field4', 'value' => $contact_custom_field4 . ':'];
            @endphp
            <x-form.label :name="$__f61['name']" :value="$__f61['value']" />
            @php
            $__f62 = ['name' => 'custom_field4', 'value' => $contact->custom_field4, 'options' => ['class' => 'form-control', 'placeholder' => $contact_custom_field4]];
            @endphp
            <x-form.input type="text" :name="$__f62['name']" :value="$__f62['value']" :options="$__f62['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12"><hr></div>

        <div class="col-md-12">
          <h5>Endereço de entrega</h5>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label for="product_custom_field2">CEP:</label>
            <input class="form-control  featured-field" value="{{$contact->cep_entrega}}" placeholder="CEP" name="cep_entrega" data-mask="00000-000" type="text" id="cep_entrega">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="product_custom_field2">Rua:</label>
            <input class="form-control featured-field" value="{{$contact->rua_entrega}}" placeholder="Rua" name="rua_entrega" type="text" id="rua_entrega">
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label for="product_custom_field2">Nº:</label>
            <input class="form-control featured-field" value="{{$contact->numero_entrega}}" placeholder="Nº" name="numero_entrega" type="text" id="numero_entrega">
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label for="product_custom_field2">Bairro:</label>
            <input class="form-control featured-field" value="{{$contact->bairro_entrega}}" placeholder="Bairro" name="bairro_entrega" type="text" id="bairro_entrega">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f63 = ['name' => 'city_id_entrega', 'value' => 'Cidade:'];
            @endphp
            <x-form.label :name="$__f63['name']" :value="$__f63['value']" />
            @php
            $__f64 = ['name' => 'city_id_entrega', 'list' => $cities, 'selected' => $contact->city_id_entrega, 'options' => ['id' => 'cidade_entrega', 'class' => 'form-control select2 featured-field']];
            @endphp
            <x-form.select :name="$__f64['name']" :list="$__f64['list']" :selected="$__f64['selected']" :options="$__f64['options']" />
          </div>
        </div>
    <!-- <div class="col-md-8 col-md-offset-2" >
      <strong>{{__('lang_v1.shipping_address')}}</strong><br>
      @php
      $__f65 = ['name' => 'shipping_address', 'value' => $contact->shipping_address, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.search_address'), 'id' => 'shipping_address']];
      @endphp
      <x-form.input type="text" :name="$__f65['name']" :value="$__f65['value']" :options="$__f65['options']" />
      <div id="map"></div>
    </div> -->
    @php
    $__f66 = ['name' => 'position', 'value' => $contact->position, 'options' => ['id' => 'position']];
    @endphp
    <x-form.input type="hidden" :name="$__f66['name']" :value="$__f66['value']" :options="$__f66['options']" />

  </div>

</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
</div>

<x-form.close />

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
