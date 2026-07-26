<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('TransactionPaymentController@postPayContactDue'), 'method' => 'post', 'id' => 'pay_contact_due_form', 'files' => true ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    @php
    $__f2 = ['name' => "contact_id", 'value' => $contact_details->contact_id];
    @endphp
    <x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" />
    @php
    $__f3 = ['name' => "due_payment_type", 'value' => $due_payment_type];
    @endphp
    <x-form.input type="hidden" :name="$__f3['name']" :value="$__f3['value']" />
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'purchase.add_payment' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        @if($due_payment_type == 'purchase')
        <div class="col-md-6">
          <div class="well">
            <strong>@lang('purchase.supplier'): </strong>{{ $contact_details->name }}<br>
            <strong>@lang('business.business'): </strong>{{ $contact_details->supplier_business_name }}<br><br>
          </div>
        </div>
        <div class="col-md-6">
          <div class="well">
            <strong>@lang('report.total_purchase'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_purchase }}</span><br>
            <strong>@lang('contact.total_paid'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_paid }}</span><br>
            <strong>@lang('contact.total_purchase_due'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_purchase - $contact_details->total_paid }}</span><br>
             @if(!empty($contact_details->opening_balance) || $contact_details->opening_balance != '0.00')
                  <strong>@lang('lang_v1.opening_balance'): </strong>
                  <span class="display_currency" data-currency_symbol="true">
                  {{ $contact_details->opening_balance }}</span><br>
                  <strong>@lang('lang_v1.opening_balance_due'): </strong>
                  <span class="display_currency" data-currency_symbol="true">
                  {{ $ob_due }}</span>
              @endif
          </div>
        </div>
        @elseif($due_payment_type == 'purchase_return')
        <div class="col-md-6">
          <div class="well">
            <strong>@lang('purchase.supplier'): </strong>{{ $contact_details->name }}<br>
            <strong>@lang('business.business'): </strong>{{ $contact_details->supplier_business_name }}<br><br>
          </div>
        </div>
        <div class="col-md-6">
          <div class="well">
            <strong>@lang('lang_v1.total_purchase_return'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_purchase_return }}</span><br>
            <strong>@lang('lang_v1.total_purchase_return_paid'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_return_paid }}</span><br>
            <strong>@lang('lang_v1.total_purchase_return_due'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_purchase_return - $contact_details->total_return_paid }}</span>
          </div>
        </div>
        @elseif(in_array($due_payment_type, ['sell']))
          <div class="col-md-6">
            <div class="well">
              <strong>@lang('sale.customer_name'): </strong>{{ $contact_details->name }}<br>
              <br><br>
            </div>
          </div>
          <div class="col-md-6">
            <div class="well">
              <strong>@lang('report.total_sell'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_invoice }}</span><br>
              <strong>@lang('contact.total_paid'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_paid }}</span><br>
              <strong>@lang('contact.total_sale_due'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_invoice - $contact_details->total_paid }}</span><br>
              @if(!empty($contact_details->opening_balance) || $contact_details->opening_balance != '0.00')
                  <strong>@lang('lang_v1.opening_balance'): </strong>
                  <span class="display_currency" data-currency_symbol="true">
                  {{ $contact_details->opening_balance }}</span><br>
                  <strong>@lang('lang_v1.opening_balance_due'): </strong>
                  <span class="display_currency" data-currency_symbol="true">
                  {{ $ob_due }}</span>
              @endif
            </div>
          </div>
         @elseif(in_array($due_payment_type, ['sell_return']))
         <div class="col-md-6">
          <div class="well">
            <strong>@lang('sale.customer_name'): </strong>{{ $contact_details->name }}<br>
              <br><br>
          </div>
        </div>
        <div class="col-md-6">
          <div class="well">
            <strong>@lang('lang_v1.total_sell_return'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_sell_return }}</span><br>
            <strong>@lang('lang_v1.total_sell_return_paid'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_return_paid }}</span><br>
            <strong>@lang('lang_v1.total_sell_return_due'): </strong><span class="display_currency" data-currency_symbol="true">{{ $contact_details->total_sell_return - $contact_details->total_return_paid }}</span>
          </div>
        </div>
        @endif
      </div>
      <div class="row payment_row">
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f4 = ['name' => "amount", 'value' => __('sale.amount') . ':*'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              @php
              $__f5 = ['name' => "amount", 'value' => number_format($payment_line->amount, 2, ',', '.'), 'options' => ['class' => 'form-control input_number', 'required', 'placeholder' => 'Amount', 'data-rule-max-value' => $payment_line->amount, 'data-msg-max-value' => __('lang_v1.max_amount_to_be_paid_is', ['amount' => $amount_formated])]];
              @endphp
              <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f6 = ['name' => "paid_on", 'value' => __('lang_v1.paid_on') . ':*'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </span>
              @php
              $__f7 = ['name' => 'paid_on', 'value' => \Carbon::createFromTimestamp(strtotime($payment_line->paid_on))->format(session('business.date_format') . ' ' . (session('business.time_format') == 24 ? 'H:i' : 'h:i A')), 'options' => ['class' => 'form-control', 'readonly', 'required']];
              @endphp
              <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f8 = ['name' => "method", 'value' => __('purchase.payment_method') . ':*'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              @php
              $__f9 = ['name' => "method", 'list' => $payment_types, 'selected' => $payment_line->method, 'options' => ['class' => 'form-control select2 payment_types_dropdown', 'required', 'style' => 'width:100%;']];
              @endphp
              <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
          <div class="form-group">
            @php
            $__f10 = ['name' => 'document', 'value' => __('purchase.attach_document') . ':'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
            @php
            $__f11 = ['name' => 'document', 'options' => ['accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]];
            @endphp
            <x-form.input type="file" :name="$__f11['name']" :options="$__f11['options']" />
            <p class="help-block">
            @includeIf('components.document_help_text')</p>
          </div>
        </div>
        @if(!empty($accounts))
          <div class="col-md-6">
            <div class="form-group">
              @php
              $__f12 = ['name' => "account_id", 'value' => __('lang_v1.payment_account') . ':'];
              @endphp
              <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fas fa-money-bill-alt"></i>
                </span>
                @php
                $__f13 = ['name' => "account_id", 'list' => $accounts, 'selected' => !empty($payment_line->account_id) ? $payment_line->account_id : '', 'options' => ['class' => 'form-control select2', 'id' => "account_id", 'style' => 'width:100%;']];
                @endphp
                <x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
              </div>
            </div>
          </div>
        @endif
        <div class="clearfix"></div>

          @include('transaction_payment.payment_type_details')
        <div class="col-md-12">
          <div class="form-group">
            @php
            $__f14 = ['name' => "note", 'value' => __('lang_v1.payment_note') . ':'];
            @endphp
            <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
            @php
            $__f15 = ['name' => "note", 'value' => $payment_line->note, 'options' => ['class' => 'form-control', 'rows' => 3]];
            @endphp
            <x-form.textarea :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
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