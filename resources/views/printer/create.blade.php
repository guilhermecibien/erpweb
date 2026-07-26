@extends('layouts.app')
@section('title',  __('printer.add_printer'))

@section('content')
<style type="text/css">



</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('printer.add_printer')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
@php
$__f1 = ['options' => ['url' => action('PrinterController@store'), 'method' => 'post', 'id' => 'add_printer_form' ]];
@endphp
<x-form.open :options="$__f1['options']" />
	<div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f2 = ['name' => 'name', 'value' => __('printer.name') . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
              @php
              $__f3 = ['name' => 'name', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.printer_name_help')]];
              @endphp
              <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f4 = ['name' => 'connection_type', 'value' => __('printer.connection_type') . ':*'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            @php
            $__f5 = ['name' => 'connection_type', 'list' => $connection_types, 'selected' => null, 'options' => ['class' => 'form-control select2']];
            @endphp
            <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f6 = ['name' => 'capability_profile', 'value' => __('printer.capability_profile') . ':*'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            @show_tooltip(__('tooltip.capability_profile'))
            @php
            $__f7 = ['name' => 'capability_profile', 'list' => $capability_profiles, 'selected' => null, 'options' => ['class' => 'form-control select2']];
            @endphp
            <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f8 = ['name' => 'char_per_line', 'value' => __('printer.character_per_line') . ':*'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
              @php
              $__f9 = ['name' => 'char_per_line', 'value' => 42, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.char_per_line_help')]];
              @endphp
              <x-form.input type="number" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
          </div>
        </div>

        <div class="col-sm-12" id="ip_address_div">
          <div class="form-group">
            @php
            $__f10 = ['name' => 'ip_address', 'value' => __('printer.ip_address') . ':*'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
            @php
            $__f11 = ['name' => 'ip_address', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.ip_address_help')]];
            @endphp
            <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
          </div>
        </div>

        <div class="col-sm-12" id="port_div">
          <div class="form-group">
            @php
            $__f12 = ['name' => 'port', 'value' => __('printer.port') . ':*'];
            @endphp
            <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
              @php
              $__f13 = ['name' => 'port', 'value' => 9100, 'options' => ['class' => 'form-control', 'required']];
              @endphp
              <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
              <span class="help-block">@lang('lang_v1.port_help')</span>
          </div>
        </div>

        <div class="col-sm-12 hide" id="path_div">
          <div class="form-group">
            @php
            $__f14 = ['name' => 'path', 'value' => __('printer.path') . ':*'];
            @endphp
            <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
            @php
            $__f15 = ['name' => 'path', 'value' => null, 'options' => ['class' => 'form-control', 'required']];
            @endphp
            <x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
            <span class="help-block">
              <b>Connection Type Windows: </b> The device files will be along the lines of <code>LPT1</code> (parallel) or <code>COM1</code> (serial). <br/>
              <b>Connection Type Linux: </b> Your printer device file will be somewhere like <code>/dev/lp0</code> (parallel), <code>/dev/usb/lp1</code> (USB), <code>/dev/ttyUSB0</code> (USB-Serial), <code>/dev/ttyS0</code> (serial). <br/>
            </span>
          </div>
        </div>

        <div class="col-sm-12">
          <button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
        </div>
      </div>
    </div>
  </div>
  <x-form.close />
</section>
<!-- /.content -->
@endsection