@extends('layouts.auth')

@section('content')

<div class="row">

    <h1 class="page-header text-center">{{ config('app.name', 'ultimatePOS') }}</h2>
    
    <div class="col-md-8 col-md-offset-2">
        
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title text-center">Register and Get Started in minutes</h3>
            </div>

            @php
            $__f1 = ['options' => ['url' => {{ route('business.postRegister') }}]];
            @endphp
            <x-form.open :options="$__f1['options']" />
            <x-form.token />

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            @php
                            $__f3 = ['name' => 'name', 'value' => 'Business Name:'];
                            @endphp
                            <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-suitcase"></i>
                                </span>
                                @php
                                $__f4 = ['name' => 'name', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Business name']];
                                @endphp
                                <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f5 = ['name' => 'start_date', 'value' => 'Start Date:'];
                        @endphp
                        <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            @php
                            $__f6 = ['name' => 'start_date', 'value' => null, 'options' => ['class' => 'form-control start-date-picker','placeholder' => 'Start Date', 'readonly']];
                            @endphp
                            <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f7 = ['name' => 'currency', 'value' => 'Currency:'];
                        @endphp
                        <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fas fa-money-bill-alt"></i>
                            </span>
                            @php
                            $__f8 = ['name' => 'currency', 'list' => $currencies, 'selected' => '', 'options' => ['class' => 'form-control','placeholder' => 'Select Currency']];
                            @endphp
                            <x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
                        </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                        @php
                        $__f9 = ['name' => 'country', 'value' => 'Country:'];
                        @endphp
                        <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-globe"></i>
                            </span>
                            @php
                            $__f10 = ['name' => 'country', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Country']];
                            @endphp
                            <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        @php
                        $__f11 = ['name' => 'state', 'value' => 'State:'];
                        @endphp
                        <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            @php
                            $__f12 = ['name' => 'state', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'State']];
                            @endphp
                            <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        @php
                        $__f13 = ['name' => 'city', 'value' => 'City:'];
                        @endphp
                        <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            @php
                            $__f14 = ['name' => 'city', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'City']];
                            @endphp
                            <x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f15 = ['name' => 'zip_code', 'value' => 'Zip Code:'];
                        @endphp
                        <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            @php
                            $__f16 = ['name' => 'zip_code', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Zip/Postal Code']];
                            @endphp
                            <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f17 = ['name' => 'landmark', 'value' => 'Landmark:'];
                        @endphp
                        <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            @php
                            $__f18 = ['name' => 'landmark', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Landmark']];
                            @endphp
                            <x-form.input type="text" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr/>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f19 = ['name' => 'tax_label_1', 'value' => 'Tax 1 Name:'];
                        @endphp
                        <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            @php
                            $__f20 = ['name' => 'tax_label_1', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'GST / VAT / Other']];
                            @endphp
                            <x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f21 = ['name' => 'tax_number_1', 'value' => 'Tax 1 No.:'];
                        @endphp
                        <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            @php
                            $__f22 = ['name' => 'tax_number_1', 'value' => null, 'options' => ['class' => 'form-control',]];
                            @endphp
                            <x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f23 = ['name' => 'tax_label_2', 'value' => 'Tax 2 Name:'];
                        @endphp
                        <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            @php
                            $__f24 = ['name' => 'tax_label_2', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'GST / VAT / Other']];
                            @endphp
                            <x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f25 = ['name' => 'tax_number_2', 'value' => 'Tax 2 No.:'];
                        @endphp
                        <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            @php
                            $__f26 = ['name' => 'tax_number_2', 'value' => null, 'options' => ['class' => 'form-control',]];
                            @endphp
                            <x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr/>
                    </div>

                    <!-- Owner Information -->
                    <div class="col-md-4">
                        <div class="form-group">
                        @php
                        $__f27 = ['name' => 'surname', 'value' => 'Surname:'];
                        @endphp
                        <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            @php
                            $__f28 = ['name' => 'surname', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'GST / VAT / Other']];
                            @endphp
                            <x-form.input type="text" :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        @php
                        $__f29 = ['name' => 'first_name', 'value' => 'First Name:'];
                        @endphp
                        <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            @php
                            $__f30 = ['name' => 'first_name', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Owner Name']];
                            @endphp
                            <x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        @php
                        $__f31 = ['name' => 'last_name', 'value' => 'Last Name:'];
                        @endphp
                        <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            @php
                            $__f32 = ['name' => 'last_name', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Owner Name']];
                            @endphp
                            <x-form.input type="text" :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f33 = ['name' => 'username', 'value' => 'Username:'];
                        @endphp
                        <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            @php
                            $__f34 = ['name' => 'username', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Username used for login']];
                            @endphp
                            <x-form.input type="text" :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f35 = ['name' => 'email', 'value' => 'Email:'];
                        @endphp
                        <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </span>
                            @php
                            $__f36 = ['name' => 'email', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => '']];
                            @endphp
                            <x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f37 = ['name' => 'password', 'value' => 'Password:'];
                        @endphp
                        <x-form.label :name="$__f37['name']" :value="$__f37['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-lock"></i>
                            </span>
                            @php
                            $__f38 = ['name' => 'password', 'options' => ['class' => 'form-control','placeholder' => 'Login Password'], 'value' => ''];
                            @endphp
                            <x-form.input type="password" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        @php
                        $__f39 = ['name' => 'confirm_password', 'value' => 'Confirm Password:'];
                        @endphp
                        <x-form.label :name="$__f39['name']" :value="$__f39['value']" />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-lock"></i>
                            </span>
                            @php
                            $__f40 = ['name' => 'confirm_password', 'options' => ['class' => 'form-control','placeholder' => 'Same as Login Password'], 'value' => ''];
                            @endphp
                            <x-form.input type="password" :name="$__f40['name']" :value="$__f40['value']" :options="$__f40['options']" />
                        </div>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                
                <div class="box-footer">
                    <button type="button" class="btn btn-success pull-right">Register</button>
                </div>

            <x-form.close />
            
        </div>
          <!-- /.box -->
    </div>

</div>

@endsection