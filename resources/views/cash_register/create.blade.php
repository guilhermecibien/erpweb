@extends('layouts.app')
@section('title',  __('cash_register.open_cash_register'))

@section('content')
<style type="text/css">



</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('cash_register.open_cash_register')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
@php
$__f1 = ['options' => ['url' => action('CashRegisterController@store'), 'method' => 'post', 'id' => 'add_cash_register_form' ]];
@endphp
<x-form.open :options="$__f1['options']" />
  <div class="box box-solid">
    <div class="box-body">
    <br><br><br>
    <input type="hidden" name="sub_type" value="{{$sub_type}}">
      <div class="row">
        @if($business_locations->count() > 0)
        <div class="col-sm-3 @if(count($business_locations) == 1) col-sm-offset-3 @else col-sm-offset-1 @endif">
          <div class="form-group">
            @php
            $__f2 = ['name' => 'amount', 'value' => 'Valor em dinheiro:*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            @php
            $__f3 = ['name' => 'amount', 'value' => null, 'options' => ['class' => 'form-control money', 'placeholder' => __('cash_register.enter_amount'), 'required']];
            @endphp
            <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          </div>
        </div>
        @if(count($business_locations) > 1)
        <!-- <div class="clearfix"></div> -->
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f4 = ['name' => 'location_id', 'value' => 'Local:*'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
              @php
              $__f5 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_location'), 'required']];
              @endphp
              <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
          </div>
        </div>
        @else
          @php
          $__f6 = ['name' => 'location_id', 'value' => array_key_first($business_locations->toArray())];
          @endphp
          <x-form.input type="hidden" :name="$__f6['name']" :value="$__f6['value']" />
        @endif
        <div class="col-sm-3">
          <button type="submit" style="margin-top: 23px;" class="btn btn-primary pull-left">@lang('cash_register.open_register')</button>
        </div>
        @else
        <div class="col-sm-8 col-sm-offset-2 text-center">
          <h3>@lang('lang_v1.no_location_access_found')</h3>
        </div>
      @endif
      </div>
      <br><br><br>
    </div>
  </div>
  <x-form.close />
</section>
<!-- /.content -->
@endsection