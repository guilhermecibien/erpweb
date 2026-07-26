<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach($templates as $key => $value)
            <li @if($loop->index == 0) class="active" @endif>
                <a href="#cn_{{$key}}" data-toggle="tab" aria-expanded="true">
                {{$value['name']}} </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach($templates as $key => $value)
            <div class="tab-pane @if($loop->index == 0) active @endif" id="cn_{{$key}}">
                <div class="row">
                <div class="col-md-12">
                    @if(!empty($value['extra_tags']))
                        <strong>@lang('lang_v1.available_tags'):</strong>
                    <p class="text-primary">{{implode(', ', $value['extra_tags'])}}</p>
                    @endif
                    @if(!empty($value['help_text']))
                    <p class="help-block">{{$value['help_text']}}</p>
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        @php
                        $__f1 = ['name' => $key . '_subject', 'value' => __('lang_v1.email_subject').':'];
                        @endphp
                        <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                        @php
                        $__f2 = ['name' => 'template_data[' . $key . '][subject]', 'value' => $value['subject'], 'options' => ['class' => 'form-control' , 'placeholder' => __('lang_v1.email_subject'), 'id' => $key . '_subject']];
                        @endphp
                        <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        @php
                        $__f3 = ['name' => $key . '_cc', 'value' => 'CC:'];
                        @endphp
                        <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                        @php
                        $__f4 = ['name' => 'template_data[' . $key . '][cc]', 'value' => $value['cc'], 'options' => ['class' => 'form-control' , 'placeholder' => 'CC', 'id' => $key . '_cc']];
                        @endphp
                        <x-form.input type="email" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        @php
                        $__f5 = ['name' => $key . '_bcc', 'value' => 'BCC:'];
                        @endphp
                        <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                        @php
                        $__f6 = ['name' => 'template_data[' . $key . '][bcc]', 'value' => $value['bcc'], 'options' => ['class' => 'form-control' , 'placeholder' => 'BCC', 'id' => $key . '_bcc']];
                        @endphp
                        <x-form.input type="email" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        @php
                        $__f7 = ['name' => $key . '_email_body', 'value' => __('lang_v1.email_body').':'];
                        @endphp
                        <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
                        @php
                        $__f8 = ['name' => 'template_data[' . $key . '][email_body]', 'value' => $value['email_body'], 'options' => ['class' => 'form-control ckeditor' , 'placeholder' => __('lang_v1.email_body'), 'id' => $key . '_email_body', 'rows' => 6]];
                        @endphp
                        <x-form.textarea :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
                    </div>
                </div>
                <div class="col-md-12 @if($key == 'send_ledger') hide @endif">
                    <div class="form-group">
                        @php
                        $__f9 = ['name' => $key . '_sms_body', 'value' => __('lang_v1.sms_body').':'];
                        @endphp
                        <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
                        @php
                        $__f10 = ['name' => 'template_data[' . $key . '][sms_body]', 'value' => $value['sms_body'], 'options' => ['class' => 'form-control' , 'placeholder' => __('lang_v1.sms_body'), 'id' => $key . '_sms_body', 'rows' => 6]];
                        @endphp
                        <x-form.textarea :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
                    </div>
                </div>
                @if($key == 'new_sale')
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="checkbox-inline">
                                @php
                                $__f11 = ['name' => 'template_data[' . $key . '][auto_send]', 'value' => 1, 'checked' => $value['auto_send'], 'options' => ['class' => 'input-icheck']];
                                @endphp
                                <x-form.checkbox :name="$__f11['name']" :value="$__f11['value']" :checked="$__f11['checked']" :options="$__f11['options']" /> @lang('lang_v1.autosend_email')
                            </label>
                            <label class="checkbox-inline">
                                @php
                                $__f12 = ['name' => 'template_data[' . $key . '][auto_send_sms]', 'value' => 1, 'checked' => $value['auto_send_sms'], 'options' => ['class' => 'input-icheck']];
                                @endphp
                                <x-form.checkbox :name="$__f12['name']" :value="$__f12['value']" :checked="$__f12['checked']" :options="$__f12['options']" /> @lang('lang_v1.autosend_sms')
                            </label>
                        </div>
                    </div>
                @endif
                </div>
            </div>
        @endforeach
    </div>
</div>