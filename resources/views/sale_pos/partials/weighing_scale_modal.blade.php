<div class="modal fade" tabindex="-1" role="dialog" id="weighing_scale_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@lang('lang_v1.weighing_scale')</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
				        <div class="form-group">
				            @php
				            $__f1 = ['name' => 'weighing_scale_barcode', 'value' => __('lang_v1.weighing_scale_barcode') . ':'];
				            @endphp
				            <x-form.label :name="$__f1['name']" :value="$__f1['value']" /> @show_tooltip(__('lang_v1.weighing_scale_barcode_help'))
				            @php
				            $__f2 = ['name' => 'weighing_scale_barcode', 'value' => null, 'options' => ['class' => 'form-control']];
				            @endphp
				            <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
				        </div>
				    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="weighing_scale_submit">@lang('messages.submit')</button>
			    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->