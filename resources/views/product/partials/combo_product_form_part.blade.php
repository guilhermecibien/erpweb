<div class="col-sm-12"><br>
	<div class="col-sm-8 col-sm-offset-2">
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-search"></i>
				</span>
				@php
				$__f1 = ['name' => 'search_product', 'value' => null, 'options' => ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder')]];
				@endphp
				<x-form.input type="text" :name="$__f1['name']" :value="$__f1['value']" :options="$__f1['options']" />
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-condensed table-bordered table-striped table-responsive add-product-price-table combo_product_table">
				<thead>
					<tr>
						<th class="text-center">
							@lang('product.product_name')
						</th>
						<th class="text-center"> 
							@lang('sale.qty')
						</th>
						<th class="text-center">
							@lang('lang_v1.purchase_price_exc_tax')
						</th>
						<th class="text-center">
							@lang('lang_v1.total_amount_exc_tax')
						</th>
						<th class="text-center">
							<span>
								<i class="fa fa-trash"></i>
							</span>
						</th>
					</tr>
				</thead>
				<tbody>
					@if($action == 'edit')
						<input type="hidden" name="combo_variation_id" value="{{$variation_id}}">

						@foreach($combo_variations as $combo_variation)
                			@include('product.partials.combo_product_entry_row', 
               ['variations' => [$combo_variation['variation']], 'product' => $combo_variation['variation']->product, 'quantity' => $combo_variation['quantity'],
               'sub_units' => $combo_variation['sub_units'],
               'multiplier' => $combo_variation['multiplier'],
               'unit_id' => $combo_variation['unit_id'],
               ]
               )
                		@endforeach
            		@endif

				</tbody><br>
				<tfoot class="combo_product_table_footer">
					<tr>
						<td></td>
						<td class="text-center"> 
							<b> @lang( 'purchase.net_total_amount' )</b> :
						</td>
						<td>
						</td>
						<td class="text-center">
							<span class="item_level_purchase_price_total display_currency" data-currency_symbol="true">
								0
							</span>
							<input type="hidden" name="item_level_purchase_price_total" id="item_level_purchase_price_total" value="0">
							<input type="hidden" name="purchase_price_inc_tax" id="purchase_price_inc_tax" value="0">
						</td>
					</tr>
				</tfoot>	
			</table>
		</div>
		<div class="col-sm-12 col-sm-offset-4">
			<div class="col-sm-4">
				@php
				$__f_margin = ['name' => 'margin', 'value' => __('product.profit_percent')];
				@endphp
				<x-form.label :name="$__f_margin['name']" :value="$__f_margin['value']" />:
				@php
				$__f2 = ['name' => 'profit_percent', 'value' => number_format($profit_percent, 2, ',', '.'), 'options' => ['class' => 'form-control input-sm input_number mousetrap', 'id' => 'margin']];
				@endphp
				<x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
			</div>
			<div class="col-sm-4">
				@php
				$__f_selling_price = ['name' => 'selling_price', 'value' => __('product.default_selling_price')];
				@endphp
				<x-form.label :name="$__f_selling_price['name']" :value="$__f_selling_price['value']" />:
				@php
				$__f3 = ['name' => 'selling_price', 'value' => number_format(0, 2, ',', '.'), 'options' => ['class' => 'form-control input-sm input_number mousetrap']];
				@endphp
				<x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />

				@php
				$__f4 = ['name' => 'selling_price_inc_tax', 'value' => number_format(0, 2, ',', '.'), 'options' => ['class' => 'input_number mousetrap', 'id' => 'selling_price_inc_tax']];
				@endphp
				<x-form.input type="hidden" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		__currency_convert_recursively($(".combo_product_table"));
		//Use when editing product
		update_net_total_amount();

		//Add products
	    if($( "#search_product" ).length > 0){
	        $( "#search_product" ).autocomplete({
	            source: "/purchases/get_products",
	            minLength: 2,
	            response: function(event,ui) {
	                if (ui.content.length == 1)
	                {
	                    ui.item = ui.content[0];
	                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
	                    $(this).autocomplete('close');
	                }
	            },
	            select: function( event, ui ) {
	                $(this).val(null);
	                get_product_entry_row( ui.item.product_id, ui.item.variation_id);
	            }
	        })
	        .autocomplete( "instance" )._renderItem = function( ul, item ) {
	            return $( "<li>" ).append( "<div>" + item.text + "</div>" ).appendTo( ul );
	        };
	    }

	    function get_product_entry_row(product_id, variation_id) {

	    	if (product_id) {
	    		$.ajax({
	    			method : 'GET',
	    			url: '/products/get-combo-product-entry-row',
	    			dataType : "html",
	    			data: { 'product_id' : product_id, 'variation_id' : variation_id},
	    			success :function(result){
	    				$(result).find('input.quantity').each(function(){
	    					var row = $(this).closest('tr');
	    					$(".combo_product_table tbody").append(update_combo_product_row_values(row));
	    					update_net_total_amount();
	    				});
	    			}
	    		});
	    	}
	    }

	    $(document).on('click', '.remove_combo_product_entry_row', function(){
	    	swal({ 
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        	}).then((value) => {
	            if(value){
	                $(this).closest('tr').remove();
	                update_net_total_amount();
	            }
	        });
	    });

	    function update_combo_product_row_values(row) {
			var purchase_price = parseFloat(row.find('input.purchase_price').val());
			var quantity = __read_number(row.find('input.quantity'), false);
			var multiplier = __getUnitMultiplier(row);

			var item_level_purchase_price = quantity * purchase_price * multiplier;
			row.find('span.item_level_purchase_price').text(item_level_purchase_price);
			__currency_convert_recursively(row);

			row.find('input.item_level_purchase_price').val(item_level_purchase_price);
			
			return row;
	    }

	    function update_net_total_amount() {
	    	
	    	var item_level_purchase_price_total = 0;
	    	var purchase_price_inc_tax = 0;

	    	$('.combo_product_table').find('tr').each(function(){
	    		if ($(this).find('input.item_level_purchase_price').length) {
	    			item_level_purchase_price_total += parseFloat($(this).find('input.item_level_purchase_price').val());
	    		}
	    	});

	    	var tax_rate = $('select#tax').find(':selected').data('rate');
	    	purchase_price_inc_tax = __add_percent(item_level_purchase_price_total, tax_rate);
	    	//Set selling price.
	    	$(".combo_product_table").find('span.item_level_purchase_price_total').text(item_level_purchase_price_total);
	    	$(".combo_product_table").find('input#item_level_purchase_price_total').val(item_level_purchase_price_total);
	    	$(".combo_product_table").find('input#purchase_price_inc_tax').val(purchase_price_inc_tax);

	    	__currency_convert_recursively($(".combo_product_table_footer").find('tr'));

	    	//Set selling price.
	    	var margin = __read_number($('input#margin'), false);
	    	var selling_price = __add_percent(item_level_purchase_price_total, margin);
	    	var selling_price_inc_tax = __add_percent(selling_price, tax_rate);

	    	__write_number($('input#selling_price'), selling_price);
	    	__write_number($('input#selling_price_inc_tax'), selling_price_inc_tax);
	    }

	    function recalculate_the_row(row){
	    	var quantity = __read_number(row.find('input.quantity'), false);
	    	var multiplier = __getUnitMultiplier(row);

	    	var purchase_price = parseFloat(row.find('input.purchase_price').val());
	    	var item_level_purchase_price = quantity * multiplier * purchase_price;

	    	row.find('span.purchase_price_text').text(purchase_price);
	    	row.find('span.item_level_purchase_price').text(item_level_purchase_price);
	    	row.find('input.item_level_purchase_price').val(item_level_purchase_price);
	    	__currency_convert_recursively(row);
	    	update_net_total_amount();
	    }

	    $(document).on('change', 'input.quantity', function(){
	    	var row = $(this).closest('tr');
	    	recalculate_the_row(row);
	    });
	    $(document).on('change', 'select.sub_unit', function(){
	    	var row = $(this).closest('tr');
	    	recalculate_the_row(row);
	    });

	    $(document).on('change', 'input#margin', function(){
	    	update_net_total_amount();
	    });

	    $(document).on('change', 'select#tax', function(){
	    	update_net_total_amount();
	    });

	    $(document).on('change', 'input#selling_price', function(){
	    	var amount = __read_number($('input#selling_price'), false);
			var principal = parseFloat($('input#item_level_purchase_price_total').val());

	    	var margin = __get_rate(principal, amount);
	    	__write_number($('input#margin'), margin);

	    	var tax_rate = $('select#tax').find(':selected').data('rate');
	    	var selling_price_inc_tax = __add_percent(amount, tax_rate);
	    	__write_number($('input#selling_price_inc_tax'), selling_price_inc_tax);
	    });
	});
</script>