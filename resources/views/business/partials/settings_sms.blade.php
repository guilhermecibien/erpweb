<div class="pos-tab-content">
    <div class="row">
        <div class="col-xs-3">
            <div class="form-group">
            	@php
            	$__f1 = ['name' => 'sms_settings_url', 'value' => 'URL:'];
            	@endphp
            	<x-form.label :name="$__f1['name']" :value="$__f1['value']" />
            	@php
            	$__f2 = ['name' => 'sms_settings[url]', 'value' => $sms_settings['url'], 'options' => ['class' => 'form-control','placeholder' => 'URL', 'id' => 'sms_settings_url']];
            	@endphp
            	<x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                @php
                $__f3 = ['name' => 'send_to_param_name', 'value' => __('lang_v1.send_to_param_name') . ':'];
                @endphp
                <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                @php
                $__f4 = ['name' => 'sms_settings[send_to_param_name]', 'value' => $sms_settings['send_to_param_name'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.send_to_param_name'), 'id' => 'send_to_param_name']];
                @endphp
                <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                @php
                $__f5 = ['name' => 'msg_param_name', 'value' => __('lang_v1.msg_param_name') . ':'];
                @endphp
                <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                @php
                $__f6 = ['name' => 'sms_settings[msg_param_name]', 'value' => $sms_settings['msg_param_name'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.msg_param_name'), 'id' => 'msg_param_name']];
                @endphp
                <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                @php
                $__f7 = ['name' => 'request_method', 'value' => __('lang_v1.request_method') . ':'];
                @endphp
                <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
                @php
                $__f8 = ['name' => 'sms_settings[request_method]', 'list' => ['get' => 'GET', 'post' => 'POST'], 'selected' => $sms_settings['request_method'], 'options' => ['class' => 'form-control', 'id' => 'request_method']];
                @endphp
                <x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f9 = ['name' => 'sms_settings_param_key1', 'value' => __('lang_v1.sms_settings_param_key', ['number' => 1]) . ':'];
                @endphp
                <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
                @php
                $__f10 = ['name' => 'sms_settings[param_1]', 'value' => $sms_settings['param_1'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 1]), 'id' => 'sms_settings_param_key1']];
                @endphp
                <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f11 = ['name' => 'sms_settings_param_val1', 'value' => __('lang_v1.sms_settings_param_val', ['number' => 1]) . ':'];
                @endphp
                <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
                @php
                $__f12 = ['name' => 'sms_settings[param_val_1]', 'value' => $sms_settings['param_val_1'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 1]), 'id' => 'sms_settings_param_val1' ]];
                @endphp
                <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f13 = ['name' => 'sms_settings_param_key2', 'value' => __('lang_v1.sms_settings_param_key', ['number' => 2]) . ':'];
                @endphp
                <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
                @php
                $__f14 = ['name' => 'sms_settings[param_2]', 'value' => $sms_settings['param_2'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 2]), 'id' => 'sms_settings_param_key2']];
                @endphp
                <x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f15 = ['name' => 'sms_settings_param_val2', 'value' => __('lang_v1.sms_settings_param_val', ['number' => 2]) . ':'];
                @endphp
                <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
                @php
                $__f16 = ['name' => 'sms_settings[param_val_2]', 'value' => $sms_settings['param_val_2'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 2]), 'id' => 'sms_settings_param_val2' ]];
                @endphp
                <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f17 = ['name' => 'sms_settings_param_key3', 'value' => __('lang_v1.sms_settings_param_key', ['number' => 3]) . ':'];
                @endphp
                <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
                @php
                $__f18 = ['name' => 'sms_settings[param_3]', 'value' => $sms_settings['param_3'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 3]), 'id' => 'sms_settings_param_key3']];
                @endphp
                <x-form.input type="text" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f19 = ['name' => 'sms_settings_param_val3', 'value' => __('lang_v1.sms_settings_param_val', ['number' => 3]) . ':'];
                @endphp
                <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
                @php
                $__f20 = ['name' => 'sms_settings[param_val_3]', 'value' => $sms_settings['param_val_3'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 3]), 'id' => 'sms_settings_param_val3' ]];
                @endphp
                <x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f21 = ['name' => 'sms_settings_param_key4', 'value' => __('lang_v1.sms_settings_param_key', ['number' => 4]) . ':'];
                @endphp
                <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
                @php
                $__f22 = ['name' => 'sms_settings[param_4]', 'value' => $sms_settings['param_4'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 4]), 'id' => 'sms_settings_param_key4']];
                @endphp
                <x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f23 = ['name' => 'sms_settings_param_val4', 'value' => __('lang_v1.sms_settings_param_val', ['number' => 4]) . ':'];
                @endphp
                <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
                @php
                $__f24 = ['name' => 'sms_settings[param_val_4]', 'value' => $sms_settings['param_val_4'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 4]), 'id' => 'sms_settings_param_val4' ]];
                @endphp
                <x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f25 = ['name' => 'sms_settings_param_key5', 'value' => __('lang_v1.sms_settings_param_key', ['number' => 5]) . ':'];
                @endphp
                <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
                @php
                $__f26 = ['name' => 'sms_settings[param_5]', 'value' => $sms_settings['param_5'], 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 5]), 'id' => 'sms_settings_param_key5']];
                @endphp
                <x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f27 = ['name' => 'sms_settings_param_val5', 'value' => __('lang_v1.sms_settings_param_val', ['number' => 5]) . ':'];
                @endphp
                <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
                @php
                $__f28 = ['name' => 'sms_settings[param_val_5]', 'value' => $sms_settings['param_val_5'], 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 5]), 'id' => 'sms_settings_param_val5' ]];
                @endphp
                <x-form.input type="text" :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f29 = ['name' => 'sms_settings_param_key6', 'value' => __('lang_v1.sms_settings_param_key', ['number' => 6]) . ':'];
                @endphp
                <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
                @php
                $__f30 = ['name' => 'sms_settings[param_6]', 'value' => !empty($sms_settings['param_6']) ? $sms_settings['param_6'] : null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 6]), 'id' => 'sms_settings_param_key6']];
                @endphp
                <x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f31 = ['name' => 'sms_settings_param_val6', 'value' => __('lang_v1.sms_settings_param_val', ['number' => 6]) . ':'];
                @endphp
                <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
                @php
                $__f32 = ['name' => 'sms_settings[param_val_6]', 'value' => !empty($sms_settings['param_val_6']) ? $sms_settings['param_val_6'] : null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 6]), 'id' => 'sms_settings_param_val6' ]];
                @endphp
                <x-form.input type="text" :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
            </div>
        </div>
         <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f33 = ['name' => 'sms_settings_param_key7', 'value' => __('lang_v1.sms_settings_param_key', ['number' => 7]) . ':'];
                @endphp
                <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
                @php
                $__f34 = ['name' => 'sms_settings[param_7]', 'value' => !empty($sms_settings['param_7']) ? $sms_settings['param_7'] : null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 7]), 'id' => 'sms_settings_param_key7']];
                @endphp
                <x-form.input type="text" :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f35 = ['name' => 'sms_settings_param_val7', 'value' => __('lang_v1.sms_settings_param_val', ['number' => 7]) . ':'];
                @endphp
                <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
                @php
                $__f36 = ['name' => 'sms_settings[param_val_7]', 'value' => !empty($sms_settings['param_val_7']) ? $sms_settings['param_val_7'] : null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 7]), 'id' => 'sms_settings_param_val7' ]];
                @endphp
                <x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f37 = ['name' => 'sms_settings_param_key8', 'value' => __('lang_v1.sms_settings_param_key', ['number' => 8]) . ':'];
                @endphp
                <x-form.label :name="$__f37['name']" :value="$__f37['value']" />
                @php
                $__f38 = ['name' => 'sms_settings[param_8]', 'value' => !empty($sms_settings['param_8']) ? $sms_settings['param_8'] : null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 8]), 'id' => 'sms_settings_param_key8']];
                @endphp
                <x-form.input type="text" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f39 = ['name' => 'sms_settings_param_val8', 'value' => __('lang_v1.sms_settings_param_val', ['number' => 8]) . ':'];
                @endphp
                <x-form.label :name="$__f39['name']" :value="$__f39['value']" />
                @php
                $__f40 = ['name' => 'sms_settings[param_val_8]', 'value' => !empty($sms_settings['param_val_8']) ? $sms_settings['param_val_8'] : null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 8]), 'id' => 'sms_settings_param_val8' ]];
                @endphp
                <x-form.input type="text" :name="$__f40['name']" :value="$__f40['value']" :options="$__f40['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f41 = ['name' => 'sms_settings_param_key9', 'value' => __('lang_v1.sms_settings_param_key', ['number' => 9]) . ':'];
                @endphp
                <x-form.label :name="$__f41['name']" :value="$__f41['value']" />
                @php
                $__f42 = ['name' => 'sms_settings[param_9]', 'value' => !empty($sms_settings['param_9']) ? $sms_settings['param_9'] : null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 9]), 'id' => 'sms_settings_param_key9']];
                @endphp
                <x-form.input type="text" :name="$__f42['name']" :value="$__f42['value']" :options="$__f42['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f43 = ['name' => 'sms_settings_param_val9', 'value' => __('lang_v1.sms_settings_param_val', ['number' => 9]) . ':'];
                @endphp
                <x-form.label :name="$__f43['name']" :value="$__f43['value']" />
                @php
                $__f44 = ['name' => 'sms_settings[param_val_9]', 'value' => !empty($sms_settings['param_val_9']) ? $sms_settings['param_val_9'] : null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 9]), 'id' => 'sms_settings_param_val9' ]];
                @endphp
                <x-form.input type="text" :name="$__f44['name']" :value="$__f44['value']" :options="$__f44['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f45 = ['name' => 'sms_settings_param_key10', 'value' => __('lang_v1.sms_settings_param_key', ['number' => 10]) . ':'];
                @endphp
                <x-form.label :name="$__f45['name']" :value="$__f45['value']" />
                @php
                $__f46 = ['name' => 'sms_settings[param_10]', 'value' => !empty($sms_settings['param_10']) ? $sms_settings['param_10'] : null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 10]), 'id' => 'sms_settings_param_key10']];
                @endphp
                <x-form.input type="text" :name="$__f46['name']" :value="$__f46['value']" :options="$__f46['options']" />
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                @php
                $__f47 = ['name' => 'sms_settings_param_val10', 'value' => __('lang_v1.sms_settings_param_val', ['number' => 10]) . ':'];
                @endphp
                <x-form.label :name="$__f47['name']" :value="$__f47['value']" />
                @php
                $__f48 = ['name' => 'sms_settings[param_val_10]', 'value' => !empty($sms_settings['param_val_10']) ? $sms_settings['param_val_10'] : null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_settings_param_val', ['number' => 10]), 'id' => 'sms_settings_param_val10' ]];
                @endphp
                <x-form.input type="text" :name="$__f48['name']" :value="$__f48['value']" :options="$__f48['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-8 col-xs-12">
            <div class="form-group">
                <div class="input-group">
                    @php
                    $__f49 = ['name' => 'test_number', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.test_number'), 'id' => 'test_number']];
                    @endphp
                    <x-form.input type="text" :name="$__f49['name']" :value="$__f49['value']" :options="$__f49['options']" />
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success pull-right" id="test_sms_btn">@lang('lang_v1.test_sms_configuration')</button>
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>