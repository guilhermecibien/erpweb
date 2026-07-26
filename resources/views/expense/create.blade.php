@extends('layouts.app')
@section('title', 'Adicionar conta a pagar')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Nova conta a pagar</h1>
</section>

<!-- Main content -->
<section class="content">
	@php
	$__f1 = ['options' => ['url' => action('ExpenseController@store'), 'method' => 'post', 'id' => 'add_expense_form', 'files' => true ]];
	@endphp
	<x-form.open :options="$__f1['options']" />
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">

				@if(count($business_locations) == 1)
				@php 
				$default_location = current(array_keys($business_locations->toArray())) 
				@endphp
				@else
				@php $default_location = null; @endphp
				@endif
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f2 = ['name' => 'location_id', 'value' => __('purchase.business_location').':*'];
						@endphp
						<x-form.label :name="$__f2['name']" :value="$__f2['value']" />
						@php
						$__f3 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => $default_location, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
						@endphp
						<x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						@php
						$__f4 = ['name' => 'supplier_id', 'value' => __('purchase.supplier') . ':*'];
						@endphp
						<x-form.label :name="$__f4['name']" :value="$__f4['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-user"></i>
							</span>
							@php
							$__f5 = ['name' => 'contact_id', 'list' => [], 'selected' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'supplier_id']];
							@endphp
							<x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
							<span class="input-group-btn">
								<button type="button" class="btn btn-default bg-white btn-flat add_new_supplier" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
							</span>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f6 = ['name' => 'expense_category_id', 'value' => 'Categoria:'];
						@endphp
						<x-form.label :name="$__f6['name']" :value="$__f6['value']" />
						@php
						$__f7 = ['name' => 'expense_category_id', 'list' => $expense_categories, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]];
						@endphp
						<x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f8 = ['name' => 'ref_no', 'value' => __('purchase.ref_no').':'];
						@endphp
						<x-form.label :name="$__f8['name']" :value="$__f8['value']" />
						@php
						$__f9 = ['name' => 'ref_no', 'value' => null, 'options' => ['class' => 'form-control']];
						@endphp
						<x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f10 = ['name' => 'transaction_date', 'value' => __('messages.date') . ':*'];
						@endphp
						<x-form.label :name="$__f10['name']" :value="$__f10['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							@php
							$__f11 = ['name' => 'transaction_date', 'value' => \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . (session('business.time_format') == 24 ? 'H:i' : 'h:i A')), 'options' => ['class' => 'form-control', 'readonly', 'required', 'id' => 'expense_transaction_date']];
							@endphp
							<x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f12 = ['name' => 'expense_for', 'value' => 'Conta para:'];
						@endphp
						<x-form.label :name="$__f12['name']" :value="$__f12['value']" /> @show_tooltip('Escolha o usuário para quem a conta está relacionada. (opcional)')
						@php
						$__f13 = ['name' => 'expense_for', 'list' => $users, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]];
						@endphp
						<x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						@php
						$__f14 = ['name' => 'document', 'value' => 'Documento anexo' . ':'];
						@endphp
						<x-form.label :name="$__f14['name']" :value="$__f14['value']" />
						@php
						$__f15 = ['name' => 'document', 'options' => ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]];
						@endphp
						<x-form.input type="file" :name="$__f15['name']" :options="$__f15['options']" />
						<p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
						@includeIf('components.document_help_text')</p>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						@php
						$__f16 = ['name' => 'additional_notes', 'value' => 'Observação' . ':'];
						@endphp
						<x-form.label :name="$__f16['name']" :value="$__f16['value']" />
						@php
						$__f17 = ['name' => 'additional_notes', 'value' => null, 'options' => ['class' => 'form-control', 'rows' => 3]];
						@endphp
						<x-form.textarea :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-4">
					<div class="form-group">
						@php
						$__f18 = ['name' => 'tax_id', 'value' => __('product.applicable_tax') . ':'];
						@endphp
						<x-form.label :name="$__f18['name']" :value="$__f18['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-info"></i>
							</span>
							@php
							$__f19 = ['name' => 'tax_id', 'list' => $taxes['tax_rates'], 'selected' => null, 'options' => ['class' => 'form-control'], 'optionsAttributes' => $taxes['attributes']];
							@endphp
							<x-form.select :name="$__f19['name']" :list="$__f19['list']" :selected="$__f19['selected']" :options="$__f19['options']" :options-attributes="$__f19['optionsAttributes']" />

							<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
							value="0">
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						@php
						$__f20 = ['name' => 'final_total', 'value' => __('sale.total_amount') . ':*'];
						@endphp
						<x-form.label :name="$__f20['name']" :value="$__f20['value']" />
						@php
						$__f21 = ['name' => 'final_total', 'value' => null, 'options' => ['class' => 'form-control input_number', 'placeholder' => __('sale.total_amount'), 'required']];
						@endphp
						<x-form.input type="text" :name="$__f21['name']" :value="$__f21['value']" :options="$__f21['options']" />
					</div>
				</div>
			</div>
		</div>
	</div> <!--box end-->
	@component('components.widget', ['class' => 'box-primary', 'id' => "payment_rows_div", 'title' => __('purchase.add_payment')])
	<div class="payment_row">
		@include('sale_pos.partials.payment_row_form', ['row_index' => 0])
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div class="pull-right">
					<strong>Valor total:</strong>
					<span id="payment_due">{{@num_format(0)}}</span>
				</div>
			</div>
		</div>
	</div>
	@endcomponent
	<div class="col-sm-12">
		<button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
	</div>
	<x-form.close />
</section>

<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	@include('contact.create', ['quick_add' => true])
</div>
@endsection
@section('javascript')
<script type="text/javascript">
	$(document).on('change', 'input#final_total, input.payment-amount', function() {
		calculateExpensePaymentDue();
	});

	function calculateExpensePaymentDue() {
		var final_total = __read_number($('input#final_total'));
		var payment_amount = __read_number($('input.payment-amount'));
		var payment_due = final_total - payment_amount;
		$('#payment_due').text(__currency_trans_from_en(payment_due, true, false));
	}
</script>
<script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>

@endsection