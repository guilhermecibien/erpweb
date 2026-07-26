@if(empty($is_admin))
<h3>@lang('business.business')</h3>
@endif
@php
$__f1 = ['name' => 'language', 'value' => request()->lang];
@endphp
<x-form.input type="hidden" :name="$__f1['name']" :value="$__f1['value']" />

<fieldset>
    <legend>@lang('business.business_details'):</legend>
    <div class="col-md-12">
        <div class="form-group">
            @php
            $__f2 = ['name' => 'name', 'value' => __('business.business_name') . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-suitcase"></i>
                </span>
                @php
                $__f3 = ['name' => 'name', 'value' => '', 'options' => ['class' => 'form-control','placeholder' => __('business.business_name'), 'required']];
                @endphp
                <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
            </div>
        </div>
    </div>

    <input type="hidden" value="" name="start_date" id="start_date">
    <input type="hidden" value="18" name="currency_id" id="currency_id">

    <div class="clearfix"></div>
    <!-- <div class="col-md-6">
        <div class="form-group">
            @php
            $__f4 = ['name' => 'business_logo', 'value' => __('business.upload_logo') . ':'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            @php
            $__f5 = ['name' => 'business_logo', 'options' => ['accept' => 'image/*']];
            @endphp
            <x-form.input type="file" :name="$__f5['name']" :options="$__f5['options']" />
        </div>
    </div> -->
    <!-- <div class="col-md-6">
        <div class="form-group">
            @php
            $__f6 = ['name' => 'website', 'value' => __('lang_v1.website') . ':'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-globe"></i>
                </span>
                @php
                $__f7 = ['name' => 'website', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.website')]];
                @endphp
                <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
            </div>
        </div>
    </div> -->
    <!-- <div class="clearfix"></div> -->
    <div class="col-md-6">
        <div class="form-group">
            @php
            $__f8 = ['name' => 'mobile', 'value' => 'Telefone:'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-phone"></i>
                </span>
                @php
                $__f9 = ['name' => 'mobile', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.business_telephone')]];
                @endphp
                <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
            </div>
        </div>
    </div>

    <!-- <div class="col-md-6">
        <div class="form-group">
            @php
            $__f10 = ['name' => 'alternate_number', 'value' => __('business.alternate_number') . ':'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-phone"></i>
                </span>
                @php
                $__f11 = ['name' => 'alternate_number', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __('business.alternate_number')]];
                @endphp
                <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
            </div>
        </div>
    </div> -->

    <!-- <div class="clearfix"></div> -->

    <!-- div class="col-md-6">
        <div class="form-group">
            @php
            $__f12 = ['name' => 'country', 'value' => __('business.country') . ':*'];
            @endphp
            <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-globe"></i>
                </span>
                @php
                $__f13 = ['name' => 'country', 'value' => '', 'options' => ['class' => 'form-control','placeholder' => __('business.country'), 'required']];
                @endphp
                <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
            </div>
        </div>
    </div> -->

    
    <!-- <div class="clearfix"></div> -->
    <div class="col-md-6">
        <div class="form-group">
            @php
            $__f14 = ['name' => 'city', 'value' => __('business.city'). ':*'];
            @endphp
            <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                </span>
                @php
                $__f15 = ['name' => 'city', 'value' => '', 'options' => ['class' => 'form-control','placeholder' => __('business.city'), 'required']];
                @endphp
                <x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            @php
            $__f16 = ['name' => 'state', 'value' => __('business.state') . ':*'];
            @endphp
            <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                </span>
                @php
                $__f17 = ['name' => 'state', 'value' => '', 'options' => ['class' => 'form-control','placeholder' => __('business.state'), 'required', 'oninvalid="this.setCustomValidity(\'Campo requerido\')"']];
                @endphp
                <x-form.input type="text" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @php
            $__f18 = ['name' => 'zip_code', 'value' => __('business.zip_code') . ':*'];
            @endphp
            <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                </span>
                @php
                $__f19 = ['name' => 'zip_code', 'value' => '', 'options' => ['class' => 'form-control','placeholder' => 'CEP', 'required', 'data-mask="00000-000"']];
                @endphp
                <x-form.input type="text" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
            </div>
        </div>
    </div>
    <!-- <div class="clearfix"></div> -->
    <div class="col-md-6 hide">
        <div class="form-group">
            @php
            $__f20 = ['name' => 'landmark', 'value' => __('business.landmark') . ':*'];
            @endphp
            <x-form.label :name="$__f20['name']" :value="$__f20['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                </span>
                @php
                $__f21 = ['name' => 'landmark', 'value' => 'Nenhum', 'options' => ['class' => 'form-control','placeholder' => __('business.landmark'), 'required']];
                @endphp
                <x-form.input type="text" :name="$__f21['name']" :value="$__f21['value']" :options="$__f21['options']" />
            </div>
        </div>
    </div>
    <div class="col-md-6 hide">
        <div class="form-group">
            @php
            $__f22 = ['name' => 'time_zone', 'value' => __('business.time_zone') . ':*'];
            @endphp
            <x-form.label :name="$__f22['name']" :value="$__f22['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fas fa-clock"></i>
                </span>
                @php
                $__f23 = ['name' => 'time_zone', 'list' => $timezone_list, 'selected' => config('app.timezone'), 'options' => ['class' => 'form-control select2_register','placeholder' => __('business.time_zone'), 'required']];
                @endphp
                <x-form.select :name="$__f23['name']" :list="$__f23['list']" :selected="$__f23['selected']" :options="$__f23['options']" />
            </div>
        </div>
    </div>
</fieldset>

<!-- tax details -->
@if(empty($is_admin))
<div style="display: none">
    <h3>@lang('business.business_settings')</h3>

    <fieldset>
        <legend>@lang('business.business_settings'):</legend>
        <div class="col-md-6" style="display: none">
            <div class="form-group">
                @php
                $__f24 = ['name' => 'tax_label_1', 'value' => __('business.tax_1_name') . ':'];
                @endphp
                <x-form.label :name="$__f24['name']" :value="$__f24['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    @php
                    $__f25 = ['name' => 'tax_label_1', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __('business.tax_1_placeholder')]];
                    @endphp
                    <x-form.input type="text" :name="$__f25['name']" :value="$__f25['value']" :options="$__f25['options']" />
                </div>
            </div>
        </div>

        <div class="col-md-6" style="display: none">
            <div class="form-group">
                @php
                $__f26 = ['name' => 'tax_number_1', 'value' => __('business.tax_1_no') . ':'];
                @endphp
                <x-form.label :name="$__f26['name']" :value="$__f26['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    @php
                    $__f27 = ['name' => 'tax_number_1', 'value' => null, 'options' => ['class' => 'form-control']];
                    @endphp
                    <x-form.input type="text" :name="$__f27['name']" :value="$__f27['value']" :options="$__f27['options']" />
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6" style="display: none">
            <div class="form-group">
                @php
                $__f28 = ['name' => 'tax_label_2', 'value' => __('business.tax_2_name') . ':'];
                @endphp
                <x-form.label :name="$__f28['name']" :value="$__f28['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    @php
                    $__f29 = ['name' => 'tax_label_2', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __('business.tax_1_placeholder')]];
                    @endphp
                    <x-form.input type="text" :name="$__f29['name']" :value="$__f29['value']" :options="$__f29['options']" />
                </div>
            </div>
        </div>

        <div class="col-md-6" style="display: none">
            <div class="form-group">
                @php
                $__f30 = ['name' => 'tax_number_2', 'value' => __('business.tax_2_no') . ':'];
                @endphp
                <x-form.label :name="$__f30['name']" :value="$__f30['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    @php
                    $__f31 = ['name' => 'tax_number_2', 'value' => null, 'options' => ['class' => 'form-control',]];
                    @endphp
                    <x-form.input type="text" :name="$__f31['name']" :value="$__f31['value']" :options="$__f31['options']" />
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group">
                @php
                $__f32 = ['name' => 'fy_start_month', 'value' => __('business.fy_start_month') . ':*'];
                @endphp
                <x-form.label :name="$__f32['name']" :value="$__f32['value']" /> @show_tooltip(__('tooltip.fy_start_month'))
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    @php
                    $__f33 = ['name' => 'fy_start_month', 'list' => $months, 'selected' => null, 'options' => ['class' => 'form-control select2_register', 'required', 'style' => 'width:100%;']];
                    @endphp
                    <x-form.select :name="$__f33['name']" :list="$__f33['list']" :selected="$__f33['selected']" :options="$__f33['options']" />
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                @php
                $__f34 = ['name' => 'accounting_method', 'value' => __('business.accounting_method') . ':*'];
                @endphp
                <x-form.label :name="$__f34['name']" :value="$__f34['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calculator"></i>
                    </span>
                    @php
                    $__f35 = ['name' => 'accounting_method', 'list' => $accounting_methods, 'selected' => null, 'options' => ['class' => 'form-control select2_register', 'required', 'style' => 'width:100%;']];
                    @endphp
                    <x-form.select :name="$__f35['name']" :list="$__f35['list']" :selected="$__f35['selected']" :options="$__f35['options']" />
                </div>
            </div>
        </div>
    </fieldset>
</div>
@endif

<!-- Owner Information -->
@if(empty($is_admin))
<h3>Proprietário</h3>
@endif

<fieldset>
    <legend>@lang('business.owner_info')</legend>
    <div class="col-md-4">
        <div class="form-group">
            @php
            $__f36 = ['name' => 'surname', 'value' => __('business.prefix') . ':'];
            @endphp
            <x-form.label :name="$__f36['name']" :value="$__f36['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                @php
                $__f37 = ['name' => 'surname', 'value' => 'Sr', 'options' => ['class' => 'form-control','placeholder' => __('business.prefix_placeholder')]];
                @endphp
                <x-form.input type="text" :name="$__f37['name']" :value="$__f37['value']" :options="$__f37['options']" />
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            @php
            $__f38 = ['name' => 'first_name', 'value' => __('business.first_name') . ':*'];
            @endphp
            <x-form.label :name="$__f38['name']" :value="$__f38['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                @php
                $__f39 = ['name' => 'first_name', 'value' => '', 'options' => ['class' => 'form-control','placeholder' => __('business.first_name'), 'required']];
                @endphp
                <x-form.input type="text" :name="$__f39['name']" :value="$__f39['value']" :options="$__f39['options']" />
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            @php
            $__f40 = ['name' => 'last_name', 'value' => 'Sobrenome' . ':'];
            @endphp
            <x-form.label :name="$__f40['name']" :value="$__f40['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                @php
                $__f41 = ['name' => 'last_name', 'value' => '', 'options' => ['class' => 'form-control','placeholder' =>  __('business.last_name')]];
                @endphp
                <x-form.input type="text" :name="$__f41['name']" :value="$__f41['value']" :options="$__f41['options']" />
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
        <div class="form-group">
            @php
            $__f42 = ['name' => 'username', 'value' => __('business.username') . ':*'];
            @endphp
            <x-form.label :name="$__f42['name']" :value="$__f42['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                </span>
                @php
                $__f43 = ['name' => 'username', 'value' => '', 'options' => ['class' => 'form-control','placeholder' => __('business.username'), 'required']];
                @endphp
                <x-form.input type="text" :name="$__f43['name']" :value="$__f43['value']" :options="$__f43['options']" />
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            @php
            $__f44 = ['name' => 'email', 'value' => __('business.email') . ':'];
            @endphp
            <x-form.label :name="$__f44['name']" :value="$__f44['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                </span>
                @php
                $__f45 = ['name' => 'email', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __('business.email')]];
                @endphp
                <x-form.input type="text" :name="$__f45['name']" :value="$__f45['value']" :options="$__f45['options']" />
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
        <div class="form-group">
            @php
            $__f46 = ['name' => 'password', 'value' => 'Senha' . ':*'];
            @endphp
            <x-form.label :name="$__f46['name']" :value="$__f46['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-lock"></i>
                </span>
                @php
                $__f47 = ['name' => 'password', 'options' => ['class' => 'form-control','placeholder' => 'Senha', 'required'], 'value' => ''];
                @endphp
                <x-form.input type="password" :name="$__f47['name']" :value="$__f47['value']" :options="$__f47['options']" />
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            @php
            $__f48 = ['name' => 'confirm_password', 'value' => __('business.confirm_password') . ':*'];
            @endphp
            <x-form.label :name="$__f48['name']" :value="$__f48['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-lock"></i>
                </span>
                @php
                $__f49 = ['name' => 'confirm_password', 'options' => ['class' => 'form-control','placeholder' => __('business.confirm_password'), 'required'], 'value' => ''];
                @endphp
                <x-form.input type="password" :name="$__f49['name']" :value="$__f49['value']" :options="$__f49['options']" />
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
        @if(!empty($system_settings['superadmin_enable_register_tc']))
        <div class="form-group">
            <label>
                @php
                $__f50 = ['name' => 'accept_tc', 'value' => 0, 'checked' => false, 'options' => ['required', 'class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f50['name']" :value="$__f50['value']" :checked="$__f50['checked']" :options="$__f50['options']" />
                <u><a class="terms_condition cursor-pointer" data-toggle="modal" data-target="#tc_modal">
                    @lang('lang_v1.accept_terms_and_conditions') <i></i>
                </a></u>
            </label>
        </div>
        @include('business.partials.terms_conditions')
        @endif
    </div>
    <div class="clearfix"></div>
</fieldset>
