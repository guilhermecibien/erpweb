@if($tables_enabled)
<div class="col-sm-4">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa fa-table"></i>
			</span>
			@php
			$__f1 = ['name' => 'res_table_id', 'list' => $tables, 'selected' => $view_data['res_table_id'], 'options' => ['class' => 'form-control', 'placeholder' => __('restaurant.select_table'), 'id' => 'res_table_id', 'onChange="changeTable(this)"']];
			@endphp
			<x-form.select :name="$__f1['name']" :list="$__f1['list']" :selected="$__f1['selected']" :options="$__f1['options']" />
		</div>
	</div>
</div>
@endif
@if($waiters_enabled)
<div class="col-sm-4">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="fa fa-user-secret"></i>
			</span>
			@php
			$__f2 = ['name' => 'res_waiter_id', 'list' => $waiters, 'selected' => $view_data['res_waiter_id'], 'options' => ['class' => 'form-control', 'placeholder' => __('restaurant.select_service_staff'), 'id' => 'res_waiter_id', 'required' => $is_service_staff_required ? true : false]];
			@endphp
			<x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
			@if(!empty($pos_settings['inline_service_staff']))
			<div class="input-group-btn">
				<button type="button" class="btn btn-default bg-white btn-flat" id="select_all_service_staff" data-toggle="tooltip" title="@lang('lang_v1.select_same_for_all_rows')"><i class="fa fa-check"></i></button>
			</div>
			@endif
		</div>
	</div>
</div>
@endif
