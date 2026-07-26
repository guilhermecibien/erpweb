<tbody class="product_rows" id="product_{{$product->id}}">
	<tr class="bg-green">
		<td>{{$product->name}} ({{$product->sku}})</td>
		<td>
			@php
			$__f1 = ['name' => 'products[' . $product->id . '][category_id]', 'list' => $categories, 'selected' => $product->category_id, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2 input-sm category_id', 'style' => 'width: 100%;']];
			@endphp
			<x-form.select :name="$__f1['name']" :list="$__f1['list']" :selected="$__f1['selected']" :options="$__f1['options']" />
		</td>
		<td>
			@php
			$__f2 = ['name' => 'products[' . $product->id . '][sub_category_id]', 'list' => !empty($sub_categories[$product->category_id]) ? $sub_categories[$product->category_id] : [], 'selected' => $product->sub_category_id, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2 input-sm sub_category_id', 'style' => 'width: 100%;']];
			@endphp
			<x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
		</td>
		<td>
			@php
			$__f3 = ['name' => 'products[' . $product->id . '][brand_id]', 'list' => $brands, 'selected' => $product->brand_id, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2 input-sm', 'style' => 'width: 100%;']];
			@endphp
			<x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
		</td>
		<td>
			@php
			$__f4 = ['name' => 'products[' . $product->id . '][tax]', 'list' => $taxes, 'selected' => $product->tax, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2 input-sm row_tax', 'style' => 'width: 100%;'], 'optionsAttributes' => $tax_attributes];
			@endphp
			<x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" :options-attributes="$__f4['optionsAttributes']" />
		</td>
		<td>
			@php
			$__f5 = ['name' => 'products[' . $product->id . '][product_locations][]', 'list' => $business_locations, 'selected' => $product->product_locations->pluck('id'), 'options' => ['class' => 'form-control select2', 'multiple']];
			@endphp
			<x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
		</td>
	<tr>
	<tr>
		<td colspan="6">
			<table class="table">
				<thead>
					<tr>
						<th>@lang('lang_v1.variation')</th>
						<th>@lang('product.default_purchase_price')</th>
						<th>@lang('product.profit_percent') @show_tooltip(__('tooltip.profit_percent'))</th>
                		<th>@lang('product.default_selling_price')</th>
                		<th>@lang('lang_v1.group_price')</th>
					</tr>
				</thead>
				<tbody>
				@foreach($product->variations as $variation)
					<tr class="variation_row">
						@include('product.partials.bulk_edit_variation_row')
					</tr>
				@endforeach
				</tbody>
			</table>
		</td>
	</tr>
</tbody>