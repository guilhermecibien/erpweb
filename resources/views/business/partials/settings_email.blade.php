<div class="pos-tab-content">
    <div class="row">
        @if(!empty($allow_superadmin_email_settings))
        <div class="col-xs-12">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f1 = ['name' => 'email_settings[use_superadmin_settings]', 'value' => 1, 'checked' => !empty($email_settings['use_superadmin_settings']), 'options' => [ 'class' => 'input-icheck', 'id' => 'use_superadmin_settings']];
                    @endphp
                    <x-form.checkbox :name="$__f1['name']" :value="$__f1['value']" :checked="$__f1['checked']" :options="$__f1['options']" /> {{ __( 'lang_v1.use_superadmin_email_settings' ) }}
                  </label>
                </div>
            </div>
        </div>
        @endif
        <div id="toggle_visibility" @if(!empty($email_settings['use_superadmin_settings'])) class="hide" @endif>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f2 = ['name' => 'mail_driver', 'value' => __('lang_v1.mail_driver') . ':'];
                @endphp
                <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
                @php
                $__f3 = ['name' => 'email_settings[mail_driver]', 'list' => $mail_drivers, 'selected' => !empty($email_settings['mail_driver']) ? $email_settings['mail_driver'] : 'smtp', 'options' => ['class' => 'form-control', 'id' => 'mail_driver']];
                @endphp
                <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
            	@php
            	$__f4 = ['name' => 'mail_host', 'value' => __('lang_v1.mail_host') . ':'];
            	@endphp
            	<x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            	@php
            	$__f5 = ['name' => 'email_settings[mail_host]', 'value' => $email_settings['mail_host'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.mail_host'), 'id' => 'mail_host']];
            	@endphp
            	<x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
            	@php
            	$__f6 = ['name' => 'mail_port', 'value' => __('lang_v1.mail_port') . ':'];
            	@endphp
            	<x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            	@php
            	$__f7 = ['name' => 'email_settings[mail_port]', 'value' => $email_settings['mail_port'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.mail_port'), 'id' => 'mail_port']];
            	@endphp
            	<x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f8 = ['name' => 'mail_username', 'value' => __('lang_v1.mail_username') . ':'];
                @endphp
                <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
                @php
                $__f9 = ['name' => 'email_settings[mail_username]', 'value' => $email_settings['mail_username'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.mail_username'), 'id' => 'mail_username']];
                @endphp
                <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f10 = ['name' => 'mail_password', 'value' => __('lang_v1.mail_password') . ':'];
                @endphp
                <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
                <input type="password" name="email_settings[mail_password]" value="{{$email_settings['mail_password']}}" class="form-control" placeholder="{{__('lang_v1.mail_password')}}", id="mail_password">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f11 = ['name' => 'mail_encryption', 'value' => __('lang_v1.mail_encryption') . ':'];
                @endphp
                <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
                @php
                $__f12 = ['name' => 'email_settings[mail_encryption]', 'value' => $email_settings['mail_encryption'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.mail_encryption_place'), 'id' => 'mail_encryption']];
                @endphp
                <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f13 = ['name' => 'mail_from_address', 'value' => __('lang_v1.mail_from_address') . ':'];
                @endphp
                <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
                @php
                $__f14 = ['name' => 'email_settings[mail_from_address]', 'value' => $email_settings['mail_from_address'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.mail_from_address'), 'id' => 'mail_from_address' ]];
                @endphp
                <x-form.input type="email" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
            </div>
        </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f15 = ['name' => 'mail_from_name', 'value' => __('lang_v1.mail_from_name') . ':'];
                @endphp
                <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
                @php
                $__f16 = ['name' => 'email_settings[mail_from_name]', 'value' => $email_settings['mail_from_name'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.mail_from_name'), 'id' => 'mail_from_name']];
                @endphp
                <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 test_email_btn @if(!empty($email_settings['use_superadmin_settings'])) hide @endif">
            <button type="button" class="btn btn-success pull-right" id="test_email_btn">@lang('lang_v1.test_email_configuration')</button>
        </div>
    </div>
</div>