<div class="row">
	<div class="col-md-4">
	    <div class="form-group">
	        @php
	        $__f1 = ['name' => 'sr_location_id', 'value' => __('purchase.business_location') . ':'];
	        @endphp
	        <x-form.label :name="$__f1['name']" :value="$__f1['value']" />

	        @php
	        $__f2 = ['name' => 'sr_location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%']];
	        @endphp
	        <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
	    </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
            <table class="table table-bordered table-striped" 
            id="supplier_stock_report_table" width="100%">
                <thead>
                    <tr>
                        <th>@lang('sale.product')</th>
                        <th>@lang('product.sku')</th>
                        <th>@lang('purchase.purchase_quantity')</th>
                        <th>@lang('lang_v1.total_sold')</th>
                        <th>@lang('lang_v1.total_returned')</th>
                        <th>@lang('report.current_stock')</th>
                        <th>@lang('lang_v1.total_stock_price')</th>
                    </tr>
                </thead>
            </table>
        </div>
	</div>
</div>