@extends('layouts.app')
@section('title', __('purchase.add_purchase'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>@lang('purchase.add_purchase') <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="@include('purchase.partials.keyboard_shortcuts_details')" data-html="true" data-trigger="hover" data-original-title="" title=""></i></h1>
</section>

<!-- Main content -->
<section class="content">

	<!-- Page level currency setting -->
	<input type="hidden" id="p_code" value="{{$currency_details->code}}">
	<input type="hidden" id="p_symbol" value="{{$currency_details->symbol}}">
	<input type="hidden" id="p_thousand" value="{{$currency_details->thousand_separator}}">
	<input type="hidden" id="p_decimal" value="{{$currency_details->decimal_separator}}">

	@include('layouts.partials.error')

	@php
	$__f1 = ['options' => ['url' => action('PurchaseController@store'), 'method' => 'post', 'id' => 'add_purchase_form', 'files' => true ]];
	@endphp
	<x-form.open :options="$__f1['options']" />
	@component('components.widget', ['class' => 'box-primary'])

	<input type="hidden" name="faturas" id="faturas" value="">

	<div class="row">
		<div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
			<div class="form-group">
				@php
				$__f2 = ['name' => 'supplier_id', 'value' => __('purchase.supplier') . ':*'];
				@endphp
				<x-form.label :name="$__f2['name']" :value="$__f2['value']" />
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-user"></i>
					</span>
					@php
					$__f3 = ['name' => 'contact_id', 'list' => [], 'selected' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'supplier_id']];
					@endphp
					<x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
					<span class="input-group-btn">
						<button type="button" class="btn btn-default bg-white btn-flat add_new_supplier" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
					</span>
				</div>
			</div>
		</div>
		<div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
			<div class="form-group">
				@php
				$__f4 = ['name' => 'ref_no', 'value' => __('purchase.ref_no').':'];
				@endphp
				<x-form.label :name="$__f4['name']" :value="$__f4['value']" />
				@php
				$__f5 = ['name' => 'ref_no', 'value' => null, 'options' => ['class' => 'form-control']];
				@endphp
				<x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
			</div>
		</div>
		<div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
			<div class="form-group">
				@php
				$__f6 = ['name' => 'transaction_date', 'value' => __('purchase.purchase_date') . ':*'];
				@endphp
				<x-form.label :name="$__f6['name']" :value="$__f6['value']" />
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</span>
					@php
					$__f7 = ['name' => 'transaction_date', 'value' => \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . (session('business.time_format') == 24 ? 'H:i' : 'h:i A')), 'options' => ['class' => 'form-control', 'readonly', 'required']];
					@endphp
					<x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
				</div>
			</div>
		</div>
		<div class="col-sm-3 @if(!empty($default_purchase_status)) hide @endif">
			<div class="form-group">
				@php
				$__f8 = ['name' => 'status', 'value' => __('purchase.purchase_status') . ':*'];
				@endphp
				<x-form.label :name="$__f8['name']" :value="$__f8['value']" /> @show_tooltip(__('tooltip.order_status'))
				@php
				$__f9 = ['name' => 'status', 'list' => $orderStatuses, 'selected' => $default_purchase_status, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
				@endphp
				<x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
			</div>
		</div>

		<div class="clearfix"></div>

		@if(count($business_locations) == 1)
		@php 
		$default_location = current(array_keys($business_locations->toArray()));
		$search_disable = false; 
		@endphp
		@else
		@php $default_location = null;
		$search_disable = true;
		@endphp
		@endif
		<div class="col-sm-3">
			<div class="form-group">
				@php
				$__f10 = ['name' => 'location_id', 'value' => __('purchase.business_location').':*'];
				@endphp
				<x-form.label :name="$__f10['name']" :value="$__f10['value']" />
				@show_tooltip(__('tooltip.purchase_location'))
				@php
				$__f11 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => $default_location, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
				@endphp
				<x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
			</div>
		</div>

		<!-- Currency Exchange Rate -->
		<div class="col-sm-3 @if(!$currency_details->purchase_in_diff_currency) hide @endif">
			<div class="form-group">
				@php
				$__f12 = ['name' => 'exchange_rate', 'value' => __('purchase.p_exchange_rate') . ':*'];
				@endphp
				<x-form.label :name="$__f12['name']" :value="$__f12['value']" />
				@show_tooltip(__('tooltip.currency_exchange_factor'))
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-info"></i>
					</span>
					@php
					$__f13 = ['name' => 'exchange_rate', 'value' => $currency_details->p_exchange_rate, 'options' => ['class' => 'form-control', 'required', 'step' => 0.001]];
					@endphp
					<x-form.input type="number" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
				</div>
				<span class="help-block text-danger">
					@lang('purchase.diff_purchase_currency_help', ['currency' => $currency_details->name])
				</span>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<div class="multi-input">
					@php
					$__f14 = ['name' => 'pay_term_number', 'value' => __('contact.pay_term') . ':'];
					@endphp
					<x-form.label :name="$__f14['name']" :value="$__f14['value']" /> @show_tooltip(__('tooltip.pay_term'))
					<br/>
					@php
					$__f15 = ['name' => 'pay_term_number', 'value' => null, 'options' => ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]];
					@endphp
					<x-form.input type="number" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />

					@php
					$__f16 = ['name' => 'pay_term_type', 'list' => ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], 'selected' => null, 'options' => ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select'), 'id' => 'pay_term_type']];
					@endphp
					<x-form.select :name="$__f16['name']" :list="$__f16['list']" :selected="$__f16['selected']" :options="$__f16['options']" />
				</div>
			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				@php
				$__f17 = ['name' => 'document', 'value' => __('purchase.attach_document') . ':'];
				@endphp
				<x-form.label :name="$__f17['name']" :value="$__f17['value']" />
				@php
				$__f18 = ['name' => 'document', 'options' => ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]];
				@endphp
				<x-form.input type="file" :name="$__f18['name']" :options="$__f18['options']" />
				<p class="help-block">
					@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
					@includeIf('components.document_help_text')
				</p>
			</div>
		</div>
	</div>
	@endcomponent

	@component('components.widget', ['class' => 'box-primary'])
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-search"></i>
					</span>
					@php
					$__f19 = ['name' => 'search_product', 'value' => null, 'options' => ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'disabled' => $search_disable]];
					@endphp
					<x-form.input type="text" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
				</div>
			</div>
		</div>
		<div class="col-sm-2">
			<div class="form-group">
				<button tabindex="-1" type="button" class="btn btn-link btn-modal"data-href="{{action('ProductController@quickAdd')}}" 
				data-container=".quick_add_product_modal"><i class="fa fa-plus"></i> Novo produto </button>
			</div>
		</div>
	</div>
	@php
	$hide_tax = '';
	if( session()->get('business.enable_inline_tax') == 0){
		$hide_tax = 'hide';
	}
	@endphp
	<div class="row">
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-condensed table-bordered table-th-green text-center table-striped" id="purchase_entry_table">
					<thead>
						<tr>
							<th>#</th>
							<th>@lang( 'product.product_name' )</th>
							<th>@lang( 'purchase.purchase_quantity' )</th>
							<th>@lang( 'lang_v1.unit_cost_before_discount' )</th>
							<th>@lang( 'lang_v1.discount_percent' )</th>
							<th>@lang( 'purchase.unit_cost_before_tax' )</th>
							<th class="{{$hide_tax}}">@lang( 'purchase.subtotal_before_tax' )</th>
							<th class="{{$hide_tax}}">@lang( 'purchase.product_tax' )</th>
							<th class="{{$hide_tax}}">@lang( 'purchase.net_cost' )</th>
							<th>@lang( 'purchase.line_total' )</th>
							<th class="@if(!session('business.enable_editing_product_from_purchase')) hide @endif">
								@lang( 'lang_v1.profit_margin' )
							</th>
							<th>
								@lang( 'purchase.unit_selling_price' )
								<small>(@lang('product.inc_of_tax'))</small>
							</th>
							@if(session('business.enable_lot_number'))
							<th>
								@lang('lang_v1.lot_number')
							</th>
							@endif
							@if(session('business.enable_product_expiry'))
							<th>
								@lang('product.mfg_date') / @lang('product.exp_date')
							</th>
							@endif
							<th><i class="fa fa-trash" aria-hidden="true"></i></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<hr/>
			<div class="pull-right col-md-5">
				<table class="pull-right col-md-12">
					<tr>
						<th class="col-md-7 text-right">@lang( 'lang_v1.total_items' ):</th>
						<td class="col-md-5 text-left">
							<span id="total_quantity" class="display_currency" data-currency_symbol="false"></span>
						</td>
					</tr>
					<tr class="hide">
						<th class="col-md-7 text-right">@lang( 'purchase.total_before_tax' ):</th>
						<td class="col-md-5 text-left">
							<span id="total_st_before_tax" class="display_currency"></span>
							<input type="hidden" id="st_before_tax_input" value=0>
						</td>
					</tr>
					<tr>
						<th class="col-md-7 text-right">@lang( 'purchase.net_total_amount' ):</th>
						<td class="col-md-5 text-left">
							<span id="total_subtotal" class="display_currency"></span>
							<!-- This is total before purchase tax-->
							<input type="hidden" id="total_subtotal_input" value=0  name="total_before_tax">
						</td>
					</tr>
				</table>
			</div>

			<input type="hidden" id="row_count" value="0">
		</div>
	</div>
	@endcomponent

	@component('components.widget', ['class' => 'box-primary'])
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
				<tr>
					<td class="col-md-3">
						<div class="form-group">
							@php
							$__f20 = ['name' => 'discount_type', 'value' => __( 'purchase.discount_type' ) . ':'];
							@endphp
							<x-form.label :name="$__f20['name']" :value="$__f20['value']" />
							@php
							$__f21 = ['name' => 'discount_type', 'list' => [ '' => __('lang_v1.none'), 'fixed' => __( 'lang_v1.fixed' ), 'percentage' => __( 'lang_v1.percentage' )], 'selected' => '', 'options' => ['class' => 'form-control select2']];
							@endphp
							<x-form.select :name="$__f21['name']" :list="$__f21['list']" :selected="$__f21['selected']" :options="$__f21['options']" />
						</div>
					</td>
					<td class="col-md-3">
						<div class="form-group">
							@php
							$__f22 = ['name' => 'discount_amount', 'value' => __( 'purchase.discount_amount' ) . ':'];
							@endphp
							<x-form.label :name="$__f22['name']" :value="$__f22['value']" />
							@php
							$__f23 = ['name' => 'discount_amount', 'value' => 0, 'options' => ['class' => 'form-control input_number', 'required']];
							@endphp
							<x-form.input type="text" :name="$__f23['name']" :value="$__f23['value']" :options="$__f23['options']" />
						</div>
					</td>
					<td class="col-md-3">
						&nbsp;
					</td>
					<td class="col-md-3">
						<b>@lang( 'purchase.discount' ):</b>(-) 
						<span id="discount_calculated_amount" class="display_currency">0</span>
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group">
							@php
							$__f24 = ['name' => 'tax_id', 'value' => __('purchase.purchase_tax') . ':'];
							@endphp
							<x-form.label :name="$__f24['name']" :value="$__f24['value']" />
							<select name="tax_id" id="tax_id" class="form-control select2" placeholder="'Please Select'">
								<option value="" data-tax_amount="0" data-tax_type="fixed" selected>@lang('lang_v1.none')</option>
								@foreach($taxes as $tax)
								<option value="{{ $tax->id }}" data-tax_amount="{{ $tax->amount }}" data-tax_type="{{ $tax->calculation_type }}">{{ $tax->name }}</option>
								@endforeach
							</select>
							@php
							$__f25 = ['name' => 'tax_amount', 'value' => 0, 'options' => ['id' => 'tax_amount']];
							@endphp
							<x-form.input type="hidden" :name="$__f25['name']" :value="$__f25['value']" :options="$__f25['options']" />
						</div>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
						<b>@lang( 'purchase.purchase_tax' ):</b>(+) 
						<span id="tax_calculated_amount" class="display_currency">0</span>
					</td>
				</tr>

				<tr>
					<td>
						<div class="form-group">
							@php
							$__f26 = ['name' => 'shipping_details', 'value' => __( 'purchase.shipping_details' ) . ':'];
							@endphp
							<x-form.label :name="$__f26['name']" :value="$__f26['value']" />
							@php
							$__f27 = ['name' => 'shipping_details', 'value' => null, 'options' => ['class' => 'form-control']];
							@endphp
							<x-form.input type="text" :name="$__f27['name']" :value="$__f27['value']" :options="$__f27['options']" />
						</div>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
						<div class="form-group">
							@php
							$__f28 = ['name' => 'shipping_charges', 'value' => '(+) ' . __( 'purchase.additional_shipping_charges' ) . ':'];
							@endphp
							<x-form.label :name="$__f28['name']" :value="$__f28['value']" />
							@php
							$__f29 = ['name' => 'shipping_charges', 'value' => 0, 'options' => ['class' => 'form-control input_number', 'required']];
							@endphp
							<x-form.input type="text" :name="$__f29['name']" :value="$__f29['value']" :options="$__f29['options']" />
						</div>
					</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
						@php
						$__f30 = ['name' => 'final_total', 'value' => 0, 'options' => ['id' => 'grand_total_hidden']];
						@endphp
						<x-form.input type="hidden" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
						<b>@lang('purchase.purchase_total'): </b><span id="grand_total" class="display_currency" data-currency_symbol='true'>0</span>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="form-group">
							@php
							$__f31 = ['name' => 'additional_notes', 'value' => __('purchase.additional_notes')];
							@endphp
							<x-form.label :name="$__f31['name']" :value="$__f31['value']" />
							@php
							$__f32 = ['name' => 'additional_notes', 'value' => null, 'options' => ['class' => 'form-control', 'rows' => 3]];
							@endphp
							<x-form.textarea :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
						</div>
					</td>
				</tr>

			</table>
		</div>
	</div>
	@endcomponent

	@component('components.widget', ['class' => 'box-primary', 'title' => 'Adicionar fatura'])
	<div class="box-body payment_row">
		<div class="row">

			<div class="col-md-3">
				<div class="form-group">
					@php
					$__f33 = ['name' => "vencimento", 'value' => 'Vencimento:*'];
					@endphp
					<x-form.label :name="$__f33['name']" :value="$__f33['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
						@php
						$__f34 = ['name' => "vencimento", 'value' => '', 'options' => ['class' => 'form-control payment-vencimento', '', 'id' => "vencimento", 'required', 'placeholder' => 'Vencimento', 'data-mask="00/00/0000"', 'data-mask-reverse="true"']];
						@endphp
						<x-form.input type="text" :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />

					</div>
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					@php
					$__f35 = ['name' => "valor", 'value' => 'Valor:*'];
					@endphp
					<x-form.label :name="$__f35['name']" :value="$__f35['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-dollar-sign"></i>
						</span>
						@php
						$__f36 = ['name' => "valor_parcela", 'value' => '', 'options' => ['class' => 'form-control', '', 'id' => "valor_parcela", 'required', 'placeholder' => 'Valor', 'data-mask="00000000,00"', 'data-mask-reverse="true"']];
						@endphp
						<x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />

					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					@php
					$__f37 = ['name' => "forma_pagamento", 'value' => 'Forma de pagamento' . ':*'];
					@endphp
					<x-form.label :name="$__f37['name']" :value="$__f37['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fas fa-list"></i>
						</span>
						@php
						$__f38 = ['name' => "forma_pagamento", 'list' => $payment_types, 'selected' => null, 'options' => ['class' => 'form-control col-md-12 payment_types_dropdown', 'required', 'id' => "forma_pagamento", 'style' => 'width:100%;']];
						@endphp
						<x-form.select :name="$__f38['name']" :list="$__f38['list']" :selected="$__f38['selected']" :options="$__f38['options']" />
					</div>
				</div>
			</div>

			<div class="col-md-2">
				<br>
				<button type="button" id="btn-add-fatura" class="btn btn-link btn-modal" style="margin-top: 3px;"><i class="fa fa-check"></i> Adicionar</button>
			</div>
		</div>

		<div class="row">
			<table class="table" id="tbl-fatura">
				<thead>
					<tr>
						<th>Vencimento</th>
						<th>Valor</th>
						<th>Forma pagamento</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div class="pull-right"><strong>Valor do pagamento:</strong> <span id="payment_due">0.00</span></div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12">
				<button type="button" id="submit_purchase_form" class="btn btn-primary pull-right btn-flat">@lang('messages.save')</button>
			</div>
		</div>
	</div>
	@endcomponent

	<x-form.close />
</section>
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	@include('contact.create', ['quick_add' => true])
</div>
<!-- /.content -->
@endsection

@section('javascript')
<script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
@include('purchase.partials.keyboard_shortcuts')
@endsection
