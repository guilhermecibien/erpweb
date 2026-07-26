<div class="row">
	<div class="col-sm-12">
		@forelse($locations as $key => $value)
		<div class="box box-solid">
			<div class="box-header">
	            <h3 class="box-title">@lang('sale.location'): {{$value}}</h3>
	        </div>
			<div class="box-body">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-condensed table-bordered table-th-green text-center table-striped add_opening_stock_table">
								<thead>
								<tr>
									<th>@lang( 'product.product_name' )</th>
									<th>@lang( 'lang_v1.quantity_left' )</th>
									<th>@lang( 'purchase.unit_cost_before_tax' )</th>
									@if($enable_expiry == 1 && $product->enable_stock == 1)
										<th>Exp. Date</th>
									@endif
									@if($enable_lot == 1)
										<th>@lang( 'lang_v1.lot_number' )</th>
									@endif
									<th>@lang( 'purchase.subtotal_before_tax' )</th>
									<th>&nbsp;</th>
								</tr>
								</thead>
								<tbody>
@php
	$subtotal = 0;
@endphp
@foreach($product->variations as $variation)
	@if(empty($purchases[$key][$variation->id]))
		@php
			$purchases[$key][$variation->id][] = ['quantity' => 0, 
			'purchase_price' => $variation->default_purchase_price,
			'purchase_line_id' => null,
			'lot_number' => null
			]
		@endphp
	@endif

@foreach($purchases[$key][$variation->id] as $sub_key => $var)
	@php

	$purchase_line_id = $var['purchase_line_id'];

	$qty = $var['quantity'];

	$purcahse_price = $var['purchase_price'];

	$row_total = $qty * $purcahse_price;

	$subtotal += $row_total;
	$lot_number = $var['lot_number'];
	@endphp

<tr>
	<td>
		{{ $product->name }} @if( $product->type == 'variable' ) (<b>{{ $variation->product_variation->name }}</b> : {{ $variation->name }}) @endif

		@if(!empty($purchase_line_id))
			@php
			$__f1 = ['name' => 'stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][purchase_line_id]', 'value' => $purchase_line_id];
			@endphp
			<x-form.input type="hidden" :name="$__f1['name']" :value="$__f1['value']" />
		@endif
	</td>
	<td>
		<div class="input-group">
		  @php
		  $__f2 = ['name' => 'stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][quantity]', 'value' => number_format($qty, 2, ',', ''), 'options' => ['class' => 'form-control input-sm input_number purchase_quantity input_quantity', 'required', 'data-mask="0000000.00', 'data-mask-reverse="true"']];
		  @endphp
		  <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
		  <span class="input-group-addon">
		    {{ $product->unit->short_name }}
		  </span>
		</div>
	</td>
<td>
	@php
	$__f3 = ['name' => 'stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][purchase_price]', 'value' => number_format($purcahse_price, 2, ',', '.'), 'options' => ['class' => 'form-control input-sm input_number unit_price', 'required', 'data-mask="0000000.00"', 'data-mask-reverse="true"']];
	@endphp
	<x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
</td>

@if($enable_expiry == 1 && $product->enable_stock == 1)
	<td>
		@php
		$__f4 = ['name' => 'stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][exp_date]', 'value' => !empty($var['exp_date']) ? \Carbon::createFromTimestamp(strtotime($var['exp_date']))->format(session('business.date_format')) : null, 'options' => ['class' => 'form-control input-sm os_exp_date', 'readonly']];
		@endphp
		<x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
	</td>
@endif

@if($enable_lot == 1)
	<td>
		@php
		$__f5 = ['name' => 'stocks[' . $key . '][' . $variation->id . '][' . $sub_key . '][lot_number]', 'value' => $lot_number, 'options' => ['class' => 'form-control input-sm']];
		@endphp
		<x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
	</td>
@endif
	<td>
		<span class="row_subtotal_before_tax">{{@num_format($row_total)}}</span>
	</td>

	<td>
		@if($loop->index == 0)
			<button type="button" class="btn btn-primary btn-xs add_stock_row" data-sub-key="{{ count($purchases[$key][$variation->id])}}" 
				data-row-html='<tr>
					<td>
						{{ $product->name }} @if( $product->type == "variable" ) (<b>{{ $variation->product_variation->name }}</b> : {{ $variation->name }}) @endif
					</td>
					<td>
					<div class="input-group">
	              		<input class="form-control input-sm input_number purchase_quantity" required="" name="stocks[{{$key}}][{{$variation->id}}][__subkey__][quantity]" type="text" value="0">
			              <span class="input-group-addon">
			                {{ $product->unit->short_name }}
			              </span>
	        			</div>
					</td>
	<td>
		<input class="form-control input-sm input_number unit_price" required="" name="stocks[{{$key}}][{{$variation->id}}][__subkey__][purchase_price]" type="text" value="{{@num_format($purcahse_price)}}">
	</td>

	@if($enable_expiry == 1 && $product->enable_stock == 1)
	<td>
		<input class="form-control input-sm os_exp_date" required="" name="stocks[{{$key}}][{{$variation->id}}][__subkey__][exp_date]" type="text" readonly>
	</td>
	@endif

	@if($enable_lot == 1)
	<td>
		<input class="form-control input-sm" name="stocks[{{$key}}][{{$variation->id}}][__subkey__][lot_number]" type="text">
	</td>
	@endif

	<td>
		<span class="row_subtotal_before_tax">
			0.00
		</span>
	</td>
	<td>&nbsp;</td></tr>'
	><i class="fa fa-plus"></i></button>
	@else
		&nbsp;
	@endif
			</td>
			</tr>
		@endforeach
	@endforeach
								</tbody>
								<tfoot>
								<tr>
									<td colspan="@if($enable_expiry == 1 && $product->enable_stock == 1 && $enable_lot == 1) 5 @elseif(($enable_expiry == 1 && $product->enable_stock == 1) || $enable_lot == 1) @else 3 @endif"></td>
									<td><strong>@lang( 'lang_v1.total_amount_exc_tax' ): </strong> <span id="total_subtotal">{{@num_format($subtotal)}}</span>
									<input type="hidden" id="total_subtotal_hidden" value=0>
									</td>
								</tr>
								</tfoot>
						</table>
						
					</div>
				</div>
			</div>
		</div> <!--box end-->
		@empty
    		<h3>Produto não atribuído a nenhum local</h3>
		@endforelse
	</div>
</div>