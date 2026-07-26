<div class="payment_details_div @if( $payment_line->method !== 'card' ) {{ 'hide' }} @endif" data-type="card" >
	<div class="col-md-4">
		<div class="form-group">
			@php
			$__f1 = ['name' => "card_number", 'value' => __('lang_v1.card_no')];
			@endphp
			<x-form.label :name="$__f1['name']" :value="$__f1['value']" />
			@php
			$__f2 = ['name' => "card_number", 'value' => $payment_line->card_number, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.card_no')]];
			@endphp
			<x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			@php
			$__f3 = ['name' => "card_holder_name", 'value' => __('lang_v1.card_holder_name')];
			@endphp
			<x-form.label :name="$__f3['name']" :value="$__f3['value']" />
			@php
			$__f4 = ['name' => "card_holder_name", 'value' => $payment_line->card_holder_name, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.card_holder_name')]];
			@endphp
			<x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			@php
			$__f5 = ['name' => "card_transaction_number", 'value' => __('lang_v1.card_transaction_no')];
			@endphp
			<x-form.label :name="$__f5['name']" :value="$__f5['value']" />
			@php
			$__f6 = ['name' => "card_transaction_number", 'value' => $payment_line->card_transaction_number, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.card_transaction_no')]];
			@endphp
			<x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-3">
		<div class="form-group">
			@php
			$__f7 = ['name' => "card_type", 'value' => __('lang_v1.card_type')];
			@endphp
			<x-form.label :name="$__f7['name']" :value="$__f7['value']" />
			@php
			$__f8 = ['name' => "card_type", 'list' => ['credit' => 'Credit Card', 'debit' => 'Debit Card', 'visa' => 'Visa', 'master' => 'MasterCard'], 'selected' => $payment_line->card_type, 'options' => ['class' => 'form-control select2']];
			@endphp
			<x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			@php
			$__f9 = ['name' => "card_month", 'value' => __('lang_v1.month')];
			@endphp
			<x-form.label :name="$__f9['name']" :value="$__f9['value']" />
			@php
			$__f10 = ['name' => "card_month", 'value' => $payment_line->card_month, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.month') ]];
			@endphp
			<x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			@php
			$__f11 = ['name' => "card_year", 'value' => __('lang_v1.year')];
			@endphp
			<x-form.label :name="$__f11['name']" :value="$__f11['value']" />
			@php
			$__f12 = ['name' => "card_year", 'value' => $payment_line->card_year, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.year') ]];
			@endphp
			<x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			@php
			$__f13 = ['name' => "card_security", 'value' => __('lang_v1.security_code')];
			@endphp
			<x-form.label :name="$__f13['name']" :value="$__f13['value']" />
			@php
			$__f14 = ['name' => "card_security", 'value' => $payment_line->card_security, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.security_code')]];
			@endphp
			<x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="payment_details_div @if( $payment_line->method !== 'cheque' ) {{ 'hide' }} @endif" data-type="cheque" >
	<div class="col-md-12">
		<div class="form-group">
			@php
			$__f15 = ['name' => "cheque_number", 'value' => __('lang_v1.cheque_no')];
			@endphp
			<x-form.label :name="$__f15['name']" :value="$__f15['value']" />
			@php
			$__f16 = ['name' => "cheque_number", 'value' => $payment_line->cheque_number, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.cheque_no')]];
			@endphp
			<x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line->method !== 'bank_transfer' ) {{ 'hide' }} @endif" data-type="bank_transfer" >
	<div class="col-md-12">
		<div class="form-group">
			@php
			$__f17 = ['name' => "bank_account_number", 'value' => __('lang_v1.bank_account_number')];
			@endphp
			<x-form.label :name="$__f17['name']" :value="$__f17['value']" />
			@php
			$__f18 = ['name' => "bank_account_number", 'value' => $payment_line->bank_account_number, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.bank_account_number')]];
			@endphp
			<x-form.input type="text" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line->method !== 'custom_pay_1' ) {{ 'hide' }} @endif" data-type="custom_pay_1" >
	<div class="col-md-12">
		<div class="form-group">
			@php
			$__f19 = ['name' => "transaction_no_1", 'value' => __('lang_v1.transaction_no')];
			@endphp
			<x-form.label :name="$__f19['name']" :value="$__f19['value']" />
			@php
			$__f20 = ['name' => "transaction_no_1", 'value' => $payment_line->transaction_no, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no')]];
			@endphp
			<x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line->method !== 'custom_pay_2' ) {{ 'hide' }} @endif" data-type="custom_pay_2" >
	<div class="col-md-12">
		<div class="form-group">
			@php
			$__f21 = ['name' => "transaction_no_2", 'value' => __('lang_v1.transaction_no')];
			@endphp
			<x-form.label :name="$__f21['name']" :value="$__f21['value']" />
			@php
			$__f22 = ['name' => "transaction_no_2", 'value' => $payment_line->transaction_no, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no')]];
			@endphp
			<x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line->method !== 'custom_pay_3' ) {{ 'hide' }} @endif" data-type="custom_pay_3" >
	<div class="col-md-12">
		<div class="form-group">
			@php
			$__f23 = ['name' => "transaction_no_3", 'value' => __('lang_v1.transaction_no')];
			@endphp
			<x-form.label :name="$__f23['name']" :value="$__f23['value']" />
			@php
			$__f24 = ['name' => "transaction_no_3", 'value' => $payment_line->transaction_no, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no')]];
			@endphp
			<x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
		</div>
	</div>
</div>