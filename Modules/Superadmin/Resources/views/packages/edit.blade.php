@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.packages'))

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>@lang('superadmin::lang.packages')</h1>
        <p>@lang('superadmin::lang.edit_package')</p>
    </div>
    <a href="{{action('\Modules\Superadmin\Http\Controllers\PackagesController@index')}}" class="sa-header-action">
        <i class="fa fa-arrow-left"></i> Voltar
    </a>
</section>

<section class="content sa-dashboard">

    <div class="sa-page-card">
        <div class="sa-page-card-body sa-business-form">
            {!! Form::open(['route' => ['packages.update', $packages->id], 'method' => 'put', 'id' => 'edit_package_form']) !!}

            <fieldset>
                <legend>Dados do plano</legend>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('name', 'Nome'.':') !!}
                            {!! Form::text('name',$packages->name, ['class' => 'form-control', 'required']); !!}
                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="form-group">
                            {!! Form::label('description', 'Descrição:') !!}
                            {!! Form::text('description', $packages->description, ['class' => 'form-control', 'required']); !!}
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('location_count', __('superadmin::lang.location_count').':') !!}
                            {!! Form::number('location_count', $packages->location_count, ['class' => 'form-control', 'required', 'min' => 0]); !!}
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('user_count', __('superadmin::lang.user_count').':') !!}
                            {!! Form::number('user_count', $packages->user_count, ['class' => 'form-control', 'required', 'min' => 0]); !!}
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('product_count', __('superadmin::lang.product_count').':') !!}
                            {!! Form::number('product_count', $packages->product_count, ['class' => 'form-control', 'required', 'min' => 0]); !!}
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('invoice_count', __('superadmin::lang.invoice_count').':') !!}
                            {!! Form::number('invoice_count', $packages->invoice_count, ['class' => 'form-control', 'required', 'min' => 0]); !!}
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('interval', __('superadmin::lang.interval').':') !!}
                            {!! Form::select('interval', $intervals, $packages->interval, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('interval_count	', __('superadmin::lang.interval_count').':') !!}
                            {!! Form::number('interval_count', $packages->interval_count, ['class' => 'form-control', 'required']); !!}
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('trial_days	', __('superadmin::lang.trial_days').':') !!}
                            {!! Form::number('trial_days', $packages->trial_days, ['class' => 'form-control', 'required', 'min' => 0]); !!}
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('price', __('superadmin::lang.price').':') !!}
                            {!! Form::text('price', number_format($packages->price, 2), ['class' => 'form-control money input_number', 'required']); !!}
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('sort_order	', __('superadmin::lang.sort_order').':') !!}
                            {!! Form::number('sort_order', $packages->sort_order, ['class' => 'form-control', 'required']); !!}
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Configurações</legend>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('is_private', 1, $packages->is_private, ['class' => 'input-icheck']); !!}
                                {{__('superadmin::lang.private_superadmin_only')}}
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('is_one_time', 1, $packages->is_one_time, ['class' => 'input-icheck']); !!}
                                {{__('superadmin::lang.one_time_only_subscription')}}
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('enable_custom_link', 1, $packages->enable_custom_link, ['class' => 'input-icheck', 'id' => 'enable_custom_link']); !!}
                                {{__('superadmin::lang.enable_custom_subscription_link')}}
                            </label>
                        </div>
                    </div>
                    <div id="custom_link_div" @if(empty($packages->enable_custom_link)) class="hide" @endif>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('custom_link', __('superadmin::lang.custom_link').':') !!}
                                {!! Form::text('custom_link', $packages->custom_link, ['class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('custom_link_text', __('superadmin::lang.custom_link_text').':') !!}
                                {!! Form::text('custom_link_text', $packages->custom_link_text, ['class' => 'form-control']); !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('is_active', 1, $packages->is_active, ['class' => 'input-icheck']); !!}
                                Ativo
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('is_visible', 1, $packages->is_visible, ['class' => 'input-icheck']); !!}
                                Visível para clientes
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('update_subscriptions', 1, false, ['class' => 'input-icheck']); !!}
                                {{__('superadmin::lang.update_existing_subscriptions')}}
                            </label>
                            @show_tooltip(__('superadmin::lang.update_existing_subscriptions_tooltip'))
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Permissões do plano</legend>
                <div class="row">
                    @foreach($permissions as $module => $module_permissions)
                    @foreach($module_permissions as $permission)
                    @php
                    $value = isset($packages->custom_permissions[$permission['name']]) ? $packages->custom_permissions[$permission['name']] : false;
                    @endphp
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox("custom_permissions[$permission[name]]", 1, $value, ['class' => 'input-icheck']); !!}
                                {{$permission['label']}}
                            </label>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </fieldset>

            @if(!empty($modules))
            <fieldset>
                <legend>Módulos do plano</legend>
                <div class="row">
                    @foreach($modules as $k => $v)
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('enabled_modules[]', $k, in_array($k, $enabled_modules_plan),
                                    ['class' => 'input-icheck']); !!} {{$v['name']}}
                                </label>
                                @if(!empty($v['tooltip'])) @show_tooltip($v['tooltip']) @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </fieldset>
            @endif

            <div class="sa-form-actions">
                {!! Form::submit(__('messages.save'), ['class' => 'sa-btn-pill sa-btn-pill-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

</section>

@endsection

@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
		$('form#edit_package_form').validate();
	});
	$('#enable_custom_link').on('ifChecked', function(event){
		$("div#custom_link_div").removeClass('hide');
	});
	$('#enable_custom_link').on('ifUnchecked', function(event){
		$("div#custom_link_div").addClass('hide');
	});
</script>
@endsection
