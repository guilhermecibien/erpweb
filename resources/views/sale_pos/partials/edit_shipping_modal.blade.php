<!-- Edit Shipping Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="posShippingModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@lang('sale.shipping')</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
				        <div class="form-group">
				            @php
				            $__f1 = ['name' => 'shipping_details_modal', 'value' => 'Detalhes da entrega' . ':*'];
				            @endphp
				            <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
				            @php
				            $__f2 = ['name' => 'shipping_details_modal', 'value' => !empty($transaction->shipping_details) ? $transaction->shipping_details : '', 'options' => ['class' => 'form-control','placeholder' => __('sale.shipping_details'), 'required' ,'rows' => '4']];
				            @endphp
				            <x-form.textarea :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
				        </div>
				    </div>

				    <div class="col-md-6">
				        <div class="form-group">
				            @php
				            $__f3 = ['name' => 'shipping_address_modal', 'value' => __('lang_v1.shipping_address') . ':'];
				            @endphp
				            <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
				            @php
				            $__f4 = ['name' => 'shipping_address_modal', 'value' => !empty($transaction->shipping_address) ? $transaction->shipping_address : '', 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.shipping_address') ,'rows' => '4']];
				            @endphp
				            <x-form.textarea :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
				        </div>
				    </div>

				    <div class="col-md-6">
				        <div class="form-group">
				            @php
				            $__f5 = ['name' => 'shipping_charges_modal', 'value' => 'Valor' . ':*'];
				            @endphp
				            <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
				            <div class="input-group">
				                <span class="input-group-addon">
				                    <i class="fa fa-info"></i>
				                </span>
				                @php
				                $__f6 = ['name' => 'shipping_charges_modal', 'value' => !empty($transaction->shipping_charges) ? number_format($transaction->shipping_charges, 2, ',', '.') : 0, 'options' => ['class' => 'form-control input_number','placeholder' => __('sale.shipping_charges')]];
				                @endphp
				                <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
				            </div>
				        </div>
				    </div>

				    <div class="col-md-6">
				        <div class="form-group">
				            @php
				            $__f7 = ['name' => 'shipping_status_modal', 'value' => __('lang_v1.shipping_status') . ':'];
				            @endphp
				            <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
				            @php
				            $__f8 = ['name' => 'shipping_status_modal', 'list' => $shipping_statuses, 'selected' => !empty($transaction->shipping_status) ? $transaction->shipping_status : null, 'options' => ['class' => 'form-control','placeholder' => __('messages.please_select')]];
				            @endphp
				            <x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
				        </div>
				    </div>

				    <div class="col-md-6">
				        <div class="form-group">
				            @php
				            $__f9 = ['name' => 'delivered_to_modal', 'value' => __('lang_v1.delivered_to') . ':'];
				            @endphp
				            <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
				            @php
				            $__f10 = ['name' => 'delivered_to_modal', 'value' => !empty($transaction->delivered_to) ? $transaction->delivered_to : null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.delivered_to')]];
				            @endphp
				            <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
				        </div>
				    </div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="posShippingModalUpdate">@lang('messages.update')</button>
			    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->