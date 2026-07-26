<!-- Fix for scroll issue in new booking -->
<style type="text/css">
  .modal {
    overflow-y:auto; 
  }
</style>
<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => $notification_template['template_for'] == 'send_ledger' ? action('ContactController@sendLedger') : action('NotificationController@send'), 'method' => 'post', 'id' => 'send_notification_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'lang_v1.send_notification' ) - {{$template_name}}</h4>
    </div>

    <div class="modal-body">
      <div class="form-group @if($notification_template['template_for'] == 'send_ledger') hide @endif">
        <label class="radio-inline">
          @php
          $__f2 = ['name' => 'notification_type', 'value' => 'email_only', 'checked' => true, 'options' => ['class' => 'input-icheck']];
          @endphp
          <x-form.radio :name="$__f2['name']" :value="$__f2['value']" :checked="$__f2['checked']" :options="$__f2['options']" /> @lang('lang_v1.send_email_only')
        </label>
        <label class="radio-inline">
          @php
          $__f3 = ['name' => 'notification_type', 'value' => 'sms_only', 'checked' => false, 'options' => ['class' => 'input-icheck']];
          @endphp
          <x-form.radio :name="$__f3['name']" :value="$__f3['value']" :checked="$__f3['checked']" :options="$__f3['options']" /> @lang('lang_v1.send_sms_only')
        </label>
        <label class="radio-inline">
          @php
          $__f4 = ['name' => 'notification_type', 'value' => 'both', 'checked' => false, 'options' => ['class' => 'input-icheck']];
          @endphp
          <x-form.radio :name="$__f4['name']" :value="$__f4['value']" :checked="$__f4['checked']" :options="$__f4['options']" /> @lang('lang_v1.send_both_email_n_sms')
        </label>
      </div>
      <div id="email_div">
        <div class="form-group">
          @php
          $__f5 = ['name' => 'to_email', 'value' => __('lang_v1.to').':'];
          @endphp
          <x-form.label :name="$__f5['name']" :value="$__f5['value']" /> @show_tooltip(__('lang_v1.notification_email_tooltip'))
          @php
          $__f6 = ['name' => 'to_email', 'value' => $contact->email, 'options' => ['class' => 'form-control' , 'placeholder' => __('lang_v1.to')]];
          @endphp
          <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
        </div>
        <div class="form-group">
          @php
          $__f7 = ['name' => 'subject', 'value' => __('lang_v1.email_subject').':'];
          @endphp
          <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
          @php
          $__f8 = ['name' => 'subject', 'value' => $notification_template['subject'], 'options' => ['class' => 'form-control' , 'placeholder' => __('lang_v1.email_subject')]];
          @endphp
          <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
        </div>
        <div class="form-group">
          @php
          $__f9 = ['name' => 'cc', 'value' => 'CC:'];
          @endphp
          <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
          @php
          $__f10 = ['name' => 'cc', 'value' => $notification_template['cc'], 'options' => ['class' => 'form-control' , 'placeholder' => 'CC']];
          @endphp
          <x-form.input type="email" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
        </div>
        <div class="form-group">
          @php
          $__f11 = ['name' => 'bcc', 'value' => 'BCC:'];
          @endphp
          <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
          @php
          $__f12 = ['name' => 'bcc', 'value' => $notification_template['bcc'], 'options' => ['class' => 'form-control' , 'placeholder' => 'BCC']];
          @endphp
          <x-form.input type="email" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
        </div>
        <div class="form-group">
          @php
          $__f13 = ['name' => 'email_body', 'value' => __('lang_v1.email_body').':'];
          @endphp
          <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
          @php
          $__f14 = ['name' => 'email_body', 'value' => $notification_template['email_body'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.email_body'), 'rows' => 6]];
          @endphp
          <x-form.textarea :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
        </div>
        @if($notification_template['template_for'] == 'send_ledger')
          <p class="help-block">*@lang('lang_v1.ledger_attacment_help')</p>
        @endif
      </div>
      <div id="sms_div" class="hide">
        <div class="form-group">
          @php
          $__f15 = ['name' => 'mobile_number', 'value' => __('lang_v1.mobile_number').':'];
          @endphp
          <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
          @php
          $__f16 = ['name' => 'mobile_number', 'value' => $contact->mobile, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.mobile_number')]];
          @endphp
          <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
        </div>
        <div class="form-group">
          @php
          $__f17 = ['name' => 'sms_body', 'value' => __('lang_v1.sms_body').':'];
          @endphp
          <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
          @php
          $__f18 = ['name' => 'sms_body', 'value' => $notification_template['sms_body'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_body'), 'rows' => 6]];
          @endphp
          <x-form.textarea :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
        </div>
      </div>
      <strong>@lang('lang_v1.available_tags'):</strong> <p class="help-block">{{implode(', ', $tags)}}</p>

      @if(!empty($transaction))
        @php
        $__f19 = ['name' => 'transaction_id', 'value' => $transaction->id];
        @endphp
        <x-form.input type="hidden" :name="$__f19['name']" :value="$__f19['value']" />
      @endif

      @if($notification_template['template_for'] == 'send_ledger')
        @php
        $__f20 = ['name' => 'contact_id', 'value' => $contact->id];
        @endphp
        <x-form.input type="hidden" :name="$__f20['name']" :value="$__f20['value']" />
        @php
        $__f21 = ['name' => 'start_date', 'value' => $start_date];
        @endphp
        <x-form.input type="hidden" :name="$__f21['name']" :value="$__f21['value']" />
        @php
        $__f22 = ['name' => 'end_date', 'value' => $end_date];
        @endphp
        <x-form.input type="hidden" :name="$__f22['name']" :value="$__f22['value']" />
      @endif

      @php
      $__f23 = ['name' => 'template_for', 'value' => $notification_template['template_for']];
      @endphp
      <x-form.input type="hidden" :name="$__f23['name']" :value="$__f23['value']" />

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" id="send_notification_btn">@lang('lang_v1.send')</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
// Fix for not updating textarea value on modal
  // CKEDITOR.on('instanceReady', function(){
  //    $.each( CKEDITOR.instances, function(instance) {
  //     CKEDITOR.instances[instance].on("change", function(e) {
  //         for ( instance in CKEDITOR.instances )
  //         CKEDITOR.instances[instance].updateElement();
  //     });
  //    });
  // });

  if (_.isNull(tinyMCE.activeEditor)) {
        tinymce.init({
            selector: 'textarea#email_body',
        });
    }
    
  $(document).ready(function(){
    //initialize iCheck
    $('input[type="checkbox"].input-icheck, input[type="radio"].input-icheck').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue'
    });
  });

  $(document).on('ifChanged', 'input[type=radio][name=notification_type]', function(){
    var notification_type = $(this).val();
    if (notification_type == 'email_only') {
      $('div#email_div').removeClass('hide');
      $('div#sms_div').addClass('hide');
    } else if(notification_type == 'sms_only'){
      $('div#email_div').addClass('hide');
      $('div#sms_div').removeClass('hide');
    } else if(notification_type == 'both'){
      $('div#email_div').removeClass('hide');
      $('div#sms_div').removeClass('hide');
    }
  });
  $('#send_notification_form').submit(function(e){
    e.preventDefault();
    tinyMCE.triggerSave();
    var data = $(this).serialize();
    $('#send_notification_btn').text("@lang('lang_v1.sending')...");
    $('#send_notification_btn').attr('disabled', 'disabled');
    $.ajax({
      method: "POST",
      url: $(this).attr("action"),
      dataType: "json",
      data: $(this).serialize(),
      success: function(result){
        if(result.success == true){
          $('div.view_modal').modal('hide');
          toastr.success(result.msg);
        } else {
          toastr.error(result.msg);
        }
        $('#send_notification_btn').text("@lang('lang_v1.send')");
        $('#send_notification_btn').removeAttr('disabled');
      }
    });
  });
</script>