<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('TransactionPaymentController@update', [$payment_line->id]), 'method' => 'put', 'id' => 'transaction_payment_add_form', 'files' => true ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'purchase.edit_payment' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        @if(!empty($transaction->contact))
        <div class="col-md-4">
          <div class="well">
            <strong>@lang('purchase.supplier'): </strong>{{ $transaction->contact->name }}<br>
            <strong>@lang('business.business'): </strong>{{ $transaction->contact->supplier_business_name }}
          </div>
        </div>
        @endif
        @if($transaction->type != 'opening_balance')
        <div class="col-md-4">
          <div class="well">
            <strong>@lang('purchase.ref_no'): </strong>{{ $transaction->ref_no }}<br>
            @if(!empty($transaction->location))
              <strong>@lang('purchase.location'): </strong>{{ $transaction->location->name }}
            @endif
          </div>
        </div>
        <div class="col-md-4">
          <div class="well">
            <strong>@lang('sale.total_amount'): </strong><span class="display_currency" data-currency_symbol="true">{{ $transaction->final_total }}</span><br>
            <strong>@lang('purchase.payment_note'): </strong>
            @if(!empty($transaction->additional_notes))
            {{ $transaction->additional_notes }}
            @else
              --
            @endif
          </div>
        </div>
        @endif
      </div>
      <div class="row payment_row">
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f2 = ['name' => "amount", 'value' => 'Valor' . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              @php
              $__f3 = ['name' => "amount", 'value' => number_format($payment_line->amount, 2, ',', '.'), 'options' => ['class' => 'form-control input_number', 'required', 'placeholder' => 'Amount']];
              @endphp
              <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f4 = ['name' => "paid_on", 'value' => __('lang_v1.paid_on') . ':*'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </span>
              @php
              $__f5 = ['name' => 'paid_on', 'value' => \Carbon::createFromTimestamp(strtotime($payment_line->vencimento))->format(session('business.date_format')), 'options' => ['class' => 'form-control', 'readonly', 'required']];
              @endphp
              <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f6 = ['name' => "method", 'value' => __('purchase.payment_method') . ':*'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              @php
              $__f7 = ['name' => "method", 'list' => $payment_types, 'selected' => $payment_line->method, 'options' => ['class' => 'form-control select2 payment_types_dropdown', 'required', 'style' => 'width:100%;']];
              @endphp
              <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f8 = ['name' => 'document', 'value' => __('purchase.attach_document') . ':'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            @php
            $__f9 = ['name' => 'document', 'options' => ['accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]];
            @endphp
            <x-form.input type="file" :name="$__f9['name']" :options="$__f9['options']" />
            <p class="help-block">@lang('lang_v1.previous_file_will_be_replaced')
            @includeIf('components.document_help_text')</p>
          </div>
        </div>
        @if(!empty($accounts))
          <div class="col-md-6">
            <div class="form-group">
              @php
              $__f10 = ['name' => "account_id", 'value' => __('lang_v1.payment_account') . ':'];
              @endphp
              <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fas fa-money-bill-alt"></i>
                </span>
                @php
                $__f11 = ['name' => "account_id", 'list' => $accounts, 'selected' => !empty($payment_line->account_id) ? $payment_line->account_id : '', 'options' => ['class' => 'form-control select2', 'id' => "account_id", 'style' => 'width:100%;']];
                @endphp
                <x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
              </div>
            </div>
          </div>
        @endif
        
        <div class="clearfix"></div>
          @include('transaction_payment.payment_type_details')
        <div class="col-md-12">
          <div class="form-group">
            @php
            $__f12 = ['name' => "note", 'value' => __('lang_v1.payment_note') . ':'];
            @endphp
            <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
            @php
            $__f13 = ['name' => "note", 'value' => $payment_line->note, 'options' => ['class' => 'form-control', 'rows' => 3]];
            @endphp
            <x-form.textarea :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->