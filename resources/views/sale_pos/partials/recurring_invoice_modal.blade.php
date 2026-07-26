<!-- Edit discount Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="recurringInvoiceModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@lang('lang_v1.subscribe') @if(!empty($transaction->subscription_no)) - {{$transaction->subscription_no}} @endif</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
				        <div class="form-group">
				        	@php
				        	$__f1 = ['name' => 'recur_interval', 'value' => __('lang_v1.subscription_interval') . ':*'];
				        	@endphp
				        	<x-form.label :name="$__f1['name']" :value="$__f1['value']" />
				        	<div class="input-group">
				               @php
				               $__f2 = ['name' => 'recur_interval', 'value' => !empty($transaction->recur_interval) ? $transaction->recur_interval : null, 'options' => ['class' => 'form-control', 'required', 'style' => 'width: 50%;']];
				               @endphp
				               <x-form.input type="number" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
				               
				                @php
				                $__f3 = ['name' => 'recur_interval_type', 'list' => ['days' => __('lang_v1.days'), 'months' => __('lang_v1.months'), 'years' => __('lang_v1.years')], 'selected' => !empty($transaction->recur_interval_type) ? $transaction->recur_interval_type : 'days', 'options' => ['class' => 'form-control', 'required', 'style' => 'width: 50%;', 'id' => 'recur_interval_type']];
				                @endphp
				                <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
				                
				            </div>
				        </div>
				    </div>

				    <div class="col-md-6">
				        <div class="form-group">
				        	@php
				        	$__f4 = ['name' => 'recur_repetitions', 'value' => __('lang_v1.no_of_repetitions') . ':'];
				        	@endphp
				        	<x-form.label :name="$__f4['name']" :value="$__f4['value']" />
				        	@php
				        	$__f5 = ['name' => 'recur_repetitions', 'value' => !empty($transaction->recur_repetitions) ? $transaction->recur_repetitions : null, 'options' => ['class' => 'form-control']];
				        	@endphp
				        	<x-form.input type="number" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
					        <p class="help-block">@lang('lang_v1.recur_repetition_help')</p>
				        </div>
				    </div>
				    @php
				    	$repetitions = [];
				    	for ($i=1; $i <= 30; $i++) { 
				    		$repetitions[$i] = str_ordinal($i);
				        }
				    @endphp
				    <div class="subscription_repeat_on_div col-md-6 @if(empty($transaction->recur_interval_type)) hide @elseif(!empty($transaction->recur_interval_type) && $transaction->recur_interval_type != 'months') hide @endif">
				        <div class="form-group">
				        	@php
				        	$__f6 = ['name' => 'subscription_repeat_on', 'value' => __('lang_v1.repeat_on') . ':'];
				        	@endphp
				        	<x-form.label :name="$__f6['name']" :value="$__f6['value']" />
				        	@php
				        	$__f7 = ['name' => 'subscription_repeat_on', 'list' => $repetitions, 'selected' => !empty($transaction->subscription_repeat_on) ? $transaction->subscription_repeat_on : null, 'options' => ['class' => 'form-control', 'placeholder' => __('messages.please_select')]];
				        	@endphp
				        	<x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
				        </div>
				    </div>

				</div>
			</div>
			<div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->