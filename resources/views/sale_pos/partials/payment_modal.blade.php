<div class="modal fade" tabindex="-1" role="dialog" id="modal_payment">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@lang('lang_v1.payment')</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-9">
						<div class="row">
							<div id="payment_rows_div">
								@foreach($payment_lines as $payment_line)

								@if($payment_line['is_return'] == 1)
								@php
								$change_return = $payment_line;
								@endphp

								@continue
								@endif

								@include('sale_pos.partials.payment_row', ['removable' => !$loop->first, 'row_index' => $loop->index, 'payment_line' => $payment_line])
								@endforeach
							</div>
							<input type="hidden" id="payment_row_index" value="{{count($payment_lines)}}">
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="button" class="btn btn-primary btn-block" id="add-payment-row">@lang('sale.add_payment_row')</button>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									@php
									$__f1 = ['name' => 'sale_note', 'value' => __('sale.sell_note') . ':'];
									@endphp
									<x-form.label :name="$__f1['name']" :value="$__f1['value']" />
									@php
									$__f2 = ['name' => 'sale_note', 'value' => !empty($transaction)? $transaction->additional_notes:null, 'options' => ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('sale.sell_note')]];
									@endphp
									<x-form.textarea :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@php
									$__f3 = ['name' => 'staff_note', 'value' => __('sale.staff_note') . ':'];
									@endphp
									<x-form.label :name="$__f3['name']" :value="$__f3['value']" />
									@php
									$__f4 = ['name' => 'staff_note', 'value' => !empty($transaction)? $transaction->staff_note:null, 'options' => ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('sale.staff_note')]];
									@endphp
									<x-form.textarea :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="box box-solid bg-orange">
							<div class="box-body">
								<div class="col-md-12">
									<strong>
										@lang('lang_v1.total_items'):
									</strong>
									<br/>
									<span class="lead text-bold total_quantity">0</span>
								</div>

								<div class="col-md-12">
									<hr>
									<strong>
										@lang('sale.total_payable'):
									</strong>
									<br/>
									<span class="lead text-bold total_payable_span">0</span>
								</div>

								<div class="col-md-12">
									<hr>
									<strong>
										@lang('lang_v1.total_paying'):
									</strong>
									<br/>
									<span class="lead text-bold total_paying">0</span>
									<input type="hidden" id="total_paying_input">
								</div>

								<div class="col-md-12">
									<hr>
									<strong>
										@lang('lang_v1.change_return'):
									</strong>
									<br/>
									<span class="lead text-bold change_return_span">0</span>
									@php
									$__f5 = ['name' => "change_return", 'value' => $change_return['amount'], 'options' => ['class' => 'form-control change_return input_number', 'required', 'id' => "change_return", 'placeholder' => __('sale.amount'), 'readonly']];
									@endphp
									<x-form.input type="hidden" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
									<!-- <span class="lead text-bold total_quantity">0</span> -->
									@if(!empty($change_return['id']))
									<input type="hidden" name="change_return_id" 
									value="{{$change_return['id']}}">
									@endif
								</div>

								<div class="col-md-12">
									<hr>
									<strong>
										@lang('lang_v1.balance'):
									</strong>
									<br/>
									<span class="lead text-bold balance_due">0</span>
									<input type="hidden" id="in_balance_due" value=0>
								</div>



							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
				<button type="submit" class="btn btn-primary" id="pos-save">@lang('sale.finalize_payment')</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Used for express checkout card transaction -->
<div class="modal fade" tabindex="-1" role="dialog" id="card_details_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@lang('lang_v1.card_transaction_details')</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">

						<div class="col-md-6">
							<div class="form-group">
								@php
								$__f6 = ['name' => "card_number", 'value' => __('lang_v1.card_no')];
								@endphp
								<x-form.label :name="$__f6['name']" :value="$__f6['value']" />
								@php
								$__f7 = ['name' => "", 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.card_no'), 'id' => "card_number", 'autofocus']];
								@endphp
								<x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								@php
								$__f8 = ['name' => "card_holder_name", 'value' => "CNPJ"];
								@endphp
								<x-form.label :name="$__f8['name']" :value="$__f8['value']" />
								@php
								$__f9 = ['name' => "", 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => "CNPJ", 'id' => "card_holder_name"]];
								@endphp
								<x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								@php
								$__f10 = ['name' => "card_transaction_number", 'value' => "Código de autorização"];
								@endphp
								<x-form.label :name="$__f10['name']" :value="$__f10['value']" />
								@php
								$__f11 = ['name' => "", 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => "Código de autorização", 'id' => "card_transaction_number"]];
								@endphp
								<x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
							</div>
						</div>
						<!-- <div class="clearfix"></div> -->
						<div class="col-md-3">
							<div class="form-group">
								@php
								$__f12 = ['name' => "card_type", 'value' => __('lang_v1.card_type')];
								@endphp
								<x-form.label :name="$__f12['name']" :value="$__f12['value']" />
								@php
								$__f13 = ['name' => "", 'list' => ['credit' => 'Crédito', 'debit' => 'Débito'], 'selected' => 'card_type', 'options' => ['class' => 'form-control select2', 'id' => "card_type", 'style="width: 100%"' ]];
								@endphp
								<x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								@php
								$__f14 = ['name' => "card_security", 'value' => "Bandeira"];
								@endphp
								<x-form.label :name="$__f14['name']" :value="$__f14['value']" />
								
								@php
								$__f15 = ['name' => "", 'list' => App\Models\Transaction::bandeiras(), 'selected' => 'card_security', 'options' => ['class' => 'form-control select2', 'id' => "card_security", 'style="width: 100%"']];
								@endphp
								<x-form.select :name="$__f15['name']" :list="$__f15['list']" :selected="$__f15['selected']" :options="$__f15['options']" />
							</div>
						</div>

						<div class="col-md-3" style="visibility: hidden">
							<div class="form-group">
								@php
								$__f16 = ['name' => "card_month", 'value' => __('lang_v1.month')];
								@endphp
								<x-form.label :name="$__f16['name']" :value="$__f16['value']" />
								@php
								$__f17 = ['name' => "", 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.month'), 'id' => "card_month" ]];
								@endphp
								<x-form.input type="text" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
							</div>
						</div>
						<div class="col-md-3" style="visibility: hidden">
							<div class="form-group">
								@php
								$__f18 = ['name' => "card_year", 'value' => __('lang_v1.year')];
								@endphp
								<x-form.label :name="$__f18['name']" :value="$__f18['value']" />
								@php
								$__f19 = ['name' => "", 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.year'), 'id' => "card_year" ]];
								@endphp
								<x-form.input type="text" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
							</div>
						</div>
						
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="pos-save-card">@lang('sale.finalize_payment')</button>
			</div>

		</div>
	</div>
</div>