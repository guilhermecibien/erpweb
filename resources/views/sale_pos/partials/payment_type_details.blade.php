<div class="payment_details_div @if( $payment_line['method'] !== 'card' ) {{ 'hide' }} @endif" data-type="card" >
	<div class="col-md-4">
		<div class="form-group">
			@php
			$__f1 = ['name' => "card_number_$row_index", 'value' => __('lang_v1.card_no')];
			@endphp
			<x-form.label :name="$__f1['name']" :value="$__f1['value']" />
			@php
			$__f2 = ['name' => "payment[$row_index][card_number]", 'value' => $payment_line['card_number'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.card_no'), 'id' => "card_number_$row_index"]];
			@endphp
			<x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			@php
			$__f3 = ['name' => "card_holder_name_$row_index", 'value' => 'CNPJ'];
			@endphp
			<x-form.label :name="$__f3['name']" :value="$__f3['value']" />
			@php
			$__f4 = ['name' => "payment[$row_index][card_holder_name]", 'value' => $payment_line['card_holder_name'], 'options' => ['class' => 'form-control', 'placeholder' => 'CNPJ', 'id' => "card_holder_name_$row_index"]];
			@endphp
			<x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			@php
			$__f5 = ['name' => "card_transaction_number_$row_index", 'value' => 'Código de autorização'];
			@endphp
			<x-form.label :name="$__f5['name']" :value="$__f5['value']" />
			@php
			$__f6 = ['name' => "payment[$row_index][card_transaction_number]", 'value' => $payment_line['card_transaction_number'], 'options' => ['class' => 'form-control', 'placeholder' => 'Código de autorização', 'id' => "card_transaction_number_$row_index"]];
			@endphp
			<x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
		</div>
	</div>

	
	<!-- <div class="clearfix"></div> -->
	<div class="col-md-3">
		<div class="form-group">
			@php
			$__f7 = ['name' => "card_type_$row_index", 'value' => __('lang_v1.card_type')];
			@endphp
			<x-form.label :name="$__f7['name']" :value="$__f7['value']" />
			@php
			$__f8 = ['name' => "payment[$row_index][card_type]", 'list' => ['credit' => 'Crédito', 'debit' => 'Débito'], 'selected' => $payment_line['card_type'], 'options' => ['class' => 'form-control', 'id' => "card_type_$row_index" ]];
			@endphp
			<x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			@php
			$__f9 = ['name' => "card_security", 'value' => "Bandeira"];
			@endphp
			<x-form.label :name="$__f9['name']" :value="$__f9['value']" />

			@php
			$__f10 = ['name' => "payment[$row_index][card_security]", 'list' => App\Models\Transaction::bandeiras(), 'selected' => 'card_security', 'options' => ['class' => 'form-control select2', 'id' => "card_security", 'style="width: 100%"']];
			@endphp
			<x-form.select :name="$__f10['name']" :list="$__f10['list']" :selected="$__f10['selected']" :options="$__f10['options']" />
		</div>
	</div>
	<div class="col-md-3" style="visibility: hidden;">
		<div class="form-group">
			@php
			$__f11 = ['name' => "card_month_$row_index", 'value' => __('lang_v1.month')];
			@endphp
			<x-form.label :name="$__f11['name']" :value="$__f11['value']" />
			@php
			$__f12 = ['name' => "payment[$row_index][card_month]", 'value' => $payment_line['card_month'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.month'), 'id' => "card_month_$row_index" ]];
			@endphp
			<x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
		</div>
	</div>
	<div class="col-md-3" style="visibility: hidden;">
		<div class="form-group">
			@php
			$__f13 = ['name' => "card_year_$row_index", 'value' => __('lang_v1.year')];
			@endphp
			<x-form.label :name="$__f13['name']" :value="$__f13['value']" />
			@php
			$__f14 = ['name' => "payment[$row_index][card_year]", 'value' => $payment_line['card_year'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.year'), 'id' => "card_year_$row_index" ]];
			@endphp
			<x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
		</div>
	</div>
	
	<div class="clearfix"></div>
</div>



<div class="payment_details_div @if( $payment_line['method'] !== 'cheque' ) {{ 'hide' }} @endif" data-type="cheque" >
	<div class="col-md-12">
		<div class="form-group">
			@php
			$__f15 = ['name' => "cheque_number_$row_index", 'value' => __('lang_v1.cheque_no')];
			@endphp
			<x-form.label :name="$__f15['name']" :value="$__f15['value']" />
			@php
			$__f16 = ['name' => "payment[$row_index][cheque_number]", 'value' => $payment_line['cheque_number'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.cheque_no'), 'id' => "cheque_number_$row_index"]];
			@endphp
			<x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
		</div>
	</div>
</div>

<div class="payment_details_div @if( $payment_line['method'] !== 'bank_transfer' ) {{ 'hide' }} @endif" data-type="bank_transfer" >
	<div class="col-md-12">
		<div class="form-group">
			@php
			$__f17 = ['name' => "bank_account_number_$row_index", 'value' => __('lang_v1.bank_account_number')];
			@endphp
			<x-form.label :name="$__f17['name']" :value="$__f17['value']" />
			@php
			$__f18 = ['name' => "payment[$row_index][bank_account_number]", 'value' => $payment_line['bank_account_number'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.bank_account_number'), 'id' => "bank_account_number_$row_index"]];
			@endphp
			<x-form.input type="text" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
		</div>
	</div>
</div>

<div class="payment_details_div @if( $payment_line['method'] !== 'custom_pay_1' ) {{ 'hide' }} @endif" data-type="custom_pay_1" >
	<div class="col-md-12">
		<div class="form-group">
			@php
			$__f19 = ['name' => "transaction_no_1_$row_index", 'value' => __('lang_v1.transaction_no')];
			@endphp
			<x-form.label :name="$__f19['name']" :value="$__f19['value']" />
			@php
			$__f20 = ['name' => "payment[$row_index][transaction_no_1]", 'value' => $payment_line['transaction_no'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no'), 'id' => "transaction_no_1_$row_index"]];
			@endphp
			<x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line['method'] !== 'custom_pay_2' ) {{ 'hide' }} @endif" data-type="custom_pay_2" >
	<div class="col-md-12">
		<div class="form-group">
			@php
			$__f21 = ['name' => "transaction_no_2_$row_index", 'value' => __('lang_v1.transaction_no')];
			@endphp
			<x-form.label :name="$__f21['name']" :value="$__f21['value']" />
			@php
			$__f22 = ['name' => "payment[$row_index][transaction_no_2]", 'value' => $payment_line['transaction_no'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no'), 'id' => "transaction_no_2_$row_index"]];
			@endphp
			<x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
		</div>
	</div>
</div>
<div class="payment_details_div @if( $payment_line['method'] !== 'custom_pay_3' ) {{ 'hide' }} @endif" data-type="custom_pay_3" >
	<div class="col-md-12">
		<div class="form-group">
			@php
			$__f23 = ['name' => "transaction_no_3_$row_index", 'value' => __('lang_v1.transaction_no')];
			@endphp
			<x-form.label :name="$__f23['name']" :value="$__f23['value']" />
			@php
			$__f24 = ['name' => "payment[$row_index][transaction_no_3]", 'value' => $payment_line['transaction_no'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.transaction_no'), 'id' => "transaction_no_3_$row_index"]];
			@endphp
			<x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
		</div>
	</div>
</div>

<div class="payment_details_div @if( $payment_line['method'] !== 'boleto' ) {{ 'hide' }} @endif" data-type="boleto" >

	<div class="col-md-2">
		<div class="form-group">
			@php
			$__f25 = ['name' => "data_base_$row_index", 'value' => "Qtd parcelas"];
			@endphp
			<x-form.label :name="$__f25['name']" :value="$__f25['value']" />
			@php
			$__f26 = ['name' => "", 'value' => $payment_line['qtd_parcelas'], 'options' => ['class' => 'form-control', 'placeholder' => "Qtd parcelas", 'id' => "qtd_parcelas_$row_index", 'data-mask="00"', 'data-mask-reverse="true"']];
			@endphp
			<x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			@php
			$__f27 = ['name' => "data_base_$row_index", 'value' => "Data base parcelamento"];
			@endphp
			<x-form.label :name="$__f27['name']" :value="$__f27['value']" />
			@php
			$__f28 = ['name' => "", 'value' => $payment_line['data_base'], 'options' => ['class' => 'form-control', 'placeholder' => "Data base parcelamento", 'id' => "data_base_$row_index", 'data-mask="00/00/0000"', 'data-mask-reverse="true"']];
			@endphp
			<x-form.input type="tel" :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<br>
			<input onclick="diasClick({{$row_index}})" class="form-check-input" checked type="radio" name="flexRadioDefault" id="boleto_check_dias_{{$row_index}}">
			<label class="form-check-label" for="flexRadioDefault1">
				Dias fixos
			</label>
			<br>
			<input onclick="intervaloClick({{$row_index}})" class="form-check-input" type="radio" name="flexRadioDefault" id="boleto_check_intervalo_{{$row_index}}">
			<label class="form-check-label" for="flexRadioDefault1">
				Intervalo de dias
			</label>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			@php
			$__f29 = ['name' => "intervalo_$row_index", 'value' => "Intervalo"];
			@endphp
			<x-form.label :name="$__f29['name']" :value="$__f29['value']" />
			@php
			$__f30 = ['name' => "", 'value' => $payment_line['intervalo'], 'options' => ['class' => 'form-control', 'placeholder' => "", 'id' => "intervalo_$row_index", 'data-mask="000"', 'data-mask-reverse="true"', 'disabled']];
			@endphp
			<x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
		</div>
	</div>

	<div class="col-md-2">
		<br>
		<button onclick="gerarFatura()" style="margin-top: 3px;" type="button" class="btn bg-navy btn-default gerar-fatura" id="gerar_{{$row_index}}" title="Gerar">GERAR</button>
	</div>

	<div class="col-md-12">
		<table class="table table-bordered table-striped ajax_view" id="tbl_fatura">
			<thead>
				<tr>
					<th>Vencimento</th>
					<th>Documento</th>
					<th>Valor</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>


</div>

