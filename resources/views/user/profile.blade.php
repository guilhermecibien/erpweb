@extends('layouts.app')
@section('title', __('lang_v1.my_profile'))

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>@lang('lang_v1.my_profile')</h1>
    </div>
</section>

<section class="content sa-dashboard">

{!! Form::open(['url' => action('UserController@updatePassword'), 'method' => 'post', 'id' => 'edit_password_form',
            'class' => 'form-horizontal' ]) !!}
<div class="sa-page-card">
    <div class="sa-page-card-header">
        <i class="fa fa-lock"></i>
        <h3>@lang('user.change_password')</h3>
    </div>
    <div class="sa-page-card-body sa-business-form">
        <div class="form-group">
            {!! Form::label('current_password', __('user.current_password') . ':', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                    </span>
                    {!! Form::password('current_password', ['class' => 'form-control','placeholder' => __('user.current_password'), 'required']); !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('new_password', __('user.new_password') . ':', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                    </span>
                    {!! Form::password('new_password', ['class' => 'form-control','placeholder' => __('user.new_password'), 'required']); !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('confirm_password', __('user.confirm_new_password') . ':', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                    </span>
                    {!! Form::password('confirm_password', ['class' => 'form-control','placeholder' =>  __('user.confirm_new_password'), 'required']); !!}
                </div>
            </div>
        </div>
        <div class="sa-form-actions">
            <button type="submit" class="sa-btn-pill sa-btn-pill-primary">@lang('messages.update')</button>
        </div>
    </div>
</div>
{!! Form::close() !!}

{!! Form::open(['url' => action('UserController@updateProfile'), 'method' => 'post', 'id' => 'edit_user_profile_form', 'files' => true ]) !!}
<div class="row">
    <div class="col-sm-8">
        <div class="sa-page-card">
            <div class="sa-page-card-header">
                <i class="fa fa-user"></i>
                <h3>@lang('user.edit_profile')</h3>
            </div>
            <div class="sa-page-card-body sa-business-form">
                <div class="form-group col-md-2">
                    {!! Form::label('surname', __('business.prefix') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        {!! Form::text('surname', $user->surname, ['class' => 'form-control','placeholder' => __('business.prefix_placeholder')]); !!}
                    </div>
                </div>
                <div class="form-group col-md-5">
                    {!! Form::label('first_name', __('business.first_name') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        {!! Form::text('first_name', $user->first_name, ['class' => 'form-control','placeholder' => __('business.first_name'), 'required']); !!}
                    </div>
                </div>
                <div class="form-group col-md-5">
                    {!! Form::label('last_name', 'Sobre nome' . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        {!! Form::text('last_name', $user->last_name, ['class' => 'form-control','placeholder' => __('business.last_name')]); !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('email', __('business.email') . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        {!! Form::email('email',  $user->email, ['class' => 'form-control','placeholder' => __('business.email') ]); !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('language', 'Linguagem' . ':') !!}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-info"></i>
                        </span>
                        {!! Form::select('language',$languages, $user->language, ['class' => 'form-control select2']); !!}
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
                        {!! Form::label('profile_photo', __('lang_v1.upload_image') . ':') !!}
                        {!! Form::file('profile_photo', ['id' => 'profile_photo', 'accept' => 'image/*']); !!}
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
{!! Form::close() !!}

</section>
<!-- /.content -->
@endsection