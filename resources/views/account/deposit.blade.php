<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('AccountController@postDeposit'), 'method' => 'post', 'id' => 'deposit_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'account.deposit' )</h4>
    </div>

    <div class="modal-body">
            <div class="form-group">
                <strong>@lang('account.selected_account')</strong>: 
                {{$account->name}}
                @php
                $__f2 = ['name' => 'account_id', 'value' => $account->id];
                @endphp
                <x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" />
            </div>

            <div class="form-group">
                @php
                $__f3 = ['name' => 'amount', 'value' => __( 'sale.amount' ) .":*"];
                @endphp
                <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                @php
                $__f4 = ['name' => 'amount', 'value' => 0, 'options' => ['class' => 'form-control input_number', 'required','placeholder' => __( 'sale.amount' ) ]];
                @endphp
                <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
            </div>

            <div class="form-group">
                @php
                $__f5 = ['name' => 'from_account', 'value' => __( 'account.deposit_from' ) .":"];
                @endphp
                <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                @php
                $__f6 = ['name' => 'from_account', 'list' => $from_accounts, 'selected' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('messages.please_select') ]];
                @endphp
                <x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
            </div>

            <div class="form-group">
                @php
                $__f7 = ['name' => 'operation_date', 'value' => __( 'messages.date' ) .":*"];
                @endphp
                <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
                <div class="input-group date" id='od_datetimepicker'>
                  @php
                  $__f8 = ['name' => 'operation_date', 'value' => 0, 'options' => ['class' => 'form-control', 'required','placeholder' => __( 'messages.date' ) ]];
                  @endphp
                  <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
            </div>

            <div class="form-group">
                @php
                $__f9 = ['name' => 'note', 'value' => __( 'brand.note' )];
                @endphp
                <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
                @php
                $__f10 = ['name' => 'note', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'brand.note' ), 'rows' => 4]];
                @endphp
                <x-form.textarea :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
            </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.submit' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
  $(document).ready( function(){
    $('#od_datetimepicker').datetimepicker({
      format: moment_date_format + ' ' + moment_time_format
    });
  });
</script>