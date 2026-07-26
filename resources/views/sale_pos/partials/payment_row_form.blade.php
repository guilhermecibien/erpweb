<div class="row">
	<input type="hidden" class="payment_row_index" value="{{$row_index}}">
	@php
		$col_class = 'col-md-6';
		if(!empty($accounts)){
			$col_class = 'col-md-4';
		}
	@endphp
	<div class="{{$col_class}}">
		<div class="form-group">
			@php
			$__f1 = ['name' => "amount_$row_index", 'value' => 'Valor' . ':*'];
			@endphp
			<x-form.label :name="$__f1['name']" :value="$__f1['value']" />
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fas fa-money-bill-alt"></i>
				</span>
				@php
				$__f2 = ['name' => "payment[$row_index][amount]", 'value' => number_format($payment_line['amount'], 2, ',', '.'), 'options' => ['class' => 'form-control payment-amount input_number', 'required', 'id' => "amount_$row_index", 'placeholder' => __('sale.amount')]];
				@endphp
				<x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
			</div>
		</div>
	</div>
	<div class="{{$col_class}}">
		<div class="form-group">
			@php
			$__f3 = ['name' => "method_$row_index", 'value' => 'Forma de pagamento' . ':*'];
			@endphp
			<x-form.label :name="$__f3['name']" :value="$__f3['value']" />
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fas fa-list"></i>
				</span>
				@php
				$__f4 = ['name' => "payment[$row_index][method]", 'list' => $payment_types, 'selected' => $payment_line['method'], 'options' => ['class' => 'form-control col-md-12 payment_types_dropdown', 'required', 'id' => "method_$row_index", 'style' => 'width:100%;']];
				@endphp
				<x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
			</div>
		</div>
	</div>
	<div class="{{$col_class}}">
		<div class="form-group">
			@php
			$__f5 = ['name' => "vencimento_$row_index", 'value' => 'Vencimento:*'];
			@endphp
			<x-form.label :name="$__f5['name']" :value="$__f5['value']" />
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-calendar"></i>
				</span>
				@php
				$__f6 = ['name' => "payment[$row_index][vencimento]", 'value' => $payment_line['vencimento'], 'options' => ['class' => 'form-control payment-vencimento', '', 'id' => "payment_$row_index", 'required', 'placeholder' => 'Vencimento', 'data-mask="00/00/0000"', 'data-mask-reverse="true"']];
				@endphp
				<x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />

			</div>
		</div>
	</div>
	
	@if(!empty($accounts))
		<div class="{{$col_class}}">
			<div class="form-group">
				@php
				$__f7 = ['name' => "account_$row_index", 'value' => __('lang_v1.payment_account') . ':'];
				@endphp
				<x-form.label :name="$__f7['name']" :value="$__f7['value']" />
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fas fa-money-bill-alt"></i>
					</span>
					@php
					$__f8 = ['name' => "payment[$row_index][account_id]", 'list' => $accounts, 'selected' => !empty($payment_line['account_id']) ? $payment_line['account_id'] : '', 'options' => ['class' => 'form-control select2', 'id' => "account_$row_index", 'style' => 'width:100%;']];
					@endphp
					<x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
				</div>
			</div>
		</div>
	@endif
	<div class="clearfix"></div>
		@include('sale_pos.partials.payment_type_details')
	<div class="col-md-12">
		<div class="form-group">
			@php
			$__f9 = ['name' => "note_$row_index", 'value' => 'Observação de pagamento:'];
			@endphp
			<x-form.label :name="$__f9['name']" :value="$__f9['value']" />
			@php
			$__f10 = ['name' => "payment[$row_index][note]", 'value' => $payment_line['note'], 'options' => ['class' => 'form-control', 'rows' => 3, 'id' => "note_$row_index"]];
			@endphp
			<x-form.textarea :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
		</div>
	</div>
</div>