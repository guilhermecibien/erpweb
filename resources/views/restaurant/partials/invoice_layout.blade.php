@php
	$default = [];
	$default['show_table'] = 1;
	$default['table_label'] = 'Table';

	$default['show_service_staff'] = 1;
	$default['service_staff_label'] = 'Service staff';
	
	if(!empty($edit_il)){
		$default['show_table'] = isset($module_info['tables']['show_table']) ? $module_info['tables']['show_table'] : 0;
		$default['table_label'] = isset($module_info['tables']['table_label']) ? $module_info['tables']['table_label'] : '';

		$default['show_service_staff'] = isset($module_info['service_staff']['show_service_staff']) ? $module_info['service_staff']['show_service_staff'] : 0;
		
		$default['service_staff_label'] = isset($module_info['service_staff']['service_staff_label']) ? $module_info['service_staff']['service_staff_label'] : '';
	}
	
@endphp
@if(!empty($enabled_modules))
<div class="box box-solid">
    <div class="box-body">
    	<div class="box-header">
            <h3 class="box-title">@lang('lang_v1.restaurant_module_settings')</h3>
        </div>
		<div class="row">
		@if(in_array('tables', $enabled_modules) )
			<div class="col-sm-3">
				<div class="form-group">
					<div class="checkbox">
						<label>
							@php
							$__f1 = ['name' => 'module_info[tables][show_table]', 'value' => 1, 'checked' => $default['show_table'], 'options' => ['class' => 'input-icheck']];
							@endphp
							<x-form.checkbox :name="$__f1['name']" :value="$__f1['value']" :checked="$__f1['checked']" :options="$__f1['options']" /> @lang('restaurant.show_table')
						</label>
					</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					@php
					$__f2 = ['name' => 'module_info[tables][table_label]', 'value' => __('restaurant.table_label') . ':'];
					@endphp
					<x-form.label :name="$__f2['name']" :value="$__f2['value']" />
					@php
					$__f3 = ['name' => 'module_info[tables][table_label]', 'value' => $default['table_label'], 'options' => ['class' => 'form-control', 'placeholder' => __('restaurant.table_label') ]];
					@endphp
					<x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
				</div>
			</div>
		@endif
		@if(in_array('service_staff', $enabled_modules) )
			<div class="col-sm-3">
				<div class="form-group">
					<div class="checkbox">
						<label>
							@php
							$__f4 = ['name' => 'module_info[service_staff][show_service_staff]', 'value' => 1, 'checked' => $default['show_service_staff'], 'options' => ['class' => 'input-icheck']];
							@endphp
							<x-form.checkbox :name="$__f4['name']" :value="$__f4['value']" :checked="$__f4['checked']" :options="$__f4['options']" /> @lang('restaurant.show_service_staff')
						</label>
					</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					@php
					$__f5 = ['name' => 'module_info[service_staff][service_staff_label]', 'value' => __('restaurant.service_staff_label') . ':'];
					@endphp
					<x-form.label :name="$__f5['name']" :value="$__f5['value']" />
					@php
					$__f6 = ['name' => 'module_info[service_staff][service_staff_label]', 'value' => $default['service_staff_label'], 'options' => ['class' => 'form-control', 'placeholder' => __('restaurant.service_staff_label') ]];
					@endphp
					<x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
				</div>
			</div>
		@endif

		</div>
	</div>
</div>
@endif