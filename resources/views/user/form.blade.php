@php
  $custom_labels = json_decode(session('business.custom_labels'), true);
  $user_custom_field1 = !empty($custom_labels['user']['custom_field_1']) ? $custom_labels['user']['custom_field_1'] : __('lang_v1.user_custom_field1');
  $user_custom_field2 = !empty($custom_labels['user']['custom_field_2']) ? $custom_labels['user']['custom_field_2'] : __('lang_v1.user_custom_field2');
  $user_custom_field3 = !empty($custom_labels['user']['custom_field_3']) ? $custom_labels['user']['custom_field_3'] : __('lang_v1.user_custom_field3');
  $user_custom_field4 = !empty($custom_labels['user']['custom_field_4']) ? $custom_labels['user']['custom_field_4'] : __('lang_v1.user_custom_field4');
@endphp
<div class="form-group col-md-3">
    @php
    $__f1 = ['name' => 'user_dob', 'value' => __( 'lang_v1.dob' ) . ':'];
    @endphp
    <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
    @php
    $__f2 = ['name' => 'dob', 'value' => !empty($user->dob) ? \Carbon::createFromTimestamp(strtotime($user->dob))->format(session('business.date_format')) : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.dob'), 'readonly', 'id' => 'user_dob' ]];
    @endphp
    <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f3 = ['name' => 'gender', 'value' => 'Genero' . ':'];
    @endphp
    <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
    @php
    $__f4 = ['name' => 'gender', 'list' => ['male' => 'Masculino', 'female' => 'Feminino', 'others' => 'Outro'], 'selected' => !empty($user->gender) ? $user->gender : null, 'options' => ['class' => 'form-control', 'id' => 'gender', 'placeholder' => __( 'messages.please_select') ]];
    @endphp
    <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f5 = ['name' => 'marital_status', 'value' => __( 'lang_v1.marital_status' ) . ':'];
    @endphp
    <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
    @php
    $__f6 = ['name' => 'marital_status', 'list' => ['married' => 'Casado(a)', 'unmarried' => 'Solteiro(a)', 'divorced' => 'Divorciado(a)'], 'selected' => !empty($user->marital_status) ? $user->marital_status : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.marital_status') ]];
    @endphp
    <x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f7 = ['name' => 'blood_group', 'value' => __( 'lang_v1.blood_group' ) . ':'];
    @endphp
    <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
    @php
    $__f8 = ['name' => 'blood_group', 'value' => !empty($user->blood_group) ? $user->blood_group : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.blood_group') ]];
    @endphp
    <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
</div>
<div class="clearfix"></div>
<div class="form-group col-md-3">
    @php
    $__f9 = ['name' => 'contact_number', 'value' => __( 'lang_v1.contact_no' ) . ':'];
    @endphp
    <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
    @php
    $__f10 = ['name' => 'contact_number', 'value' => !empty($user->contact_number) ? $user->contact_number : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.contact_no') ]];
    @endphp
    <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f11 = ['name' => 'fb_link', 'value' => __( 'lang_v1.fb_link' ) . ':'];
    @endphp
    <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
    @php
    $__f12 = ['name' => 'fb_link', 'value' => !empty($user->fb_link) ? $user->fb_link : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.fb_link') ]];
    @endphp
    <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f13 = ['name' => 'twitter_link', 'value' => __( 'lang_v1.twitter_link' ) . ':'];
    @endphp
    <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
    @php
    $__f14 = ['name' => 'twitter_link', 'value' => !empty($user->twitter_link) ? $user->twitter_link : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.twitter_link') ]];
    @endphp
    <x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f15 = ['name' => 'social_media_1', 'value' => __( 'lang_v1.social_media', ['number' => 1] ) . ':'];
    @endphp
    <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
    @php
    $__f16 = ['name' => 'social_media_1', 'value' => !empty($user->social_media_1) ? $user->social_media_1 : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.social_media', ['number' => 1] ) ]];
    @endphp
    <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
</div>
<div class="clearfix"></div>
<div class="form-group col-md-3">
    @php
    $__f17 = ['name' => 'social_media_2', 'value' => __( 'lang_v1.social_media', ['number' => 2] ) . ':'];
    @endphp
    <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
    @php
    $__f18 = ['name' => 'social_media_2', 'value' => !empty($user->social_media_2) ? $user->social_media_2 : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.social_media', ['number' => 2] ) ]];
    @endphp
    <x-form.input type="text" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f19 = ['name' => 'custom_field_1', 'value' => $user_custom_field1 . ':'];
    @endphp
    <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
    @php
    $__f20 = ['name' => 'custom_field_1', 'value' => !empty($user->custom_field_1) ? $user->custom_field_1 : null, 'options' => ['class' => 'form-control', 'placeholder' => $user_custom_field1 ]];
    @endphp
    <x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f21 = ['name' => 'custom_field_2', 'value' => $user_custom_field2 . ':'];
    @endphp
    <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
    @php
    $__f22 = ['name' => 'custom_field_2', 'value' => !empty($user->custom_field_2) ? $user->custom_field_2 : null, 'options' => ['class' => 'form-control', 'placeholder' => $user_custom_field2 ]];
    @endphp
    <x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f23 = ['name' => 'custom_field_3', 'value' => $user_custom_field3 . ':'];
    @endphp
    <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
    @php
    $__f24 = ['name' => 'custom_field_3', 'value' => !empty($user->custom_field_3) ? $user->custom_field_3 : null, 'options' => ['class' => 'form-control', 'placeholder' => $user_custom_field3 ]];
    @endphp
    <x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f25 = ['name' => 'custom_field_4', 'value' => $user_custom_field4 . ':'];
    @endphp
    <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
    @php
    $__f26 = ['name' => 'custom_field_4', 'value' => !empty($user->custom_field_4) ? $user->custom_field_4 : null, 'options' => ['class' => 'form-control', 'placeholder' => $user_custom_field4 ]];
    @endphp
    <x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f27 = ['name' => 'guardian_name', 'value' => __( 'lang_v1.guardian_name') . ':'];
    @endphp
    <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
    @php
    $__f28 = ['name' => 'guardian_name', 'value' => !empty($user->guardian_name) ? $user->guardian_name : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.guardian_name' ) ]];
    @endphp
    <x-form.input type="text" :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f29 = ['name' => 'id_proof_name', 'value' => __( 'lang_v1.id_proof_name') . ':'];
    @endphp
    <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
    @php
    $__f30 = ['name' => 'id_proof_name', 'value' => !empty($user->id_proof_name) ? $user->id_proof_name : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.id_proof_name' ) ]];
    @endphp
    <x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f31 = ['name' => 'id_proof_number', 'value' => __( 'lang_v1.id_proof_number') . ':'];
    @endphp
    <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
    @php
    $__f32 = ['name' => 'id_proof_number', 'value' => !empty($user->id_proof_number) ? $user->id_proof_number : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.id_proof_number' ) ]];
    @endphp
    <x-form.input type="text" :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
</div>
<div class="clearfix"></div>
<div class="form-group col-md-6">
    @php
    $__f33 = ['name' => 'permanent_address', 'value' => __( 'lang_v1.permanent_address') . ':'];
    @endphp
    <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
    @php
    $__f34 = ['name' => 'permanent_address', 'value' => !empty($user->permanent_address) ? $user->permanent_address : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.permanent_address'), 'rows' => 3 ]];
    @endphp
    <x-form.textarea :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />
</div>
<div class="form-group col-md-6">
    @php
    $__f35 = ['name' => 'current_address', 'value' => __( 'lang_v1.current_address') . ':'];
    @endphp
    <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
    @php
    $__f36 = ['name' => 'current_address', 'value' => !empty($user->current_address) ? $user->current_address : null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.current_address'), 'rows' => 3 ]];
    @endphp
    <x-form.textarea :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
</div>
<div class="col-md-12">
    <hr>
    <h4>@lang('lang_v1.bank_details'):</h4>
</div>
<div class="form-group col-md-3">
    @php
    $__f37 = ['name' => 'account_holder_name', 'value' => __( 'lang_v1.account_holder_name') . ':'];
    @endphp
    <x-form.label :name="$__f37['name']" :value="$__f37['value']" />
    @php
    $__f38 = ['name' => 'bank_details[account_holder_name]', 'value' => !empty($bank_details['account_holder_name']) ? $bank_details['account_holder_name'] : null, 'options' => ['class' => 'form-control', 'id' => 'account_holder_name', 'placeholder' => __( 'lang_v1.account_holder_name') ]];
    @endphp
    <x-form.input type="text" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f39 = ['name' => 'account_number', 'value' => __( 'lang_v1.account_number') . ':'];
    @endphp
    <x-form.label :name="$__f39['name']" :value="$__f39['value']" />
    @php
    $__f40 = ['name' => 'bank_details[account_number]', 'value' => !empty($bank_details['account_number']) ? $bank_details['account_number'] : null, 'options' => ['class' => 'form-control', 'id' => 'account_number', 'placeholder' => __( 'lang_v1.account_number') ]];
    @endphp
    <x-form.input type="text" :name="$__f40['name']" :value="$__f40['value']" :options="$__f40['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f41 = ['name' => 'bank_name', 'value' => __( 'lang_v1.bank_name') . ':'];
    @endphp
    <x-form.label :name="$__f41['name']" :value="$__f41['value']" />
    @php
    $__f42 = ['name' => 'bank_details[bank_name]', 'value' => !empty($bank_details['bank_name']) ? $bank_details['bank_name'] : null, 'options' => ['class' => 'form-control', 'id' => 'bank_name', 'placeholder' => __( 'lang_v1.bank_name') ]];
    @endphp
    <x-form.input type="text" :name="$__f42['name']" :value="$__f42['value']" :options="$__f42['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f43 = ['name' => 'bank_code', 'value' => __( 'lang_v1.bank_code') . ':'];
    @endphp
    <x-form.label :name="$__f43['name']" :value="$__f43['value']" /> @show_tooltip(__('lang_v1.bank_code_help'))
    @php
    $__f44 = ['name' => 'bank_details[bank_code]', 'value' => !empty($bank_details['bank_code']) ? $bank_details['bank_code'] : null, 'options' => ['class' => 'form-control', 'id' => 'bank_code', 'placeholder' => __( 'lang_v1.bank_code') ]];
    @endphp
    <x-form.input type="text" :name="$__f44['name']" :value="$__f44['value']" :options="$__f44['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f45 = ['name' => 'branch', 'value' => __( 'lang_v1.branch') . ':'];
    @endphp
    <x-form.label :name="$__f45['name']" :value="$__f45['value']" />
    @php
    $__f46 = ['name' => 'bank_details[branch]', 'value' => !empty($bank_details['branch']) ? $bank_details['branch'] : null, 'options' => ['class' => 'form-control', 'id' => 'branch', 'placeholder' => __( 'lang_v1.branch') ]];
    @endphp
    <x-form.input type="text" :name="$__f46['name']" :value="$__f46['value']" :options="$__f46['options']" />
</div>
<div class="form-group col-md-3">
    @php
    $__f47 = ['name' => 'tax_payer_id', 'value' => __( 'lang_v1.tax_payer_id') . ':'];
    @endphp
    <x-form.label :name="$__f47['name']" :value="$__f47['value']" />
    @show_tooltip(__('lang_v1.tax_payer_id_help'))
    @php
    $__f48 = ['name' => 'bank_details[tax_payer_id]', 'value' => !empty($bank_details['tax_payer_id']) ? $bank_details['tax_payer_id'] : null, 'options' => ['class' => 'form-control', 'id' => 'tax_payer_id', 'placeholder' => __( 'lang_v1.tax_payer_id') ]];
    @endphp
    <x-form.input type="text" :name="$__f48['name']" :value="$__f48['value']" :options="$__f48['options']" />
</div>