@extends('layouts.app')
@section('title', 'Receber conta')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Receber conta</h1>
</section>

<!-- Main content -->
<section class="content">
	@php
	$__f1 = ['options' => ['url' => action('RevenueController@receivePut', [$item->id]), 'method' => 'put', 'id' => 'add_form', 'files' => true ]];
	@endphp
	<x-form.open :options="$__f1['options']" />
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">

				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f2 = ['name' => "tipo_pagamento", 'value' => 'Forma de pagamento' . ':*'];
						@endphp
						<x-form.label :name="$__f2['name']" :value="$__f2['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fas fa-list"></i>
							</span>
							@php
							$__f3 = ['name' => "tipo_pagamento", 'list' => $payment_types, 'selected' => $item->forma_pagamento, 'options' => ['class' => 'form-control col-md-12 payment_types_dropdown', 'required', 'id' => "forma_pagamento", 'style' => 'width:100%;']];
							@endphp
							<x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						@php
						$__f4 = ['name' => 'vencimento', 'value' => 'Vencimento:*'];
						@endphp
						<x-form.label :name="$__f4['name']" :value="$__f4['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							@php
							$__f5 = ['name' => 'vencimento', 'value' => \Carbon\Carbon::parse($item->vencimento)->format('d/m/Y'), 'options' => ['class' => 'form-control', 'disabled', 'required', 'id' => '']];
							@endphp
							<x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
						</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">
						@php
						$__f6 = ['name' => 'recebimento', 'value' => 'Recebimento:*'];
						@endphp
						<x-form.label :name="$__f6['name']" :value="$__f6['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							@php
							$__f7 = ['name' => 'recebimento', 'value' => \Carbon\Carbon::parse($item->vencimento)->format('d/m/Y'), 'options' => ['class' => 'form-control', 'readonly', 'required', 'id' => 'vencimento']];
							@endphp
							<x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
						</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">

						@php
						$__f8 = ['name' => 'final_total', 'value' => __('sale.total_amount') . ':*'];
						@endphp
						<x-form.label :name="$__f8['name']" :value="$__f8['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-tag"></i>
							</span>
							@php
							$__f9 = ['name' => 'final_total', 'value' => number_format($item->valor_total,2), 'options' => ['class' => 'form-control input_number money', 'readonly', 'placeholder' => __('sale.total_amount'), 'required']];
							@endphp
							<x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
						</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="form-group">

						@php
						$__f10 = ['name' => 'valor_recebido', 'value' => 'Valor recebido:*'];
						@endphp
						<x-form.label :name="$__f10['name']" :value="$__f10['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-tag"></i>
							</span>
							@php
							$__f11 = ['name' => 'valor_recebido', 'value' => number_format($item->valor_total,2), 'options' => ['class' => 'form-control input_number money', 'placeholder' => __('sale.total_amount'), 'required']];
							@endphp
							<x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
						</div>
					</div>
				</div>
				

			</div>
		</div>
	</div> <!--box end-->
	<div class="col-sm-12">
		<button type="submit" id="submit_button" class="btn btn-primary pull-right">Receber</button>
	</div>
	<x-form.close />

</section>

@endsection


@section('javascript')
<script type="text/javascript">


</script>
@endsection