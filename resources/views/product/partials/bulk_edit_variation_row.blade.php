<td>
	@if($product->type == 'variable')
		{{ $variation->product_variation->name}}
		- {{ $variation->name}} ({{ $variation->sub_sku}})
	@endif
</td>
<td>
<div class="input-group">
	<span class="input-group-addon"><small>@lang('product.exc_of_tax')</small></span>
	@php
	$__f1 = ['name' => 'products[' . $product->id . '][variations][' . $variation->id . '][default_purchase_price]', 'value' => number_format($variation->default_purchase_price, 2, ',', '.'), 'options' => ['placeholder' => __('product.exc_of_tax'), 'class' => 'form-control input-sm input_number pp_exc_tax']];
	@endphp
	<x-form.input type="text" :name="$__f1['name']" :value="$__f1['value']" :options="$__f1['options']" />
</div>
<div class="input-group">
	<span class="input-group-addon"><small>@lang('product.inc_of_tax')</small></span>
	@php
	$__f2 = ['name' => 'products[' . $product->id . '][variations][' . $variation->id . '][dpp_inc_tax]', 'value' => number_format($variation->dpp_inc_tax, 2, ',', '.'), 'options' => ['placeholder' => __('product.inc_of_tax'), 'class' => 'form-control input-sm input_number pp_inc_tax']];
	@endphp
	<x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" /></td>
</div>
<td>
	@php
	$__f3 = ['name' => 'products[' . $product->id . '][variations][' . $variation->id . '][profit_percent]', 'value' => number_format($variation->profit_percent, 2, ',', '.'), 'options' => ['class' => 'form-control input-sm input_number profit_percent']];
	@endphp
	<x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
</td>
<td>
	<div class="input-group">
		<span class="input-group-addon"><small>@lang('product.exc_of_tax')</small></span>
		@php
		$__f4 = ['name' => 'products[' . $product->id . '][variations][' . $variation->id . '][default_sell_price]', 'value' => number_format($variation->default_sell_price, 2, ',', '.'), 'options' => ['placeholder' => __('product.exc_of_tax'), 'class' => 'form-control input-sm input_number sp_exc_tax']];
		@endphp
		<x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
	</div>

	<div class="input-group">
		<span class="input-group-addon"><small>@lang('product.inc_of_tax')</small></span>
		@php
		$__f5 = ['name' => 'products[' . $product->id . '][variations][' . $variation->id . '][sell_price_inc_tax]', 'value' => number_format($variation->sell_price_inc_tax, 2, ',', '.'), 'options' => ['placeholder' => __('product.dpp_inc_tax'), 'class' => 'form-control input-sm input_number sp_inc_tax']];
		@endphp
		<x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
	</div>
</td>
<td style="text-align: left;">
	@foreach($price_groups as $k => $v)
		@php
			$price_grp = $variation->group_prices->filter(function($item) use($k) {
			    return $item->price_group_id == $k;
			})->first();
		@endphp
		<div class="input-group" style="width: 100%;">
			<span class="input-group-addon"><small>{{$v}} -</small></span>
			@php
			$__f6 = ['name' => 'products[' . $product->id . '][variations][' . $variation->id . '][group_prices][' . $k . ']', 'value' => !empty($price_grp) ? number_format($price_grp->price_inc_tax, 2, ',', '.') : 0, 'options' => ['class' => 'form-control input-sm input_number']];
			@endphp
			<x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
		</div>
	@endforeach
</td>