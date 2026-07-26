@extends('layouts.app')
@section('title', __('lang_v1.my_profile'))

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>@lang('lang_v1.my_profile')</h1>
    </div>
</section>

<section class="content sa-dashboard">

@php
$__f1 = ['options' => ['url' => action('UserController@updatePassword'), 'method' => 'post', 'id' => 'edit_password_form', 'class' => 'form-horizontal' ]];
@endphp
<x-form.open :options="$__f1['options']" />
<div class="sa-page-card">
    <div class="sa-page-card-header">
        <i class="fa fa-lock"></i>
        <h3>@lang('user.change_password')</h3>
    </div>
    <div class="sa-page-card-body sa-business-form">
        <div class="form-group">
            @php
            $__f2 = ['name' => 'current_password', 'value' => __('user.current_password') . ':', 'options' => ['class' => 'col-sm-3 control-label']];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                    </span>
                    @php
                    $__f3 = ['name' => 'current_password', 'options' => ['class' => 'form-control','placeholder' => __('user.current_password'), 'required'], 'value' => ''];
                    @endphp
                    <x-form.input type="password" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
                </div>
            </div>
        </div>
        <div class="form-group">
            @php
            $__f4 = ['name' => 'new_password', 'value' => __('user.new_password') . ':', 'options' => ['class' => 'col-sm-3 control-label']];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                    </span>
                    @php
                    $__f5 = ['name' => 'new_password', 'options' => ['class' => 'form-control','placeholder' => __('user.new_password'), 'required'], 'value' => ''];
                    @endphp
                    <x-form.input type="password" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
                </div>
            </div>
        </div>
        <div class="form-group">
            @php
            $__f6 = ['name' => 'confirm_password', 'value' => __('user.confirm_new_password') . ':', 'options' => ['class' => 'col-sm-3 control-label']];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                    </span>
                    @php
                    $__f7 = ['name' => 'confirm_password', 'options' => ['class' => 'form-control','placeholder' =>  __('user.confirm_new_password'), 'required'], 'value' => ''];
                    @endphp
                    <x-form.input type="password" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                </div>
            </div>
        </div>
        <div class="sa-form-actions">
            <button type="submit" class="sa-btn-pill sa-btn-pill-primary">@lang('messages.update')</button>
        </div>
    </div>
</div>
<x-form.close />

@php
$__f9 = ['options' => ['url' => action('UserController@updateProfile'), 'method' => 'post', 'id' => 'edit_user_profile_form', 'files' => true ]];
@endphp
<x-form.open :options="$__f9['options']" />
<div class="row">
    <div class="col-sm-8">
        <div class="sa-page-card">
            <div class="sa-page-card-header">
                <i class="fa fa-user"></i>
                <h3>@lang('user.edit_profile')</h3>
            </div>
            <div class="sa-page-card-body sa-business-form">
                <div class="form-group col-md-2">
                    @php
                    $__f10 = ['name' => 'surname', 'value' => __('business.prefix') . ':'];
                    @endphp
                    <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        @php
                        $__f11 = ['name' => 'surname', 'value' => $user->surname, 'options' => ['class' => 'form-control','placeholder' => __('business.prefix_placeholder')]];
                        @endphp
                        <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
                    </div>
                </div>
                <div class="form-group col-md-5">
                    @php
                    $__f12 = ['name' => 'first_name', 'value' => __('business.first_name') . ':'];
                    @endphp
                    <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        @php
                        $__f13 = ['name' => 'first_name', 'value' => $user->first_name, 'options' => ['class' => 'form-control','placeholder' => __('business.first_name'), 'required']];
                        @endphp
                        <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
                    </div>
                </div>
                <div class="form-group col-md-5">
                    @php
                    $__f14 = ['name' => 'last_name', 'value' => 'Sobre nome' . ':'];
                    @endphp
                    <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        @php
                        $__f15 = ['name' => 'last_name', 'value' => $user->last_name, 'options' => ['class' => 'form-control','placeholder' => __('business.last_name')]];
                        @endphp
                        <x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    @php
                    $__f16 = ['name' => 'email', 'value' => __('business.email') . ':'];
                    @endphp
                    <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        @php
                        $__f17 = ['name' => 'email', 'value' => $user->email, 'options' => ['class' => 'form-control','placeholder' => __('business.email') ]];
                        @endphp
                        <x-form.input type="email" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    @php
                    $__f18 = ['name' => 'language', 'value' => 'Linguagem' . ':'];
                    @endphp
                    <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        @php
                        $__f19 = ['name' => 'language', 'list' => $languages, 'selected' => $user->language, 'options' => ['class' => 'form-control select2']];
                        @endphp
                        <x-form.select :name="$__f19['name']" :list="$__f19['list']" :selected="$__f19['selected']" :options="$__f19['options']" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sa-page-card">
            <div class="sa-page-card-header">
                <i class="fa fa-image"></i>
                <h3>@lang('lang_v1.profile_photo')</h3>
            </div>
            <div class="sa-page-card-body">
                @if(!empty($user->media))
                    <div class="col-md-12 text-center">
                        {!! $user->media->thumbnail([150, 150], 'img-circle') !!}
                    </div>
                @endif
                <div class="col-md-12">
                    <div class="form-group">
                        @php
                        $__f20 = ['name' => 'profile_photo', 'value' => __('lang_v1.upload_image') . ':'];
                        @endphp
                        <x-form.label :name="$__f20['name']" :value="$__f20['value']" />
                        @php
                        $__f21 = ['name' => 'profile_photo', 'options' => ['id' => 'profile_photo', 'accept' => 'image/*']];
                        @endphp
                        <x-form.input type="file" :name="$__f21['name']" :options="$__f21['options']" />
                        <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])</p></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('user.edit_profile_form_part', ['bank_details' => !empty($user->bank_details) ? json_decode($user->bank_details, true) : null])
<div class="sa-form-actions">
    <button type="submit" class="sa-btn-pill sa-btn-pill-primary">@lang('messages.update')</button>
</div>
<x-form.close />

</section>
<!-- /.content -->
@endsection