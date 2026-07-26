<div class="row" id="quick_product_opening_stock_div">
	<div class="col-sm-12">
		<h4>@lang('lang_v1.add_opening_stock')</h4>
	</div>
	<div class="col-sm-12">
		<table class="table table-condensed table-th-green" id="quick_product_opening_stock_table">
			<thead>
			<tr>
				<th>@lang('sale.location')</th>
				<th>@lang( 'lang_v1.quantity' )</th>
				<th>@lang( 'purchase.unit_cost_before_tax' )</th>
				@if($enable_expiry)
					<th>@lang('lang_v1.expiry_date')</th>
				@endif
				@if($enable_lot)
					<th>@lang( 'lang_v1.lot_number' )</th>
				@endif
				<th>@lang( 'purchase.subtotal_before_tax' )</th>
			</tr>
			</thead>
			<tbody>
		@foreach($locations as $key => $value)
			<tr>
				<td>{{$value}}</td>
				<td>@php
				<td>$__f1 = ['name' => 'opening_stock[' . $key . '][quantity]', 'value' => 0, 'options' => ['class' => 'form-control input-sm input_number purchase_quantity', 'required']];
				<td>@endphp
				<td><x-form.input type="text" :name="$__f1['name']" :value="$__f1['value']" :options="$__f1['options']" /></td>
				<td>@php
				<td>$__f2 = ['name' => 'opening_stock[' . $key . '][purchase_price]', 'value' => null, 'options' => ['class' => 'form-control input-sm input_number unit_price', 'required']];
				<td>@endphp
				<td><x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" /></td>
				@if($enable_expiry)
					<td>
						@php
						$__f3 = ['name' => 'opening_stock[' . $key . '][exp_date]', 'value' => null, 'options' => ['class' => 'form-control input-sm os_exp_date', 'readonly']];
						@endphp
						<x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
					</td>
				@endif
				@if($enable_lot)
					<td>
						@php
						$__f4 = ['name' => 'opening_stock[' . $key . '][lot_number]', 'value' => null, 'options' => ['class' => 'form-control input-sm']];
						@endphp
						<x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
					</td>
				@endif
				<td>
					<span class="row_subtotal_before_tax">0</span>
				</td>
			</tr>
		@endforeach
		</tbody>
		</table>
	</div>
</div>