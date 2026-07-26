<div class="row">
	<div class="col-md-4">
		<div class="form-group" style="width: 100% !important">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-user"></i>
				</span>
				<input type="hidden" id="default_customer_id" 
				value="{{ $walk_in_customer['id']}}" >
				<input type="hidden" id="default_customer_name" 
				value="{{ $walk_in_customer['name']}}" >
				@php
				$__f1 = ['name' => 'contact_id', 'list' => [], 'selected' => null, 'options' => ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required', 'style' => 'width: 100%;']];
				@endphp
				<x-form.select :name="$__f1['name']" :list="$__f1['list']" :selected="$__f1['selected']" :options="$__f1['options']" />
				<span class="input-group-btn">
					<button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""  @if(!auth()->user()->can('customer.create')) disabled @endif><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-btn">
					<button type="button" class="btn btn-default bg-white btn-flat" data-toggle="modal" data-target="#configure_search_modal" title="{{__('lang_v1.configure_product_search')}}"><i class="fa fa-barcode"></i></button>
				</div>
				@php
				$__f2 = ['name' => 'search_product', 'value' => null, 'options' => ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'disabled' => is_null($default_location)? true : false, 'autofocus' => is_null($default_location)? false : true, ]];
				@endphp
				<x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
				<span class="input-group-btn">

					<!-- Show button for weighing scale modal -->
					@if(isset($pos_settings['enable_weighing_scale']) && $pos_settings['enable_weighing_scale'] == 1)
						<button type="button" class="btn btn-default bg-white btn-flat" id="weighing_scale_btn" data-toggle="modal" data-target="#weighing_scale_modal" 
						title="@lang('lang_v1.weighing_scale')"><i class="fa fa-digital-tachograph text-primary fa-lg"></i></button>
					@endif
					

					<button type="button" class="btn btn-default bg-white btn-flat pos_add_quick_product" data-href="{{action('ProductController@quickAdd')}}" data-container=".quick_add_product_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
				</span>
			</div>
		</div>
	</div>
</div>
<div class="row">
	@if(!empty($pos_settings['show_invoice_layout']))
	<div class="col-md-4">
		<div class="form-group">
		@php
		$__f3 = ['name' => 'invoice_layout_id', 'list' => $invoice_layouts, 'selected' => $default_location->invoice_layout_id, 'options' => ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_invoice_layout'), 'id' => 'invoice_layout_id']];
		@endphp
		<x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
		</div>
	</div>
	@endif
	<input type="hidden" name="pay_term_number" id="pay_term_number" value="{{$walk_in_customer['pay_term_number']}}">
	<input type="hidden" name="pay_term_type" id="pay_term_type" value="{{$walk_in_customer['pay_term_type']}}">
	
	@if(!empty($commission_agent))
		<div class="col-md-4">
			<div class="form-group">
			@php
			$__f4 = ['name' => 'commission_agent', 'list' => $commission_agent, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('lang_v1.commission_agent')]];
			@endphp
			<x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
			</div>
		</div>
	@endif
	@if(!empty($pos_settings['enable_transaction_date']))
		<div class="col-md-4 col-sm-6">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</span>
					@php
					$__f5 = ['name' => 'transaction_date', 'value' => $default_datetime, 'options' => ['class' => 'form-control', 'readonly', 'required', 'id' => 'transaction_date']];
					@endphp
					<x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
				</div>
			</div>
		</div>
	@endif
	@if(config('constants.enable_sell_in_diff_currency') == true)
		<div class="col-md-4 col-sm-6">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fas fa-exchange-alt"></i>
					</span>
					@php
					$__f6 = ['name' => 'exchange_rate', 'value' => config('constants.currency_exchange_rate'), 'options' => ['class' => 'form-control input-sm input_number', 'placeholder' => __('lang_v1.currency_exchange_rate'), 'id' => 'exchange_rate']];
					@endphp
					<x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
				</div>
			</div>
		</div>
	@endif
	@if(!empty($price_groups) && count($price_groups) > 1)
		<div class="col-md-4 col-sm-6">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fas fa-money-bill-alt"></i>
					</span>
					@php
						reset($price_groups);
						$selected_price_group = !empty($default_price_group_id) && array_key_exists($default_price_group_id, $price_groups) ? $default_price_group_id : null;
					@endphp
					@php
					$__f7 = ['name' => 'hidden_price_group', 'value' => key($price_groups), 'options' => ['id' => 'hidden_price_group']];
					@endphp
					<x-form.input type="hidden" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
					@php
					$__f8 = ['name' => 'price_group', 'list' => $price_groups, 'selected' => $selected_price_group, 'options' => ['class' => 'form-control select2', 'id' => 'price_group', 'style' => 'width: 100%;']];
					@endphp
					<x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
					<span class="input-group-addon">
						@show_tooltip(__('lang_v1.price_group_help_text'))
					</span> 
				</div>
			</div>
		</div>
	@else
		@php
			reset($price_groups);
		@endphp
		@php
		$__f9 = ['name' => 'price_group', 'value' => key($price_groups), 'options' => ['id' => 'price_group']];
		@endphp
		<x-form.input type="hidden" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
	@endif
	@if(!empty($default_price_group_id))
		@php
		$__f10 = ['name' => 'default_price_group', 'value' => $default_price_group_id, 'options' => ['id' => 'default_price_group']];
		@endphp
		<x-form.input type="hidden" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
	@endif

	@if(in_array('types_of_service', $enabled_modules) && !empty($types_of_service))
		<div class="col-md-4 col-sm-6">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-external-link-square-alt text-primary service_modal_btn"></i>
					</span>
					@php
					$__f11 = ['name' => 'types_of_service_id', 'list' => $types_of_service, 'selected' => null, 'options' => ['class' => 'form-control', 'id' => 'types_of_service_id', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.select_types_of_service')]];
					@endphp
					<x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />

					@php
					$__f12 = ['name' => 'types_of_service_price_group', 'value' => null, 'options' => ['id' => 'types_of_service_price_group']];
					@endphp
					<x-form.input type="hidden" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />

					<span class="input-group-addon">
						@show_tooltip(__('lang_v1.types_of_service_help'))
					</span> 
				</div>
				<small><p class="help-block hide" id="price_group_text">@lang('lang_v1.price_group'): <span></span></p></small>
			</div>
		</div>
		<div class="modal fade types_of_service_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
	@endif
	<!-- Call restaurant module if defined -->
    @if(in_array('tables' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
    	<div class="clearfix"></div>
    	<span id="restaurant_module_span">
      		<div class="col-md-3"></div>
    	</span>
    @endif
    @if(in_array('subscription', $enabled_modules))
		<div class="col-md-4 col-sm-6">
			<label>
              @php
              $__f13 = ['name' => 'is_recurring', 'value' => 1, 'checked' => false, 'options' => ['class' => 'input-icheck', 'id' => 'is_recurring']];
              @endphp
              <x-form.checkbox :name="$__f13['name']" :value="$__f13['value']" :checked="$__f13['checked']" :options="$__f13['options']" /> @lang('lang_v1.subscribe')?
            </label><button type="button" data-toggle="modal" data-target="#recurringInvoiceModal" class="btn btn-link"><i class="fa fa-external-link-square-alt"></i></button>@show_tooltip(__('lang_v1.recurring_invoice_help'))
		</div>
	@endif
</div>
<!-- include module fields -->
@if(!empty($pos_module_data))
    @foreach($pos_module_data as $key => $value)
        @if(!empty($value['view_path']))
            @includeIf($value['view_path'], ['view_data' => $value['view_data']])
        @endif
    @endforeach
@endif
<div class="row">
	<div class="col-sm-12 pos_product_div">
		<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="{{$business_details->sell_price_tax}}">

		<!-- Keeps count of product rows -->
		<input type="hidden" id="product_row_count" 
			value="0">
		@php
			$hide_tax = '';
			if( session()->get('business.enable_inline_tax') == 0){
				$hide_tax = 'hide';
			}
		@endphp
		<table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
			<thead>
				<tr>
					<th class="tex-center @if(!empty($pos_settings['inline_service_staff'])) col-md-3 @else col-md-4 @endif">	
						@lang('sale.product') @show_tooltip(__('lang_v1.tooltip_sell_product_column'))
					</th>
					<th class="text-center col-md-3">
						@lang('sale.qty')
					</th>
					@if(!empty($pos_settings['inline_service_staff']))
						<th class="text-center col-md-2">
							@lang('restaurant.service_staff')
						</th>
					@endif
					<th class="text-center col-md-2 {{$hide_tax}}">
						@lang('sale.price_inc_tax')
					</th>
					<th class="text-center col-md-2">
						@lang('sale.subtotal')
					</th>
					<th class="text-center"><i class="fas fa-times" aria-hidden="true"></i></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>