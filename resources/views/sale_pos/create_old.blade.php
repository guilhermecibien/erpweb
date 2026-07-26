@extends('layouts.app')

@section('title', 'POS')

@section('content')

<!-- Content Header (Page header) -->
<!-- <section class="content-header">
    <h1>Add Purchase</h1> -->
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
<!-- </section> -->

<!-- Main content -->
<section class="content no-print">
	@if(!empty($pos_settings['allow_overselling']))
		<input type="hidden" id="is_overselling_allowed">
	@endif
	@if(session('business.enable_rp') == 1)
        <input type="hidden" id="reward_point_enabled">
    @endif
	<div class="row">
		<div class="@if(!empty($pos_settings['hide_product_suggestion']) && !empty($pos_settings['hide_recent_trans'])) col-md-10 col-md-offset-1 @else col-md-7 @endif col-sm-12">
			@component('components.widget', ['class' => 'box-success'])
				@slot('header')
					<div class="col-sm-6">
						<h3 class="box-title">POS Terminal <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="@include('sale_pos.partials.keyboard_shortcuts_details')" data-html="true" data-trigger="hover" data-original-title="" title=""></i></h3>
					</div>
					<div class="col-sm-6">
						<p class="text-right"><strong>@lang('sale.location'):</strong> {{$default_location->name}}</p>
					</div>
					<input type="hidden" id="item_addition_method" value="{{$business_details->item_addition_method}}">
				@endslot
				@php
				$__f1 = ['options' => ['url' => action('SellPosController@store'), 'method' => 'post', 'id' => 'add_pos_sell_form' ]];
				@endphp
				<x-form.open :options="$__f1['options']" />

				@php
				$__f2 = ['name' => 'location_id', 'value' => $default_location->id, 'options' => ['id' => 'location_id', 'data-receipt_printer_type' => !empty($default_location->receipt_printer_type) ? $default_location->receipt_printer_type : 'browser', 'data-default_accounts' => $default_location->default_payment_accounts]];
				@endphp
				<x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />

				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						@if(!empty($pos_settings['enable_transaction_date']))
							<div class="col-md-4 col-sm-6">
								<div class="form-group">
									@php
									$__f3 = ['name' => 'transaction_date', 'value' => __('sale.sale_date') . ':*'];
									@endphp
									<x-form.label :name="$__f3['name']" :value="$__f3['value']" />
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</span>
										@php
										$__f4 = ['name' => 'transaction_date', 'value' => $default_datetime, 'options' => ['class' => 'form-control', 'readonly', 'required']];
										@endphp
										<x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
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
										$__f5 = ['name' => 'exchange_rate', 'value' => config('constants.currency_exchange_rate'), 'options' => ['class' => 'form-control input-sm input_number', 'placeholder' => __('lang_v1.currency_exchange_rate'), 'id' => 'exchange_rate']];
										@endphp
										<x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
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
										$__f6 = ['name' => 'hidden_price_group', 'value' => key($price_groups), 'options' => ['id' => 'hidden_price_group']];
										@endphp
										<x-form.input type="hidden" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
										@php
										$__f7 = ['name' => 'price_group', 'list' => $price_groups, 'selected' => $selected_price_group, 'options' => ['class' => 'form-control select2', 'id' => 'price_group', 'style' => 'width: 100%;']];
										@endphp
										<x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
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
							$__f8 = ['name' => 'price_group', 'value' => key($price_groups), 'options' => ['id' => 'price_group']];
							@endphp
							<x-form.input type="hidden" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
						@endif
						@if(!empty($default_price_group_id))
							@php
							$__f9 = ['name' => 'default_price_group', 'value' => $default_price_group_id, 'options' => ['id' => 'default_price_group']];
							@endphp
							<x-form.input type="hidden" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
						@endif

						@if(in_array('types_of_service', $enabled_modules) && !empty($types_of_service))
							<div class="col-md-4 col-sm-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-external-link text-primary service_modal_btn"></i>
										</span>
										@php
										$__f10 = ['name' => 'types_of_service_id', 'list' => $types_of_service, 'selected' => null, 'options' => ['class' => 'form-control', 'id' => 'types_of_service_id', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.select_types_of_service')]];
										@endphp
										<x-form.select :name="$__f10['name']" :list="$__f10['list']" :selected="$__f10['selected']" :options="$__f10['options']" />

										@php
										$__f11 = ['name' => 'types_of_service_price_group', 'value' => null, 'options' => ['id' => 'types_of_service_price_group']];
										@endphp
										<x-form.input type="hidden" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />

										<span class="input-group-addon">
											@show_tooltip(__('lang_v1.types_of_service_help'))
										</span> 
									</div>
									<small><p class="help-block hide" id="price_group_text">@lang('lang_v1.price_group'): <span></span></p></small>
								</div>
							</div>
							<div class="modal fade types_of_service_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
						@endif

						@if(in_array('subscription', $enabled_modules))
							<div class="col-md-4 pull-right col-sm-6">
								<div class="checkbox">
									<label>
						              @php
						              $__f12 = ['name' => 'is_recurring', 'value' => 1, 'checked' => false, 'options' => ['class' => 'input-icheck', 'id' => 'is_recurring']];
						              @endphp
						              <x-form.checkbox :name="$__f12['name']" :value="$__f12['value']" :checked="$__f12['checked']" :options="$__f12['options']" /> @lang('lang_v1.subscribe')?
						            </label><button type="button" data-toggle="modal" data-target="#recurringInvoiceModal" class="btn btn-link"><i class="fa fa-external-link"></i></button>@show_tooltip(__('lang_v1.recurring_invoice_help'))
								</div>
							</div>
						@endif
					</div>
					<div class="row">
						<div class="@if(!empty($commission_agent)) col-sm-4 @else col-sm-6 @endif">
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
									$__f13 = ['name' => 'contact_id', 'list' => [], 'selected' => null, 'options' => ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required', 'style' => 'width: 100%;']];
									@endphp
									<x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""  @if(!auth()->user()->can('customer.create')) disabled @endif><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
									</span>
								</div>
							</div>
						</div>
						<input type="hidden" name="pay_term_number" id="pay_term_number" value="{{$walk_in_customer['pay_term_number']}}">
						<input type="hidden" name="pay_term_type" id="pay_term_type" value="{{$walk_in_customer['pay_term_type']}}">
						
						@if(!empty($commission_agent))
							<div class="col-sm-4">
								<div class="form-group">
								@php
								$__f14 = ['name' => 'commission_agent', 'list' => $commission_agent, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('lang_v1.commission_agent')]];
								@endphp
								<x-form.select :name="$__f14['name']" :list="$__f14['list']" :selected="$__f14['selected']" :options="$__f14['options']" />
								</div>
							</div>
						@endif

						<div class="@if(!empty($commission_agent)) col-sm-4 @else col-sm-6 @endif">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-btn">
										<button type="button" class="btn btn-default bg-white btn-flat" data-toggle="modal" data-target="#configure_search_modal" title="{{__('lang_v1.configure_product_search')}}"><i class="fa fa-barcode"></i></button>
									</div>
									@php
									$__f15 = ['name' => 'search_product', 'value' => null, 'options' => ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'disabled' => is_null($default_location)? true : false, 'autofocus' => is_null($default_location)? false : true, ]];
									@endphp
									<x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-default bg-white btn-flat pos_add_quick_product" data-href="{{action('ProductController@quickAdd')}}" data-container=".quick_add_product_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
									</span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>

						<!-- Call restaurant module if defined -->
				        @if(in_array('tables' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
				        	<span id="restaurant_module_span">
				          		<div class="col-md-3"></div>
				        	</span>
				        @endif
			        </div>

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
									<th class="text-center"><i class="fa fa-close" aria-hidden="true"></i></th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
						</div>
					</div>
					@include('sale_pos.partials.pos_details')

					@include('sale_pos.partials.payment_modal')

					@if(empty($pos_settings['disable_suspend']))
						@include('sale_pos.partials.suspend_note_modal')
					@endif

					@if(empty($pos_settings['disable_recurring_invoice']))
						@include('sale_pos.partials.recurring_invoice_modal')
					@endif
				</div>
				<!-- /.box-body -->
				<x-form.close />
			@endcomponent
		</div>

		<div class="col-md-5 col-sm-12">
			@include('sale_pos.partials.right_div')
		</div>
	</div>
</section>

<!-- This will be printed -->
<section class="invoice print_section" id="receipt_section">
</section>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	@include('contact.create', ['quick_add' => true])
</div>
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>

@include('sale_pos.partials.configure_search_modal')

@stop

@section('javascript')
	<script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/printer.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>
	@include('sale_pos.partials.keyboard_shortcuts')

	<!-- Call restaurant module if defined -->
    @if(in_array('tables' ,$enabled_modules) || in_array('modifiers' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
    	<script src="{{ asset('js/restaurant.js?v=' . $asset_v) }}"></script>
    @endif
@endsection
