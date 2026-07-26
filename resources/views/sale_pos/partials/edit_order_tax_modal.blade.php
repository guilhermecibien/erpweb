<!-- Edit Order tax Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="posEditOrderTaxModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@lang('sale.edit_order_tax')</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
				        <div class="form-group">
				            @php
				            $__f1 = ['name' => 'order_tax_modal', 'value' => __('sale.order_tax') . ':*'];
				            @endphp
				            <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
				            <div class="input-group">
				                <span class="input-group-addon">
				                    <i class="fa fa-info"></i>
				                </span>
				                @php
				                $__f2 = ['name' => 'order_tax_modal', 'list' => $taxes['tax_rates'], 'selected' => $selected_tax, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control'], 'optionsAttributes' => $taxes['attributes']];
				                @endphp
				                <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" :options-attributes="$__f2['optionsAttributes']" />
				            </div>
				        </div>
				    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="posEditOrderTaxModalUpdate">@lang('messages.update')</button>
			    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->