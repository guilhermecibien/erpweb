@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | Superadmin Settings')

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>@lang('superadmin::lang.super_admin_settings')</h1>
        <p>@lang('superadmin::lang.edit_super_admin_settings')</p>
    </div>
</section>

<section class="content sa-dashboard">
    {!! Form::open(['action' => '\Modules\Superadmin\Http\Controllers\SuperadminSettingsController@update', 'method' => 'put']) !!}

    <div class="sa-page-card sa-business-form">
        <div class="sa-page-card-body">
            <div class="row sa-settings-tabs pos-tab-container">
                <div class="col-md-2 col-sm-3 col-xs-12 pos-tab-menu">
                    <div class="list-group">
                        <a href="#" class="list-group-item active">@lang('superadmin::lang.super_admin_settings')</a>
                        <a href="#" class="list-group-item">@lang('superadmin::lang.application_settings')</a>
                        <a href="#" class="list-group-item">@lang('superadmin::lang.email_smtp_settings')</a>
                        <a href="#" class="list-group-item">@lang('superadmin::lang.payment_gateways')</a>
                        <a href="#" class="list-group-item">@lang('superadmin::lang.backup')</a>
                        <a href="#" class="list-group-item">@lang('superadmin::lang.cron')</a>
                        <a href="#" class="list-group-item">@lang('superadmin::lang.pusher_settings')</a>
                        <a href="#" class="list-group-item">@lang('superadmin::lang.additional_js_css')</a>
                    </div>
                </div>
                <div class="col-md-10 col-sm-9 col-xs-12 pos-tab">
                    @include('superadmin::superadmin_settings.partials.super_admin_settings')
                    @include('superadmin::superadmin_settings.partials.application_settings')
                    @include('superadmin::superadmin_settings.partials.email_smtp_settings')
                    @include('superadmin::superadmin_settings.partials.payment_gateways')
                    @include('superadmin::superadmin_settings.partials.backup')
                    @include('superadmin::superadmin_settings.partials.cron')
                    @include('superadmin::superadmin_settings.partials.pusher_setting')
                    @include('superadmin::superadmin_settings.partials.additional_js_css')
                </div>
            </div>
        </div>
    </div>

    <div class="sa-form-actions">
        {!! Form::submit('Atualizar', ['class' => 'sa-btn-pill sa-btn-pill-primary']) !!}
    </div>

    {!! Form::close() !!}
</section>
@stop
@section('javascript')
<script type="text/javascript">
    $(document).on('change', '#BACKUP_DISK', function() {
        if($(this).val() == 'dropbox'){
            $('div#dropbox_access_token_div').removeClass('hide');
        } else {
            $('div#dropbox_access_token_div').addClass('hide');
        }
    });

    $(document).ready( function(){
        if ($('#welcome_email_body').length) {
            tinymce.init({
                selector: 'textarea#welcome_email_body',
            });
        }

        if ($('#superadmin_register_tc').length) {
            tinymce.init({
                selector: 'textarea#superadmin_register_tc'
            });
        }
    });
</script>
@endsection
