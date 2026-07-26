<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('TransactionPaymentController@store'), 'method' => 'post', 'id' => 'transaction_payment_add_form', 'files' => true ]];
    @endphp
    <x-form.open :options="$__f1['options']" />
    @php
    $__f2 = ['name' => 'transaction_id', 'value' => $transaction->id];
    @endphp
    <x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'purchase.add_payment' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
      @if(!empty($transaction->contact))
        <div class="col-md-4">
          <div class="well">
            <strong>
            @if(in_array($transaction->type, ['purchase', 'purchase_return']))
              @lang('purchase.supplier') 
            @elseif(in_array($transaction->type, ['sell', 'sell_return']))
              @lang('contact.customer') 
            @endif
            </strong>:{{ $transaction->contact->name }}<br>
            @if($transaction->type == 'purchase')
            <strong>@lang('business.business'): </strong>{{ $transaction->contact->supplier_business_name }}
            @endif
          </div>
        </div>
        @endif
        <div class="col-md-4">
          <div class="well">
          @if(in_array($transaction->type, ['sell', 'sell_return']))
            <strong>@lang('sale.invoice_no'): </strong>{{ $transaction->invoice_no }}
          @else
            <strong>@lang('purchase.ref_no'): </strong>{{ $transaction->ref_no }}
          @endif
          @if(!empty($transaction->location))
            <br>
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
      </div>
      <div class="row payment_row">
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f3 = ['name' => "amount", 'value' => 'Valor' . ':*'];
            @endphp
            <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              @php
              $__f4 = ['name' => "amount", 'value' => number_format($payment_line->amount, 2, ',', '.'), 'options' => ['class' => 'form-control input_number', 'required', 'placeholder' => 'Valor', 'data-rule-max-value' => number_format($payment_line->amount, 2, ',', '.'), 'data-msg-max-value' => __('lang_v1.max_amount_to_be_paid_is', ['amount' => $amount_formated])]];
              @endphp
              <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f5 = ['name' => "paid_on", 'value' => __('lang_v1.paid_on') . ':*'];
            @endphp
            <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </span>
              @php
              $__f6 = ['name' => 'paid_on', 'value' => \Carbon::createFromTimestamp(strtotime($payment_line->paid_on))->format(session('business.date_format') . ' ' . (session('business.time_format') == 24 ? 'H:i' : 'h:i A')), 'options' => ['class' => 'form-control', 'readonly', 'required']];
              @endphp
              <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f7 = ['name' => "method", 'value' => __('purchase.payment_method') . ':*'];
            @endphp
            <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              @php
              $__f8 = ['name' => "method", 'list' => $payment_types, 'selected' => $payment_line->method, 'options' => ['class' => 'form-control select2 payment_types_dropdown', 'required', 'style' => 'width:100%;']];
              @endphp
              <x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
            </div>
          </div>
        </div>
        @if(!empty($accounts))
          <div class="col-md-6">
            <div class="form-group">
              @php
              $__f9 = ['name' => "account_id", 'value' => __('lang_v1.payment_account') . ':'];
              @endphp
              <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fas fa-money-bill-alt"></i>
                </span>
                @php
                $__f10 = ['name' => "account_id", 'list' => $accounts, 'selected' => !empty($payment_line->account_id) ? $payment_line->account_id : '', 'options' => ['class' => 'form-control select2', 'id' => "account_id", 'style' => 'width:100%;']];
                @endphp
                <x-form.select :name="$__f10['name']" :list="$__f10['list']" :selected="$__f10['selected']" :options="$__f10['options']" />
              </div>
            </div>
          </div>
        @endif
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f11 = ['name' => 'document', 'value' => __('purchase.attach_document') . ':'];
            @endphp
            <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
            @php
            $__f12 = ['name' => 'document', 'options' => ['accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]];
            @endphp
            <x-form.input type="file" :name="$__f12['name']" :options="$__f12['options']" />
            <p class="help-block">
            @includeIf('components.document_help_text')</p>
          </div>
        </div>
        <div class="clearfix"></div>
          @include('transaction_payment.payment_type_details')
        <div class="col-md-12">
          <div class="form-group">
            @php
            $__f13 = ['name' => "note", 'value' => __('lang_v1.payment_note') . ':'];
            @endphp
            <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
            @php
            $__f14 = ['name' => "note", 'value' => $payment_line->note, 'options' => ['class' => 'form-control', 'rows' => 3]];
            @endphp
            <x-form.textarea :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->