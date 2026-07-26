@extends('layouts.app')

@section('title', __('sale.edit_sale'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>@lang('sale.edit_sale') <small>(@lang('sale.invoice_no'): <span class="text-success">#{{$transaction->invoice_no}})</span></small></h1>
</section>
<!-- Main content -->
<section class="content">
	<input type="hidden" id="amount_rounding_method" value="{{$pos_settings['amount_rounding_method'] ?? ''}}">
	<input type="hidden" id="amount_rounding_method" value="{{$pos_settings['amount_rounding_method'] ?? 'none'}}">
	@if(!empty($pos_settings['allow_overselling']))
	<input type="hidden" id="is_overselling_allowed">
	@endif
	@if(session('business.enable_rp') == 1)
	<input type="hidden" id="reward_point_enabled">
	@endif
	<input type="hidden" id="item_addition_method" value="{{$business_details->item_addition_method}}">
	@php
	$__f1 = ['options' => ['url' => action('SellPosController@update', [$transaction->id, 'id' => $transaction->id ]), 'method' => 'put', 'id' => 'edit_sell_form' ]];
	@endphp
	<x-form.open :options="$__f1['options']" />

	@php
	$__f2 = ['name' => 'location_id', 'value' => $transaction->location_id, 'options' => ['id' => 'location_id', 'data-receipt_printer_type' => !empty($location_printer_type) ? $location_printer_type : 'browser']];
	@endphp
	<x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
	<div class="row">
		<div class="col-md-12 col-sm-12">
			@component('components.widget', ['class' => 'box-primary'])
			@if(!empty($transaction->selling_price_group_id))
			<div class="col-md-4 col-sm-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fas fa-money-bill-alt"></i>
						</span>
						@php
						$__f3 = ['name' => 'price_group', 'value' => $transaction->selling_price_group_id, 'options' => ['id' => 'price_group']];
						@endphp
						<x-form.input type="hidden" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
						@php
						$__f4 = ['name' => 'price_group_text', 'value' => $transaction->price_group->name, 'options' => ['class' => 'form-control', 'readonly']];
						@endphp
						<x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
						<span class="input-group-addon">
							@show_tooltip(__('lang_v1.price_group_help_text'))
						</span> 
					</div>
				</div>
			</div>
			@endif

			@if(in_array('types_of_service', $enabled_modules) && !empty($transaction->types_of_service))
			<div class="col-md-4 col-sm-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fas fa-external-link-square-alt text-primary service_modal_btn"></i>
						</span>
						@php
						$__f5 = ['name' => 'types_of_service_text', 'value' => $transaction->types_of_service->name, 'options' => ['class' => 'form-control', 'readonly']];
						@endphp
						<x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />

						@php
						$__f6 = ['name' => 'types_of_service_id', 'value' => $transaction->types_of_service_id, 'options' => ['id' => 'types_of_service_id']];
						@endphp
						<x-form.input type="hidden" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />

						<span class="input-group-addon">
							@show_tooltip(__('lang_v1.types_of_service_help'))
						</span> 
					</div>
					<small><p class="help-block @if(empty($transaction->selling_price_group_id)) hide @endif" id="price_group_text">@lang('lang_v1.price_group'): <span>@if(!empty($transaction->selling_price_group_id)){{$transaction->price_group->name}}@endif</span></p></small>
				</div>
			</div>
			<div class="modal fade types_of_service_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
				@if(!empty($transaction->types_of_service))
				@include('types_of_service.pos_form_modal', ['types_of_service' => $transaction->types_of_service])
				@endif
			</div>
			@endif

			@if(in_array('subscription', $enabled_modules))
			<div class="col-md-4 pull-right col-sm-6">
				<div class="checkbox">
					<label>
						@php
						$__f7 = ['name' => 'is_recurring', 'value' => 1, 'checked' => $transaction->is_recurring, 'options' => ['class' => 'input-icheck', 'id' => 'is_recurring']];
						@endphp
						<x-form.checkbox :name="$__f7['name']" :value="$__f7['value']" :checked="$__f7['checked']" :options="$__f7['options']" /> @lang('lang_v1.subscribe')?
					</label><button type="button" data-toggle="modal" data-target="#recurringInvoiceModal" class="btn btn-link"><i class="fa fa-external-link"></i></button>@show_tooltip(__('lang_v1.recurring_invoice_help'))
				</div>
			</div>
			@endif
			<div class="clearfix"></div>
			<div class="@if(!empty($commission_agent)) col-sm-3 @else col-sm-4 @endif">
				<div class="form-group">
					@php
					$__f8 = ['name' => 'contact_id', 'value' => __('contact.customer') . ':*'];
					@endphp
					<x-form.label :name="$__f8['name']" :value="$__f8['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-user"></i>
						</span>
						<input type="hidden" id="default_customer_id" 
						value="{{ $transaction->contact->id }}" >
						<input type="hidden" id="default_customer_name" 
						value="{{ $transaction->contact->name }}" >
						@php
						$__f9 = ['name' => 'contact_id', 'list' => [], 'selected' => null, 'options' => ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required']];
						@endphp
						<x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
						<span class="input-group-btn">
							<button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
						</span>
					</div>
				</div>
			</div>

			@if(!empty($commission_agent))
			<div class="col-sm-3">
				<div class="form-group">
					@php
					$__f10 = ['name' => 'commission_agent', 'value' => __('lang_v1.commission_agent') . ':'];
					@endphp
					<x-form.label :name="$__f10['name']" :value="$__f10['value']" />
					@php
					$__f11 = ['name' => 'commission_agent', 'list' => $commission_agent, 'selected' => $transaction->commission_agent, 'options' => ['class' => 'form-control select2']];
					@endphp
					<x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
				</div>
			</div>
			@endif
			<div class="@if(!empty($commission_agent)) col-sm-3 @else col-sm-4 @endif">
				<div class="form-group">
					@php
					$__f12 = ['name' => 'transaction_date', 'value' => __('sale.sale_date') . ':*'];
					@endphp
					<x-form.label :name="$__f12['name']" :value="$__f12['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
						@php
						$__f13 = ['name' => 'transaction_date', 'value' => $transaction->transaction_date, 'options' => ['class' => 'form-control', 'readonly', 'required']];
						@endphp
						<x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
					</div>
				</div>
			</div>
			@php
			if($transaction->status == 'draft' && $transaction->is_quotation == 1){
			$status = 'quotation';
		} else {
		$status = $transaction->status;
	}
	@endphp
	<div class="@if(!empty($commission_agent)) col-sm-3 @else col-sm-4 @endif">
		<div class="form-group">
			@php
			$__f14 = ['name' => 'status', 'value' => __('sale.status') . ':*'];
			@endphp
			<x-form.label :name="$__f14['name']" :value="$__f14['value']" />
			@php
			$__f15 = ['name' => 'status', 'list' => ['final' => 'Final', 'draft' => __('sale.draft'), 'quotation' => __('lang_v1.quotation')], 'selected' => $status, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
			@endphp
			<x-form.select :name="$__f15['name']" :list="$__f15['list']" :selected="$__f15['selected']" :options="$__f15['options']" />
		</div>
	</div>

	<div class="col-sm-4">
		<div class="form-group">
			@php
			$__f16 = ['name' => 'natureza_id', 'value' => 'Natureza de Operação'. ':*'];
			@endphp
			<x-form.label :name="$__f16['name']" :value="$__f16['value']" />
			@php
			$__f17 = ['name' => 'natureza_id', 'list' => $naturezas, 'selected' => $transaction->natureza_id, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
			@endphp
			<x-form.select :name="$__f17['name']" :list="$__f17['list']" :selected="$__f17['selected']" :options="$__f17['options']" />
		</div>
	</div>

	<div class="col-md-3" style="visibility: hidden;">
		<div class="form-group">
			<div class="multi-input">
				@php
				$__f18 = ['name' => 'pay_term_number', 'value' => __('contact.pay_term') . ':'];
				@endphp
				<x-form.label :name="$__f18['name']" :value="$__f18['value']" /> @show_tooltip(__('tooltip.pay_term'))
				<br/>
				@php
				$__f19 = ['name' => 'pay_term_number', 'value' => $transaction->pay_term_number, 'options' => ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]];
				@endphp
				<x-form.input type="number" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />

				@php
				$__f20 = ['name' => 'pay_term_type', 'list' => ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], 'selected' => $transaction->pay_term_type, 'options' => ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select')]];
				@endphp
				<x-form.select :name="$__f20['name']" :list="$__f20['list']" :selected="$__f20['selected']" :options="$__f20['options']" />
			</div>
		</div>
	</div>
	@if($transaction->status == 'draft')
	<div class="col-sm-3">
		<div class="form-group">
			@php
			$__f21 = ['name' => 'invoice_scheme_id', 'value' => __('invoice.invoice_scheme') . ':'];
			@endphp
			<x-form.label :name="$__f21['name']" :value="$__f21['value']" />
			@php
			$__f22 = ['name' => 'invoice_scheme_id', 'list' => $invoice_schemes, 'selected' => $default_invoice_schemes->id, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]];
			@endphp
			<x-form.select :name="$__f22['name']" :list="$__f22['list']" :selected="$__f22['selected']" :options="$__f22['options']" />
		</div>
	</div>
	@endif
	<div class="clearfix"></div>
	<!-- Call restaurant module if defined -->
	@if(in_array('tables' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
	<span id="restaurant_module_span" 
	data-transaction_id="{{$transaction->id}}">
	<div class="col-md-3"></div>
</span>
@endif
@endcomponent

@component('components.widget', ['class' => 'box-primary'])
<div class="col-sm-10 col-sm-offset-1">
	<div class="form-group">
		<div class="input-group">
			<div class="input-group-btn">
				<button type="button" class="btn btn-default bg-white btn-flat" data-toggle="modal" data-target="#configure_search_modal" title="{{__('lang_v1.configure_product_search')}}"><i class="fa fa-barcode"></i></button>
			</div>
			@php
			$__f23 = ['name' => 'search_product', 'value' => null, 'options' => ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus' => true, ]];
			@endphp
			<x-form.input type="text" :name="$__f23['name']" :value="$__f23['value']" :options="$__f23['options']" />
			<span class="input-group-btn">
				<button type="button" class="btn btn-default bg-white btn-flat pos_add_quick_product" data-href="{{action('ProductController@quickAdd')}}" data-container=".quick_add_product_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
			</span>
		</div>
	</div>
</div>

<div class="row col-sm-12 pos_product_div" style="min-height: 0">

	<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="{{$business_details->sell_price_tax}}">

	<!-- Keeps count of product rows -->
	<input type="hidden" id="product_row_count" 
	value="{{count($sell_details)}}">
	@php
	$hide_tax = '';
	if( session()->get('business.enable_inline_tax') == 0){
	$hide_tax = 'hide';
}
@endphp
<div class="table-responsive">
	<table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
		<thead>
			<tr>
				<th class="text-center">	
					@lang('sale.product')
				</th>
				<th class="text-center">
					@lang('sale.qty')
				</th>
				@if(!empty($pos_settings['inline_service_staff']))
				<th class="text-center">
					@lang('restaurant.service_staff')
				</th>
				@endif
				<th class="text-center {{$hide_tax}}">
					@lang('sale.price_inc_tax')
				</th>
				<th class="text-center">
					@lang('sale.subtotal')
				</th>
				<th class="text-center"><i class="fa fa-close" aria-hidden="true"></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($sell_details as $sell_line)
			@include('sale_pos.product_row', ['product' => $sell_line, 'row_count' => $loop->index, 'tax_dropdown' => $taxes, 'sub_units' => !empty($sell_line->unit_details) ? $sell_line->unit_details : [], 'action' => 'edit' ])
			@endforeach
		</tbody>
	</table>
</div>
<div class="table-responsive">
	<table class="table table-condensed table-bordered table-striped table-responsive">
		<tr>
			<td>
				<div class="pull-right">
					<b>@lang('sale.item'):</b> 
					<span class="total_quantity">0</span>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<b>@lang('sale.total'): </b>
					<span class="price_total">0</span>
				</div>
			</td>
		</tr>
	</table>
</div>
</div>
@endcomponent

<div class="box @if(!empty($class)) {{$class}} @else box-primary @endif" id="accordion">
	<div class="box-header with-border" style="cursor: pointer;">
		<h3 class="box-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseDesconto">
				Desconto
			</a>
		</h3>
	</div>
	<div id="collapseDesconto" class="panel-collapse active collapse" aria-expanded="true">
		<div class="box-body">
			<div class="col-md-4">
				<div class="form-group">
					@php
					$__f24 = ['name' => 'discount_type', 'value' => __('sale.discount_type') . ':*'];
					@endphp
					<x-form.label :name="$__f24['name']" :value="$__f24['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-info"></i>
						</span>
						@php
						$__f25 = ['name' => 'discount_type', 'list' => ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], 'selected' => $transaction->discount_type, 'options' => ['class' => 'form-control','placeholder' => __('messages.please_select'), 'required', 'data-default' => 'percentage']];
						@endphp
						<x-form.select :name="$__f25['name']" :list="$__f25['list']" :selected="$__f25['selected']" :options="$__f25['options']" />
					</div>
				</div>
			</div>
			@php
			$max_discount = !is_null(auth()->user()->max_sales_discount_percent) ? auth()->user()->max_sales_discount_percent : '';
			@endphp
			<div class="col-md-4">
				<div class="form-group">
					@php
					$__f26 = ['name' => 'discount_amount', 'value' => __('sale.discount_amount') . ':*'];
					@endphp
					<x-form.label :name="$__f26['name']" :value="$__f26['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-info"></i>
						</span>
						@php
						$__f27 = ['name' => 'discount_amount', 'value' => number_format($transaction->discount_amount, 2, ',', '.'), 'options' => ['class' => 'form-control input_number', 'data-default' => $business_details->default_sales_discount, 'data-max-discount' => $max_discount, 'data-max-discount-error_msg' => __('lang_v1.max_discount_error_msg', ['discount' => $max_discount != '' ? number_format($max_discount, 2, ',', '.') : '']) ]];
						@endphp
						<x-form.input type="text" :name="$__f27['name']" :value="$__f27['value']" :options="$__f27['options']" />
					</div>
				</div>
			</div>
			<div class="col-md-4"><br>
				<b>@lang( 'sale.discount_amount' ):</b>(-) 
				<span class="display_currency" id="total_discount">0</span>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12 well well-sm bg-light-gray @if(session('business.enable_rp') != 1) hide @endif">
				<input type="hidden" name="rp_redeemed" id="rp_redeemed" value="{{$transaction->rp_redeemed}}">
				<input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="{{$transaction->rp_redeemed_amount}}">
				<div class="col-md-12"><h4>{{session('business.rp_name')}}</h4></div>
				<div class="col-md-4">
					<div class="form-group">
						@php
						$__f28 = ['name' => 'rp_redeemed_modal', 'value' => __('lang_v1.redeemed') . ':'];
						@endphp
						<x-form.label :name="$__f28['name']" :value="$__f28['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-gift"></i>
							</span>
							@php
							$__f29 = ['name' => 'rp_redeemed_modal', 'value' => $transaction->rp_redeemed, 'options' => ['class' => 'form-control direct_sell_rp_input', 'data-amount_per_unit_point' => session('business.redeem_amount_per_unit_rp'), 'min' => 0, 'data-max_points' => !empty($redeem_details['points']) ? $redeem_details['points'] : 0, 'data-min_order_total' => session('business.min_order_total_for_redeem') ]];
							@endphp
							<x-form.input type="number" :name="$__f29['name']" :value="$__f29['value']" :options="$__f29['options']" />
							<input type="hidden" id="rp_name" value="{{session('business.rp_name')}}">
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<p><strong>@lang('lang_v1.available'):</strong> <span id="available_rp">{{$redeem_details['points'] ?? 0}}</span></p>
				</div>
				<div class="col-md-4">
					<p><strong>@lang('lang_v1.redeemed_amount'):</strong> (-)<span id="rp_redeemed_amount_text">{{@num_format($transaction->rp_redeemed_amount)}}</span></p>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-4">
				<div class="form-group">
					@php
					$__f30 = ['name' => 'tax_rate_id', 'value' => __('sale.order_tax') . ':*'];
					@endphp
					<x-form.label :name="$__f30['name']" :value="$__f30['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-info"></i>
						</span>
						@php
						$__f31 = ['name' => 'tax_rate_id', 'list' => $taxes['tax_rates'], 'selected' => $transaction->tax_id, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control', 'data-default'=> $business_details->default_sales_tax], 'optionsAttributes' => $taxes['attributes']];
						@endphp
						<x-form.select :name="$__f31['name']" :list="$__f31['list']" :selected="$__f31['selected']" :options="$__f31['options']" :options-attributes="$__f31['optionsAttributes']" />

						<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
						value="{{@num_format(optional($transaction->tax)->amount)}}" data-default="{{$business_details->tax_calculation_amount}}">
					</div>
				</div>
			</div>
			<div class="col-md-4 col-md-offset-4">
				<b>@lang( 'sale.order_tax' ):</b>(+) 
				<span class="display_currency" id="order_tax">{{$transaction->tax_amount}}</span>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-4">
				<div class="form-group">
					@php
					$__f32 = ['name' => 'shipping_details', 'value' => 'Detalhes de envio'];
					@endphp
					<x-form.label :name="$__f32['name']" :value="$__f32['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-info"></i>
						</span>
						@php
						$__f33 = ['name' => 'shipping_details', 'value' => $transaction->shipping_details, 'options' => ['class' => 'form-control','placeholder' => 'Detalhes de envio' ,'rows' => '1', 'cols'=>'30']];
						@endphp
						<x-form.textarea :name="$__f33['name']" :value="$__f33['value']" :options="$__f33['options']" />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					@php
					$__f34 = ['name' => 'shipping_address', 'value' => __('lang_v1.shipping_address')];
					@endphp
					<x-form.label :name="$__f34['name']" :value="$__f34['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-map-marker"></i>
						</span>
						@php
						$__f35 = ['name' => 'shipping_address', 'value' => $transaction->shipping_address, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.shipping_address') ,'rows' => '1', 'cols'=>'30']];
						@endphp
						<x-form.textarea :name="$__f35['name']" :value="$__f35['value']" :options="$__f35['options']" />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					@php
					$__f36 = ['name' => 'shipping_charges', 'value' => 'Custos de envio'];
					@endphp
					<x-form.label :name="$__f36['name']" :value="$__f36['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-info"></i>
						</span>
						@php
						$__f37 = ['name' => 'shipping_charges', 'value' => number_format($transaction->shipping_charges, 2, ',', '.'), 'options' => ['class'=>'form-control input_number','placeholder'=> 'Custos de envio']];
						@endphp
						<x-form.input type="text" :name="$__f37['name']" :value="$__f37['value']" :options="$__f37['options']" />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					@php
					$__f38 = ['name' => 'shipping_status', 'value' => __('lang_v1.shipping_status')];
					@endphp
					<x-form.label :name="$__f38['name']" :value="$__f38['value']" />
					@php
					$__f39 = ['name' => 'shipping_status', 'list' => $shipping_statuses, 'selected' => $transaction->shipping_status, 'options' => ['class' => 'form-control','placeholder' => __('messages.please_select')]];
					@endphp
					<x-form.select :name="$__f39['name']" :list="$__f39['list']" :selected="$__f39['selected']" :options="$__f39['options']" />
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					@php
					$__f40 = ['name' => 'delivered_to', 'value' => __('lang_v1.delivered_to') . ':'];
					@endphp
					<x-form.label :name="$__f40['name']" :value="$__f40['value']" />
					@php
					$__f41 = ['name' => 'delivered_to', 'value' => $transaction->delivered_to, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.delivered_to')]];
					@endphp
					<x-form.input type="text" :name="$__f41['name']" :value="$__f41['value']" :options="$__f41['options']" />
				</div>
			</div>
			<div class="col-md-4 col-md-offset-8">
				@if(!empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] > 0)
				<small id="round_off"><br>(@lang('lang_v1.round_off'): <span id="round_off_text">0</span>)</small>
				<br/>
				<input type="hidden" name="round_off_amount" 
				id="round_off_amount" value=0>
				@endif
				<div><b>@lang('sale.total_payable'): </b>
					<input type="hidden" name="final_total" id="final_total_input">
					<span id="total_payable">0</span>
				</div>
			</div>

		</div>
	</div>
</div>


<div class="box @if(!empty($class)) {{$class}} @else box-primary @endif" id="accordion">
	<div class="box-header with-border" style="cursor: pointer;">
		<h3 class="box-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
				Transporte
			</a>
		</h3>
	</div>
	<div id="collapseFilter" class="panel-collapse active collapse" aria-expanded="true">
		<div class="box-body">
			<div class="col-md-2">
				<div class="form-group">
					@php
					$__f42 = ['name' => 'placa', 'value' => 'Placa:'];
					@endphp
					<x-form.label :name="$__f42['name']" :value="$__f42['value']" />
					@php
					$__f43 = ['name' => 'placa', 'value' => $transaction->placa, 'options' => ['class' => 'form-control','placeholder' => 'placa', 'data-mask="AAA-AAAA"', 'data-mask-reverse="true"']];
					@endphp
					<x-form.input type="text" :name="$__f43['name']" :value="$__f43['value']" :options="$__f43['options']" />
				</div>
			</div>

			<div class="col-md-1">
				<div class="form-group">
					@php
					$__f44 = ['name' => 'uf', 'value' => 'UF:'];
					@endphp
					<x-form.label :name="$__f44['name']" :value="$__f44['value']" />

					@php
					$__f45 = ['name' => 'uf', 'list' => $ufs, 'selected' => $transaction->ud, 'options' => ['class' => 'form-control select2','placeholder' => 'UF', 'data-default' => 'percentage']];
					@endphp
					<x-form.select :name="$__f45['name']" :list="$__f45['list']" :selected="$__f45['selected']" :options="$__f45['options']" />

				</div>
			</div>

			<div class="col-md-2 col-sm-2">
				<div class="form-group">
					@php
					$__f46 = ['name' => 'tipo', 'value' => 'Tipo do frete:'];
					@endphp
					<x-form.label :name="$__f46['name']" :value="$__f46['value']" />

					@php
					$__f47 = ['name' => 'tipo', 'list' => $tiposFrete, 'selected' => $transaction->tipo, 'options' => ['class' => 'form-control select2', 'data-default' => 'percentage']];
					@endphp
					<x-form.select :name="$__f47['name']" :list="$__f47['list']" :selected="$__f47['selected']" :options="$__f47['options']" />

				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					@php
					$__f48 = ['name' => 'peso_liquido', 'value' => 'Peso liquido:'];
					@endphp
					<x-form.label :name="$__f48['name']" :value="$__f48['value']" />
					@php
					$__f49 = ['name' => 'peso_liquido', 'value' => $transaction->peso_liquido, 'options' => ['class' => 'form-control','placeholder' => 'Peso liquido', 'data-mask="00000000.000"', 'data-mask-reverse="true"']];
					@endphp
					<x-form.input type="text" :name="$__f49['name']" :value="$__f49['value']" :options="$__f49['options']" />
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					@php
					$__f50 = ['name' => 'peso_bruto', 'value' => 'Peso bruto:'];
					@endphp
					<x-form.label :name="$__f50['name']" :value="$__f50['value']" />
					@php
					$__f51 = ['name' => 'peso_bruto', 'value' => $transaction->peso_bruto, 'options' => ['class' => 'form-control','placeholder' => 'Peso bruto', 'data-mask="00000000.000"', 'data-mask-reverse="true"']];
					@endphp
					<x-form.input type="text" :name="$__f51['name']" :value="$__f51['value']" :options="$__f51['options']" />
				</div>
			</div>


			<div class="clearfix"></div>

			<div class="col-md-3">
				<div class="form-group">
					@php
					$__f52 = ['name' => 'especie', 'value' => 'Espécie:'];
					@endphp
					<x-form.label :name="$__f52['name']" :value="$__f52['value']" />
					@php
					$__f53 = ['name' => 'especie', 'value' => $transaction->especie, 'options' => ['class' => 'form-control','placeholder' => 'Espécie']];
					@endphp
					<x-form.input type="text" :name="$__f53['name']" :value="$__f53['value']" :options="$__f53['options']" />
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					@php
					$__f54 = ['name' => 'qtd_volumes', 'value' => 'Quantidade de volumes:'];
					@endphp
					<x-form.label :name="$__f54['name']" :value="$__f54['value']" />
					@php
					$__f55 = ['name' => 'qtd_volumes', 'value' => $transaction->qtd_volumes, 'options' => ['class' => 'form-control','placeholder' => 'Quantidade de volumes']];
					@endphp
					<x-form.input type="text" :name="$__f55['name']" :value="$__f55['value']" :options="$__f55['options']" />
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					@php
					$__f56 = ['name' => 'numeracao_volumes', 'value' => 'Numeração de volumes:'];
					@endphp
					<x-form.label :name="$__f56['name']" :value="$__f56['value']" />
					@php
					$__f57 = ['name' => 'numeracao_volumes', 'value' => $transaction->numeracao_volumes, 'options' => ['class' => 'form-control','placeholder' => 'Numeração de volumes']];
					@endphp
					<x-form.input type="text" :name="$__f57['name']" :value="$__f57['value']" :options="$__f57['options']" />
				</div>
			</div>

			<div class="clearfix"></div>


			<div class="col-md-2">
				<div class="form-group">
					@php
					$__f58 = ['name' => 'valor_frete', 'value' => 'Valor do frete:'];
					@endphp
					<x-form.label :name="$__f58['name']" :value="$__f58['value']" />
					@php
					$__f59 = ['name' => 'valor_frete', 'value' => $transaction->valor_frete, 'options' => ['id' => 'valor_frete', 'class' => 'form-control','placeholder' => 'Valor do frete', 'data-mask="00000000.00"', 'data-mask-reverse="true"']];
					@endphp
					<x-form.input type="text" :name="$__f59['name']" :value="$__f59['value']" :options="$__f59['options']" />
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					@php
					$__f60 = ['name' => 'transportadora_id', 'value' => 'Transportadora:'];
					@endphp
					<x-form.label :name="$__f60['name']" :value="$__f60['value']" />

					@php
					$__f61 = ['name' => 'transportadora_id', 'list' => $transportadoras, 'selected' => $transaction->transportadora_id, 'options' => ['class' => 'form-control select2','placeholder' => 'Transportadora', 'data-default' => 'percentage', 'style' => 'width: 100%']];
					@endphp
					<x-form.select :name="$__f61['name']" :list="$__f61['list']" :selected="$__f61['selected']" :options="$__f61['options']" />

				</div>
			</div>
		</div>
	</div>
</div>



@component('components.widget', ['class' => 'box-primary'])
<div class="col-md-12">
	<div class="form-group">
		@php
		$__f62 = ['name' => 'additional_notes', 'value' => 'Informação complementar'];
		@endphp
		<x-form.label :name="$__f62['name']" :value="$__f62['value']" />
		@php
		$__f63 = ['name' => 'additional_notes', 'value' => $transaction->additional_notes, 'options' => ['class' => 'form-control', 'rows' => 3]];
		@endphp
		<x-form.textarea :name="$__f63['name']" :value="$__f63['value']" :options="$__f63['options']" />
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		@php
		$__f64 = ['name' => 'referencia_nfe', 'value' => 'Referência NF-e' . ':'];
		@endphp
		<x-form.label :name="$__f64['name']" :value="$__f64['value']" />
		@php
		$__f65 = ['name' => 'referencia_nfe', 'value' => $transaction->referencia_nfe, 'options' => ['class' => 'form-control','placeholder' => 'Referência NF-e', 'data-mask="00000000000000000000000000000000000000000000"', 'data-mask-reverse="true"']];
		@endphp
		<x-form.input type="text" :name="$__f65['name']" :value="$__f65['value']" :options="$__f65['options']" />
	</div>
</div>
@endcomponent



<input type="hidden" name="is_direct_sale" value="1">



<div class="col-md-12 text-right">
	@php
	$__f66 = ['name' => 'is_save_and_print', 'value' => 0, 'options' => ['id' => 'is_save_and_print']];
	@endphp
	<x-form.input type="hidden" :name="$__f66['name']" :value="$__f66['value']" :options="$__f66['options']" />
	<button type="button" class="btn btn-primary" id="submit-sell">@lang('messages.update')</button>
	<button type="button" id="save-and-print" class="btn btn-primary btn-flat">@lang('lang_v1.update_and_print')</button>
</div>


</div>
</div>
@if(in_array('subscription', $enabled_modules))
@include('sale_pos.partials.recurring_invoice_modal')
@endif
<x-form.close />
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
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>
<!-- Call restaurant module if defined -->
@if(in_array('tables' ,$enabled_modules) || in_array('modifiers' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
<script src="{{ asset('js/restaurant.js?v=' . $asset_v) }}"></script>
@endif
@endsection
