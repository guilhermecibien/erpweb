<!-- Edit discount Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="posEditDiscountModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					@if($is_discount_enabled)
						@lang('sale.discount')
					@endif
					@if($is_rp_enabled)
						{{session('business.rp_name')}}
					@endif
				</h4>
			</div>
			<div class="modal-body">
				<div class="row @if(!$is_discount_enabled) hide @endif">
					<div class="col-md-12">
						<h4 class="modal-title">@lang('sale.edit_discount'):</h4>
					</div>
					<div class="col-md-6">
				        <div class="form-group">
				            @php
				            $__f1 = ['name' => 'discount_type_modal', 'value' => __('sale.discount_type') . ':*'];
				            @endphp
				            <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
				            <div class="input-group">
				                <span class="input-group-addon">
				                    <i class="fa fa-info"></i>
				                </span>
				                @php
				                $__f2 = ['name' => 'discount_type_modal', 'list' => ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], 'selected' => $discount_type, 'options' => ['class' => 'form-control','placeholder' => __('messages.please_select'), 'required']];
				                @endphp
				                <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
				            </div>
				        </div>
				    </div>
				    @php
				    	$max_discount = !is_null(auth()->user()->max_sales_discount_percent) ? auth()->user()->max_sales_discount_percent : '';

				    	//if sale discount is more than user max discount change it to max discount
				    	if($discount_type == 'percentage' && $max_discount != '' && $sales_discount > $max_discount) $sales_discount = $max_discount;
				    @endphp
				    <div class="col-md-6">
				        <div class="form-group">
				            @php
				            $__f3 = ['name' => 'discount_amount_modal', 'value' => __('sale.discount_amount') . ':*'];
				            @endphp
				            <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
				            <div class="input-group">
				                <span class="input-group-addon">
				                    <i class="fa fa-info"></i>
				                </span>
				                @php
				                $__f4 = ['name' => 'discount_amount_modal', 'value' => number_format($sales_discount, 2, ',', '.'), 'options' => ['class' => 'form-control input_number', 'data-max-discount' => $max_discount, 'data-max-discount-error_msg' => __('lang_v1.max_discount_error_msg', ['discount' => $max_discount != '' ? number_format($max_discount, 2, ',', '.') : '']) ]];
				                @endphp
				                <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
				            </div>
				        </div>
				    </div>
				</div>
				<br>
				<div class="row @if(!$is_rp_enabled) hide @endif">
					<div class="well well-sm bg-light-gray col-md-12">
					<div class="col-md-12">
						<h4 class="modal-title">{{session('business.rp_name')}}:</h4>
					</div>
					<div class="col-md-6">
				        <div class="form-group">
				            @php
				            $__f5 = ['name' => 'rp_redeemed_modal', 'value' => __('lang_v1.redeemed') . ':'];
				            @endphp
				            <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
				            <div class="input-group">
				                <span class="input-group-addon">
				                    <i class="fa fa-gift"></i>
				                </span>
				                @php
				                $__f6 = ['name' => 'rp_redeemed_modal', 'value' => $rp_redeemed, 'options' => ['class' => 'form-control', 'data-amount_per_unit_point' => session('business.redeem_amount_per_unit_rp'), 'data-max_points' => $max_available, 'min' => 0, 'data-min_order_total' => session('business.min_order_total_for_redeem') ]];
				                @endphp
				                <x-form.input type="number" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
				                <input type="hidden" id="rp_name" value="{{session('business.rp_name')}}">
				            </div>
				        </div>
				    </div>
				    <div class="col-md-6">
				    	<p><strong>@lang('lang_v1.available'):</strong> <span id="available_rp">{{$max_available}}</span></p>
				    	<h5><strong>@lang('lang_v1.redeemed_amount'):</strong> <span id="rp_redeemed_amount_text">{{@num_format($rp_redeemed_amount)}}</span></h5>
				    </div>
				    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="posEditDiscountModalUpdate">@lang('messages.update')</button>
			    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->