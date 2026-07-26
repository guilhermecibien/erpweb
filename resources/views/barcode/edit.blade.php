@extends('layouts.app')
@section('title',  __('barcode.edit_barcode_setting'))

@section('content')
<style type="text/css">



</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('barcode.edit_barcode_setting')</h1>
</section>

<!-- Main content -->
<section class="content">
@php
$__f1 = ['options' => ['url' => action('BarcodeController@update', [$barcode->id]), 'method' => 'PUT', 'id' => 'add_barcode_settings_form' ]];
@endphp
<x-form.open :options="$__f1['options']" />
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f2 = ['name' => 'name', 'value' => __('barcode.setting_name') . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
              @php
              $__f3 = ['name' => 'name', 'value' => $barcode->name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('barcode.setting_name')]];
              @endphp
              <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f4 = ['name' => 'description', 'value' => __('barcode.setting_description')];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
              @php
              $__f5 = ['name' => 'description', 'value' => $barcode->description, 'options' => ['class' => 'form-control', 'placeholder' => __('barcode.setting_description'), 'rows' => 3]];
              @endphp
              <x-form.textarea :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f6 = ['name' => 'is_continuous', 'value' => 1, 'checked' => $barcode->is_continuous, 'options' => ['id' => 'is_continuous']];
                @endphp
                <x-form.checkbox :name="$__f6['name']" :value="$__f6['value']" :checked="$__f6['checked']" :options="$__f6['options']" /> @lang('barcode.is_continuous')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f7 = ['name' => 'top_margin', 'value' => __('barcode.top_margin') . ' ('. __('barcode.in_in') . '):*'];
            @endphp
            <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
              </span>
              @php
              $__f8 = ['name' => 'top_margin', 'value' => $barcode->top_margin, 'options' => ['class' => 'form-control', 'placeholder' => __('barcode.top_margin'), 'min' => 0, 'step' => 0.01, 'required']];
              @endphp
              <x-form.input type="number" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f9 = ['name' => 'left_margin', 'value' => __('barcode.left_margin') . ' ('. __('barcode.in_in') . '):*'];
            @endphp
            <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
              </span>
              @php
              $__f10 = ['name' => 'left_margin', 'value' => $barcode->left_margin, 'options' => ['class' => 'form-control', 'placeholder' => __('barcode.left_margin'), 'min' => 0, 'step' => 0.01, 'required']];
              @endphp
              <x-form.input type="number" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f11 = ['name' => 'width', 'value' => __('barcode.width') . ' ('. __('barcode.in_in') . '):*'];
            @endphp
            <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-text-width" aria-hidden="true"></i>
              </span>
              @php
              $__f12 = ['name' => 'width', 'value' => $barcode->width, 'options' => ['class' => 'form-control', 'placeholder' => __('barcode.width'), 'min' => 0.1, 'step' => 0.01, 'required']];
              @endphp
              <x-form.input type="number" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f13 = ['name' => 'height', 'value' => __('barcode.height') . ' ('. __('barcode.in_in') . '):*'];
            @endphp
            <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-text-height" aria-hidden="true"></i>
              </span>
              @php
              $__f14 = ['name' => 'height', 'value' => $barcode->height, 'options' => ['class' => 'form-control', 'placeholder' => __('barcode.height'), 'min' => 0.1, 'step' => 0.01, 'required']];
              @endphp
              <x-form.input type="number" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f15 = ['name' => 'paper_width', 'value' => __('barcode.paper_width') . ' ('. __('barcode.in_in') . '):*'];
            @endphp
            <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-text-width" aria-hidden="true"></i>
              </span>
              @php
              $__f16 = ['name' => 'paper_width', 'value' => $barcode->paper_width, 'options' => ['class' => 'form-control', 'placeholder' => __('barcode.paper_width'), 'min' => 0.1, 'step' => 0.01, 'required']];
              @endphp
              <x-form.input type="number" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
            </div>
          </div>
        </div>
        <div class="col-sm-6 paper_height_div @if( $barcode->is_continuous ) {{ 'hide' }} @endif">
          <div class="form-group">
            @php
            $__f17 = ['name' => 'paper_height', 'value' => __('barcode.paper_height') . ' ('. __('barcode.in_in') . '):*'];
            @endphp
            <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-text-height" aria-hidden="true"></i>
              </span>
              @php
              $__f18 = ['name' => 'paper_height', 'value' => $barcode->paper_height, 'options' => ['class' => 'form-control', 'placeholder' => __('barcode.paper_height'), 'min' => 0.1, 'step' => 0.01, 'required']];
              @endphp
              <x-form.input type="number" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f19 = ['name' => 'stickers_in_one_row', 'value' => __('barcode.stickers_in_one_row'). ':*'];
            @endphp
            <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
              </span>
              @php
              $__f20 = ['name' => 'stickers_in_one_row', 'value' => $barcode->stickers_in_one_row, 'options' => ['class' => 'form-control', 'placeholder' => __('barcode.stickers_in_one_row'), 'min' => 1, 'required']];
              @endphp
              <x-form.input type="number" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f21 = ['name' => 'row_distance', 'value' => __('barcode.row_distance') . ' ('. __('barcode.in_in') . '):*'];
            @endphp
            <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span>
              </span>
              @php
              $__f22 = ['name' => 'row_distance', 'value' => $barcode->row_distance, 'options' => ['class' => 'form-control', 'placeholder' => __('barcode.row_distance'), 'min' => 0, 'step' => 0.01, 'required']];
              @endphp
              <x-form.input type="number" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f23 = ['name' => 'col_distance', 'value' => __('barcode.col_distance') . ' ('. __('barcode.in_in') . '):*'];
            @endphp
            <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-resize-horizontal" aria-hidden="true"></span>
              </span>
              @php
              $__f24 = ['name' => 'col_distance', 'value' => $barcode->col_distance, 'options' => ['class' => 'form-control', 'placeholder' => __('barcode.col_distance'), 'min' => 0, 'step' => 0.01, 'required']];
              @endphp
              <x-form.input type="number" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6 stickers_per_sheet_div @if( $barcode->is_continuous ) {{ 'hide' }} @endif">
          <div class="form-group">
            @php
            $__f25 = ['name' => 'stickers_in_one_sheet', 'value' => __('barcode.stickers_in_one_sheet') . ':*'];
            @endphp
            <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-th" aria-hidden="true"></i>
              </span>
              @php
              $__f26 = ['name' => 'stickers_in_one_sheet', 'value' => $barcode->stickers_in_one_sheet, 'options' => ['class' => 'form-control', 'placeholder' => __('barcode.stickers_in_one_sheet'), 'min' => 1, 'required']];
              @endphp
              <x-form.input type="number" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
          <button type="submit" class="btn btn-primary pull-right">@lang('messages.update')</button>
        </div>
      </div>
    </div>
  </div>
  <x-form.close />
</section>
<!-- /.content -->
@endsection