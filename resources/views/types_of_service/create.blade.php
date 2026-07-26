<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('TypesOfServiceController@store'), 'method' => 'post', 'id' => 'types_of_service_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'lang_v1.add_type_of_service' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
      <div class="form-group col-md-12">
        @php
        $__f2 = ['name' => 'name', 'value' => 'Nome' . ':*'];
        @endphp
        <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'name', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Nome']];
          @endphp
          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
      </div>

      <div class="form-group col-md-12">
        @php
        $__f4 = ['name' => 'description', 'value' => __( 'lang_v1.description' ) . ':'];
        @endphp
        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'description', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.description' ), 'rows' => 3]];
          @endphp
          <x-form.textarea :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
      </div>

      <div class="form-group col-md-12">
      <table class="table table-slim">
        <thead>
          <tr>
            <th>@lang('sale.location')</th>
            <th>@lang('lang_v1.price_group')</th> 
          </tr>
          @foreach($locations as $key => $value)
            <tr>
              <td>{{$value}}</td>
              <td>@php
              <td>$__f6 = ['name' => 'location_price_group[' . $key . ']', 'list' => $price_groups, 'selected' => null, 'options' => ['class' => 'form-control input-sm select2', 'style' => 'width: 100%;']];
              <td>@endphp
              <td><x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" /></td>
            </tr>
          @endforeach
        </thead>
      </table>
      </div>
       <div class="form-group col-md-6">
        @php
        $__f7 = ['name' => 'packing_charge_type', 'value' => 'Tipo de embalagem' . ':'];
        @endphp
        <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
          @php
          $__f8 = ['name' => 'packing_charge_type', 'list' => ['fixed' => __('lang_v1.fixed'), 'percent' => __('lang_v1.percentage')], 'selected' => 'fixed', 'options' => ['class' => 'form-control']];
          @endphp
          <x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
      </div>
      <div class="form-group col-md-6">
        @php
        $__f9 = ['name' => 'packing_charge', 'value' => 'Taxa de embalagem' . ':'];
        @endphp
        <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
          @php
          $__f10 = ['name' => 'packing_charge', 'value' => null, 'options' => ['class' => 'form-control input_number', 'placeholder' => 'Taxa de embalagem']];
          @endphp
          <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
      </div>
      <div class="form-group col-md-12">
          <div class="checkbox">
            <label>
               @php
               $__f11 = ['name' => 'enable_custom_fields', 'value' => 1, 'checked' => false];
               @endphp
               <x-form.checkbox :name="$__f11['name']" :value="$__f11['value']" :checked="$__f11['checked']" /> Habilitar campos personalizados
            </label> @show_tooltip('Quatro campos personalizados estarão disponíveis ao adicionar venda')
          </div>
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