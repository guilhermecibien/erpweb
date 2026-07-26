<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('AccountReportsController@postLinkAccount'), 'method' => 'post', 'id' => 'link_account_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'account.link_account' ) - @lang( 'account.payment_ref_no' ): - {{$payment->payment_ref_no}}</h4>
    </div>

    <div class="modal-body">
        <div class="form-group">
            @php
            $__f2 = ['name' => 'transaction_payment_id', 'value' => $payment->id];
            @endphp
            <x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" />
            @php
            $__f3 = ['name' => 'account_id', 'value' => __( 'account.account' ) .":"];
            @endphp
            <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
            @php
            $__f4 = ['name' => 'account_id', 'list' => $accounts, 'selected' => $payment->account_id, 'options' => ['class' => 'form-control', 'required']];
            @endphp
            <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
        </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->