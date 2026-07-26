<div class="modal fade" tabindex="-1" role="dialog" id="confirmSuspendModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@lang('lang_v1.suspend_sale')</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
				        <div class="form-group">
				            @php
				            $__f1 = ['name' => 'additional_notes', 'value' => __('lang_v1.suspend_note') . ':'];
				            @endphp
				            <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
				            @php
				            $__f2 = ['name' => 'additional_notes', 'value' => !empty($transaction->additional_notes) ? $transaction->additional_notes : null, 'options' => ['class' => 'form-control','rows' => '4']];
				            @endphp
				            <x-form.textarea :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
				            @php
				            $__f3 = ['name' => 'is_suspend', 'value' => 0, 'options' => ['id' => 'is_suspend']];
				            @endphp
				            <x-form.input type="hidden" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
				        </div>
				    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="pos-suspend">@lang('messages.save')</button>
			    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->