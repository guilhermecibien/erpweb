@extends('layouts.app')

@section('title', __('sale.add_sale'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>@lang('sale.add_sale')</h1>
</section>
<!-- Main content -->
<section class="content no-print">
	<input type="hidden" id="amount_rounding_method" value="{{$pos_settings['amount_rounding_method'] ?? ''}}">
	@if(!empty($pos_settings['allow_overselling']))
	<input type="hidden" id="is_overselling_allowed">
	@endif
	@if(session('business.enable_rp') == 1)
	<input type="hidden" id="reward_point_enabled">
	@endif
	@if(is_null($default_location))
	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-map-marker"></i>
					</span>
					@php
					$__f1 = ['name' => 'select_location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.select_location'), 'id' => 'select_location_id', 'required', 'autofocus'], 'optionsAttributes' => $bl_attributes];
					@endphp
					<x-form.select :name="$__f1['name']" :list="$__f1['list']" :selected="$__f1['selected']" :options="$__f1['options']" :options-attributes="$__f1['optionsAttributes']" />
					<span class="input-group-addon">
						@show_tooltip(__('tooltip.sale_location'))
					</span> 
				</div>
			</div>
		</div>
	</div>
	@endif
	<input type="hidden" id="item_addition_method" value="{{$business_details->item_addition_method}}">
	@php
	$__f2 = ['options' => ['url' => action('SellPosController@store'), 'method' => 'post', 'id' => 'add_sell_form' ]];
	@endphp
	<x-form.open :options="$__f2['options']" />
	<div class="row">
		<div class="col-md-12 col-sm-12">
			@component('components.widget', ['class' => 'box-primary'])
			@php
			$__f3 = ['name' => 'location_id', 'value' => !empty($default_location) ? $default_location->id : null, 'options' => ['id' => 'location_id', 'data-receipt_printer_type' => !empty($default_location->receipt_printer_type) ? $default_location->receipt_printer_type : 'browser', 'data-default_accounts' => !empty($default_location) ? $default_location->default_payment_accounts : '']];
			@endphp
			<x-form.input type="hidden" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />

			@if(!empty($price_groups))
			@if(count($price_groups) > 1)
			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fas fa-money-bill-alt"></i>
						</span>
						@php
						reset($price_groups);
						@endphp
						@php
						$__f4 = ['name' => 'hidden_price_group', 'value' => key($price_groups), 'options' => ['id' => 'hidden_price_group']];
						@endphp
						<x-form.input type="hidden" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
						@php
						$__f5 = ['name' => 'price_group', 'list' => $price_groups, 'selected' => null, 'options' => ['class' => 'form-control select2', 'id' => 'price_group']];
						@endphp
						<x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
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
			$__f6 = ['name' => 'price_group', 'value' => key($price_groups), 'options' => ['id' => 'price_group']];
			@endphp
			<x-form.input type="hidden" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
			@endif
			@endif

			@php
			$__f7 = ['name' => 'default_price_group', 'value' => null, 'options' => ['id' => 'default_price_group']];
			@endphp
			<x-form.input type="hidden" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />

			@if(in_array('types_of_service', $enabled_modules) && !empty($types_of_service))
			<div class="col-md-4 col-sm-6">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-external-link-square-alt text-primary service_modal_btn"></i>
						</span>
						@php
						$__f8 = ['name' => 'types_of_service_id', 'list' => $types_of_service, 'selected' => null, 'options' => ['class' => 'form-control', 'id' => 'types_of_service_id', 'style' => 'width: 100%;', 'placeholder' => 'Tipo de serviço']];
						@endphp
						<x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />

						@php
						$__f9 = ['name' => 'types_of_service_price_group', 'value' => null, 'options' => ['id' => 'types_of_service_price_group']];
						@endphp
						<x-form.input type="hidden" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />

						<span class="input-group-addon">
							@show_tooltip('Tipo de serviço significa serviços como jantares, encomendas, entrega ao domicílio, entrega a terceiros, etc.')
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
						$__f10 = ['name' => 'is_recurring', 'value' => 1, 'checked' => false, 'options' => ['class' => 'input-icheck', 'id' => 'is_recurring']];
						@endphp
						<x-form.checkbox :name="$__f10['name']" :value="$__f10['value']" :checked="$__f10['checked']" :options="$__f10['options']" /> @lang('lang_v1.subscribe')?
					</label><button type="button" data-toggle="modal" data-target="#recurringInvoiceModal" class="btn btn-link"><i class="fa fa-external-link"></i></button>@show_tooltip(__('lang_v1.recurring_invoice_help'))
				</div>
			</div>
			@endif

			<div class="clearfix"></div>
			<div class="@if(!empty($commission_agent)) col-sm-3 @else col-sm-4 @endif">
				<div class="form-group">
					@php
					$__f11 = ['name' => 'contact_id', 'value' => __('contact.customer') . ':*'];
					@endphp
					<x-form.label :name="$__f11['name']" :value="$__f11['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-user"></i>
						</span>
						<input type="hidden" id="default_customer_id" 
						value="{{ $walk_in_customer['id']}}" >
						<input type="hidden" id="default_customer_name" 
						value="{{ $walk_in_customer['name']}}" >
						@php
						$__f12 = ['name' => 'contact_id', 'list' => [], 'selected' => null, 'options' => ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Entre com nome do cliente', 'required']];
						@endphp
						<x-form.select :name="$__f12['name']" :list="$__f12['list']" :selected="$__f12['selected']" :options="$__f12['options']" />
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
					$__f13 = ['name' => 'commission_agent', 'value' => __('lang_v1.commission_agent') . ':'];
					@endphp
					<x-form.label :name="$__f13['name']" :value="$__f13['value']" />
					@php
					$__f14 = ['name' => 'commission_agent', 'list' => $commission_agent, 'selected' => null, 'options' => ['class' => 'form-control select2']];
					@endphp
					<x-form.select :name="$__f14['name']" :list="$__f14['list']" :selected="$__f14['selected']" :options="$__f14['options']" />
				</div>
			</div>
			@endif

			<div class="@if(!empty($commission_agent)) col-sm-3 @else col-sm-4 @endif">
				<div class="form-group">
					@php
					$__f15 = ['name' => 'transaction_date', 'value' => __('sale.sale_date') . ':*'];
					@endphp
					<x-form.label :name="$__f15['name']" :value="$__f15['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
						@php
						$__f16 = ['name' => 'transaction_date', 'value' => $default_datetime, 'options' => ['class' => 'form-control', 'readonly', 'required']];
						@endphp
						<x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
					</div>
				</div>
			</div>

			<div class="@if(!empty($commission_agent)) col-sm-3 @else col-sm-4 @endif">
				<div class="form-group">
					@php
					$__f17 = ['name' => 'status', 'value' => __('sale.status') . ':*'];
					@endphp
					<x-form.label :name="$__f17['name']" :value="$__f17['value']" />
					@php
					$__f18 = ['name' => 'status', 'list' => ['final' => 'Final', 'draft' => __('sale.draft'), 'quotation' => __('lang_v1.quotation')], 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
					@endphp
					<x-form.select :name="$__f18['name']" :list="$__f18['list']" :selected="$__f18['selected']" :options="$__f18['options']" />
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					@php
					$__f19 = ['name' => 'invoice_scheme_id', 'value' => __('invoice.invoice_scheme') . ':'];
					@endphp
					<x-form.label :name="$__f19['name']" :value="$__f19['value']" />
					@php
					$__f20 = ['name' => 'invoice_scheme_id', 'list' => $invoice_schemes, 'selected' => $default_invoice_schemes->id, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]];
					@endphp
					<x-form.select :name="$__f20['name']" :list="$__f20['list']" :selected="$__f20['selected']" :options="$__f20['options']" />
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group">
					@php
					$__f21 = ['name' => 'natureza_id', 'value' => 'Natureza de Operação'. ':*'];
					@endphp
					<x-form.label :name="$__f21['name']" :value="$__f21['value']" />
					@php
					$__f22 = ['name' => 'natureza_id', 'list' => $naturezas, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
					@endphp
					<x-form.select :name="$__f22['name']" :list="$__f22['list']" :selected="$__f22['selected']" :options="$__f22['options']" />
				</div>
			</div>

			<div class="clearfix"></div>
			<!-- Call restaurant module if defined -->
			@if(in_array('tables' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
			<span id="restaurant_module_span">
				<div class="col-md-3"></div>
			</span>
			@endif


			<div class="col-sm-3" style="visibility: hidden">
				<div class="form-group">
					<div class="multi-input">
						@php
						$__f23 = ['name' => 'pay_term_number', 'value' => __('contact.pay_term') . ':'];
						@endphp
						<x-form.label :name="$__f23['name']" :value="$__f23['value']" /> @show_tooltip(__('tooltip.pay_term'))
						<br/>
						@php
						$__f24 = ['name' => 'pay_term_number', 'value' => $walk_in_customer['pay_term_number'], 'options' => ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]];
						@endphp
						<x-form.input type="number" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />

						@php
						$__f25 = ['name' => 'pay_term_type', 'list' => ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], 'selected' => $walk_in_customer['pay_term_type'], 'options' => ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select')]];
						@endphp
						<x-form.select :name="$__f25['name']" :list="$__f25['list']" :selected="$__f25['selected']" :options="$__f25['options']" />
					</div>
				</div>
			</div>

			
			@endcomponent

			@component('components.widget', ['class' => 'box-primary', 'title' => 'Produtos da Venda'])
			<div class="col-sm-10 col-sm-offset-1">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-btn">
							<button type="button" class="btn btn-default bg-white btn-flat" data-toggle="modal" data-target="#configure_search_modal" title="{{__('lang_v1.configure_product_search')}}"><i class="fa fa-barcode"></i></button>
						</div>
						@php
						$__f26 = ['name' => 'search_product', 'value' => null, 'options' => ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'disabled' => is_null($default_location)? true : false, 'autofocus' => is_null($default_location)? false : true, ]];
						@endphp
						<x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
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
				value="0">
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
						<tbody></tbody>
					</table>
				</div>
				<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped">
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


			<!-- aqui desconto -->

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
								$__f27 = ['name' => 'discount_type', 'value' => 'Tipo do desconto*'];
								@endphp
								<x-form.label :name="$__f27['name']" :value="$__f27['value']" />
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-info"></i>
									</span>
									@php
									$__f28 = ['name' => 'discount_type', 'list' => ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], 'selected' => 'percentage', 'options' => ['class' => 'form-control','placeholder' => __('messages.please_select'), 'required', 'data-default' => 'percentage']];
									@endphp
									<x-form.select :name="$__f28['name']" :list="$__f28['list']" :selected="$__f28['selected']" :options="$__f28['options']" />
								</div>
							</div>
						</div>
						@php
						$max_discount = !is_null(auth()->user()->max_sales_discount_percent) ? auth()->user()->max_sales_discount_percent : '';

						//if sale discount is more than user max discount change it to max discount
						$sales_discount = $business_details->default_sales_discount;
						if($max_discount != '' && $sales_discount > $max_discount) $sales_discount = $max_discount;
						@endphp
						<div class="col-md-4">
							<div class="form-group">
								@php
								$__f29 = ['name' => 'discount_amount', 'value' => __('sale.discount_amount') . ':*'];
								@endphp
								<x-form.label :name="$__f29['name']" :value="$__f29['value']" />
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-info"></i>
									</span>
									@php
									$__f30 = ['name' => 'discount_amount', 'value' => number_format($sales_discount, 2, ',', '.'), 'options' => ['class' => 'form-control input_number', 'data-default' => $sales_discount, 'data-max-discount' => $max_discount, 'data-max-discount-error_msg' => __('lang_v1.max_discount_error_msg', ['discount' => $max_discount != '' ? number_format($max_discount, 2, ',', '.') : '']) ]];
									@endphp
									<x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
								</div>
							</div>
						</div>
						<div class="col-md-4"><br>
							<b>@lang( 'sale.discount_amount' ):</b>(-) 
							<span class="display_currency" id="total_discount">0</span>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12 well well-sm bg-light-gray @if(session('business.enable_rp') != 1) hide @endif">
							<input type="hidden" name="rp_redeemed" id="rp_redeemed" value="0">
							<input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="0">
							<div class="col-md-12"><h4>{{session('business.rp_name')}}</h4></div>
							<div class="col-md-4">
								<div class="form-group">
									@php
									$__f31 = ['name' => 'rp_redeemed_modal', 'value' => __('lang_v1.redeemed') . ':'];
									@endphp
									<x-form.label :name="$__f31['name']" :value="$__f31['value']" />
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-gift"></i>
										</span>
										@php
										$__f32 = ['name' => 'rp_redeemed_modal', 'value' => 0, 'options' => ['class' => 'form-control direct_sell_rp_input', 'data-amount_per_unit_point' => session('business.redeem_amount_per_unit_rp'), 'min' => 0, 'data-max_points' => 0, 'data-min_order_total' => session('business.min_order_total_for_redeem') ]];
										@endphp
										<x-form.input type="number" :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
										<input type="hidden" id="rp_name" value="{{session('business.rp_name')}}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<p><strong>@lang('lang_v1.available'):</strong> <span id="available_rp">0</span></p>
							</div>
							<div class="col-md-4">
								<p><strong>@lang('lang_v1.redeemed_amount'):</strong> (-)<span id="rp_redeemed_amount_text">0</span></p>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-4">
							<div class="form-group">
								@php
								$__f33 = ['name' => 'tax_rate_id', 'value' => __('sale.order_tax') . ':*'];
								@endphp
								<x-form.label :name="$__f33['name']" :value="$__f33['value']" />
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-info"></i>
									</span>
									@php
									$__f34 = ['name' => 'tax_rate_id', 'list' => $taxes['tax_rates'], 'selected' => $business_details->default_sales_tax, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control', 'data-default'=> $business_details->default_sales_tax], 'optionsAttributes' => $taxes['attributes']];
									@endphp
									<x-form.select :name="$__f34['name']" :list="$__f34['list']" :selected="$__f34['selected']" :options="$__f34['options']" :options-attributes="$__f34['optionsAttributes']" />

									<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
									value="@if(empty($edit)) {{@num_format($business_details->tax_calculation_amount)}} @else {{@num_format(optional($transaction->tax)->amount)}} @endif" data-default="{{$business_details->tax_calculation_amount}}">
								</div>
							</div>
						</div>
						<div class="col-md-4 col-md-offset-4">
							<b>@lang( 'sale.order_tax' ):</b>(+) 
							<span class="display_currency" id="order_tax">0</span>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-4">
							<div class="form-group">
								@php
								$__f35 = ['name' => 'shipping_details', 'value' => 'Detalhes de envio'];
								@endphp
								<x-form.label :name="$__f35['name']" :value="$__f35['value']" />
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-info"></i>
									</span>
									@php
									$__f36 = ['name' => 'shipping_details', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Detalhes de envio' ,'rows' => '1', 'cols'=>'30']];
									@endphp
									<x-form.textarea :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								@php
								$__f37 = ['name' => 'shipping_address', 'value' => __('lang_v1.shipping_address')];
								@endphp
								<x-form.label :name="$__f37['name']" :value="$__f37['value']" />
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-map-marker"></i>
									</span>
									@php
									$__f38 = ['name' => 'shipping_address', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.shipping_address') ,'rows' => '1', 'cols'=>'30']];
									@endphp
									<x-form.textarea :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								@php
								$__f39 = ['name' => 'shipping_charges', 'value' => 'Custos de envio'];
								@endphp
								<x-form.label :name="$__f39['name']" :value="$__f39['value']" />
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-info"></i>
									</span>
									@php
									$__f40 = ['name' => 'shipping_charges', 'value' => number_format(0.00, 2, ',', '.'), 'options' => ['class'=>'form-control input_number','placeholder'=> __('sale.shipping_charges')]];
									@endphp
									<x-form.input type="text" :name="$__f40['name']" :value="$__f40['value']" :options="$__f40['options']" />
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								@php
								$__f41 = ['name' => 'shipping_status', 'value' => __('lang_v1.shipping_status')];
								@endphp
								<x-form.label :name="$__f41['name']" :value="$__f41['value']" />
								@php
								$__f42 = ['name' => 'shipping_status', 'list' => $shipping_statuses, 'selected' => null, 'options' => ['class' => 'form-control','placeholder' => __('messages.please_select')]];
								@endphp
								<x-form.select :name="$__f42['name']" :list="$__f42['list']" :selected="$__f42['selected']" :options="$__f42['options']" />
							</div>
						</div>
						
						<div class="clearfix"></div>
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


						<input type="hidden" name="is_direct_sale" value="1">


					</div>
				</div>
			</div>

			<!-- termina desconto -->


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
								$__f43 = ['name' => 'placa', 'value' => 'Placa:'];
								@endphp
								<x-form.label :name="$__f43['name']" :value="$__f43['value']" />
								@php
								$__f44 = ['name' => 'placa', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'placa', 'data-mask="AAA-AAAA"', 'data-mask-reverse="true"']];
								@endphp
								<x-form.input type="text" :name="$__f44['name']" :value="$__f44['value']" :options="$__f44['options']" />
							</div>
						</div>

						<div class="col-md-1">
							<div class="form-group">
								@php
								$__f45 = ['name' => 'uf', 'value' => 'UF:'];
								@endphp
								<x-form.label :name="$__f45['name']" :value="$__f45['value']" />

								@php
								$__f46 = ['name' => 'uf', 'list' => $ufs, 'selected' => 'uf', 'options' => ['class' => 'form-control select2','placeholder' => 'UF', 'data-default' => 'percentage']];
								@endphp
								<x-form.select :name="$__f46['name']" :list="$__f46['list']" :selected="$__f46['selected']" :options="$__f46['options']" />

							</div>
						</div>

						<div class="col-md-2 col-sm-2">
							<div class="form-group">
								@php
								$__f47 = ['name' => 'tipo', 'value' => 'Tipo do frete:'];
								@endphp
								<x-form.label :name="$__f47['name']" :value="$__f47['value']" />

								@php
								$__f48 = ['name' => 'tipo', 'list' => $tiposFrete, 'selected' => 'tipo', 'options' => ['class' => 'form-control', 'data-default' => 'percentage']];
								@endphp
								<x-form.select :name="$__f48['name']" :list="$__f48['list']" :selected="$__f48['selected']" :options="$__f48['options']" />

							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								@php
								$__f49 = ['name' => 'peso_liquido', 'value' => 'Peso liquido:'];
								@endphp
								<x-form.label :name="$__f49['name']" :value="$__f49['value']" />
								@php
								$__f50 = ['name' => 'peso_liquido', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Peso liquido', 'data-mask="00000000.000"', 'data-mask-reverse="true"']];
								@endphp
								<x-form.input type="text" :name="$__f50['name']" :value="$__f50['value']" :options="$__f50['options']" />
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								@php
								$__f51 = ['name' => 'peso_bruto', 'value' => 'Peso bruto:'];
								@endphp
								<x-form.label :name="$__f51['name']" :value="$__f51['value']" />
								@php
								$__f52 = ['name' => 'peso_bruto', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Peso bruto', 'data-mask="00000000.000"', 'data-mask-reverse="true"']];
								@endphp
								<x-form.input type="text" :name="$__f52['name']" :value="$__f52['value']" :options="$__f52['options']" />
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								@php
								$__f53 = ['name' => 'especie', 'value' => 'Espécie:'];
								@endphp
								<x-form.label :name="$__f53['name']" :value="$__f53['value']" />
								@php
								$__f54 = ['name' => 'especie', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Espécie']];
								@endphp
								<x-form.input type="text" :name="$__f54['name']" :value="$__f54['value']" :options="$__f54['options']" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								@php
								$__f55 = ['name' => 'qtd_volumes', 'value' => 'Quantidade de volumes:'];
								@endphp
								<x-form.label :name="$__f55['name']" :value="$__f55['value']" />
								@php
								$__f56 = ['name' => 'qtd_volumes', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Quantidade de volumes']];
								@endphp
								<x-form.input type="text" :name="$__f56['name']" :value="$__f56['value']" :options="$__f56['options']" />
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								@php
								$__f57 = ['name' => 'numeracao_volumes', 'value' => 'Numeração de volumes:'];
								@endphp
								<x-form.label :name="$__f57['name']" :value="$__f57['value']" />
								@php
								$__f58 = ['name' => 'numeracao_volumes', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Numeração de volumes']];
								@endphp
								<x-form.input type="text" :name="$__f58['name']" :value="$__f58['value']" :options="$__f58['options']" />
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								@php
								$__f59 = ['name' => 'valor_frete', 'value' => 'Valor do frete:'];
								@endphp
								<x-form.label :name="$__f59['name']" :value="$__f59['value']" />
								@php
								$__f60 = ['name' => 'valor_frete', 'value' => 0.00, 'options' => ['id' => 'valor_frete', 'class' => 'form-control','placeholder' => 'Valor do frete', 'data-mask="00000000,00"', 'data-mask-reverse="true"']];
								@endphp
								<x-form.input type="text" :name="$__f60['name']" :value="$__f60['value']" :options="$__f60['options']" />
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								@php
								$__f61 = ['name' => 'transportadora_id', 'value' => 'Transportadora:'];
								@endphp
								<x-form.label :name="$__f61['name']" :value="$__f61['value']" />

								@php
								$__f62 = ['name' => 'transportadora_id', 'list' => $transportadoras, 'selected' => 'transportadora_id', 'options' => ['class' => 'form-control select2','placeholder' => 'Transportadora', 'data-default' => 'percentage', 'style' => 'width: 100%']];
								@endphp
								<x-form.select :name="$__f62['name']" :list="$__f62['list']" :selected="$__f62['selected']" :options="$__f62['options']" />

							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								@php
								$__f63 = ['name' => 'delivered_to', 'value' => __('lang_v1.delivered_to') . ':'];
								@endphp
								<x-form.label :name="$__f63['name']" :value="$__f63['value']" />
								@php
								$__f64 = ['name' => 'delivered_to', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.delivered_to')]];
								@endphp
								<x-form.input type="text" :name="$__f64['name']" :value="$__f64['value']" :options="$__f64['options']" />
							</div>
						</div>
					</div>
				</div>
			</div>

			@component('components.widget', ['class' => 'box-primary'])
			<div class="col-md-12">
				<div class="form-group">
					@php
					$__f65 = ['name' => 'additional_notes', 'value' => 'Informação complementar'];
					@endphp
					<x-form.label :name="$__f65['name']" :value="$__f65['value']" />
					@php
					$__f66 = ['name' => 'additional_notes', 'value' => $default_location ? $default_location->info_complementar : '', 'options' => ['class' => 'form-control', 'rows' => 3, 'id' => 'info_complementar']];
					@endphp
					<x-form.textarea :name="$__f66['name']" :value="$__f66['value']" :options="$__f66['options']" />
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					@php
					$__f67 = ['name' => 'referencia_nfe', 'value' => 'Referência NF-e' . ':'];
					@endphp
					<x-form.label :name="$__f67['name']" :value="$__f67['value']" />
					@php
					$__f68 = ['name' => 'referencia_nfe', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Referência NF-e', 'data-mask="00000000000000000000000000000000000000000000"', 'data-mask-reverse="true"']];
					@endphp
					<x-form.input type="text" :name="$__f68['name']" :value="$__f68['value']" :options="$__f68['options']" />
				</div>
			</div>

			@include('sale_pos.partials.payment_modal_pedido')

			<input type="hidden" id="json_boleto" name="json_boleto">

			@php
			$__f69 = ['name' => 'is_save_and_print', 'value' => 0, 'options' => ['id' => 'is_save_and_print']];
			@endphp
			<x-form.input type="hidden" :name="$__f69['name']" :value="$__f69['value']" :options="$__f69['options']" />
			<div class="col-sm-12 text-right">
		<!-- <button type="button" id="submit-sell" class="btn btn-primary btn-flat">@lang('messages.save')</button>
			<button type="button" id="save-and-print" class="btn btn-primary btn-flat">@lang('lang_v1.save_and_print')</button> -->

			<button type="button" class="btn bg-navy btn-default" id="pedido-finalize" title="@lang('lang_v1.tooltip_checkout_multi_pay')"><i class="fas fa-check" aria-hidden="true"></i> Finalizar Venda</button>
		</div>
		@endcomponent

	</div>
</div>





<!-- TAG Pagamento -->


<!-- <div class="row">
	
	@php
	$__f70 = ['name' => 'is_save_and_print', 'value' => 0, 'options' => ['id' => 'is_save_and_print']];
	@endphp
	<x-form.input type="hidden" :name="$__f70['name']" :value="$__f70['value']" :options="$__f70['options']" />
	<div class="col-sm-12 text-right">
	<button type="button" id="submit-sell" class="btn btn-primary btn-flat">@lang('messages.save')</button>
		<button type="button" id="save-and-print" class="btn btn-primary btn-flat">@lang('lang_v1.save_and_print')</button>

		<button type="button" class="btn bg-navy btn-default" id="pedido-finalize" title="@lang('lang_v1.tooltip_checkout_multi_pay')"><i class="fas fa-check" aria-hidden="true"></i> Finalizar</button>
	</div>

</div> -->
<br>

@if(empty($pos_settings['disable_recurring_invoice']))
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


<script type="text/javascript">
	$('#select_location_id').change((target) => {
		let id = target.target.value
		if(id){
			$.get('/business-location/'+id+'/settingsAjax')
			.done((res) => {
				console.log(res)
				$('#info_complementar').val(res.info_complementar)
			})
			.fail((err) => {
				console.log(err)
			})
		}
	})
</script>


@endsection
