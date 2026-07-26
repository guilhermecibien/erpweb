<div class="box box-solid">
    <div class="box-header">
      <h3 class="box-title">@lang('lang_v1.types_of_service_module_settings')</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f1 = ['name' => 'types_of_service_label', 'value' => __('lang_v1.types_of_service_label') . ':'];
            @endphp
            <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
            @php
            $__f2 = ['name' => 'module_info[types_of_service][types_of_service_label]', 'value' => !empty($module_info['types_of_service']['types_of_service_label']) ? $module_info['types_of_service']['types_of_service_label'] : null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.types_of_service_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <br>
            <div class="checkbox">
              <label>
                @php
                $__f3 = ['name' => 'module_info[types_of_service][show_types_of_service]', 'value' => 1, 'checked' => !empty($module_info['types_of_service']['show_types_of_service']), 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f3['name']" :value="$__f3['value']" :checked="$__f3['checked']" :options="$__f3['options']" /> @lang('lang_v1.show_types_of_service')</label>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <br>
            <div class="checkbox">
              <label>
                @php
                $__f4 = ['name' => 'module_info[types_of_service][show_tos_custom_fields]', 'value' => 1, 'checked' => !empty($module_info['types_of_service']['show_tos_custom_fields']), 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f4['name']" :value="$__f4['value']" :checked="$__f4['checked']" :options="$__f4['options']" /> @lang('lang_v1.show_tos_custom_fields')</label>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>