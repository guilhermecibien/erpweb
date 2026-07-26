@extends('layouts.app')
@section('title',  __('invoice.edit_invoice_layout'))

@section('content')
<style type="text/css">



</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('invoice.edit_invoice_layout')</h1>
</section>

<!-- Main content -->
<section class="content">
@php
$__f1 = ['options' => ['url' => action('InvoiceLayoutController@update', [$invoice_layout->id]), 'method' => 'put', 'id' => 'add_invoice_layout_form', 'files' => true]];
@endphp
<x-form.open :options="$__f1['options']" />

  @php
    $product_custom_fields = !empty($invoice_layout->product_custom_fields) ? $invoice_layout->product_custom_fields : [];
    $contact_custom_fields = !empty($invoice_layout->contact_custom_fields) ? $invoice_layout->contact_custom_fields : [];
    $location_custom_fields = !empty($invoice_layout->location_custom_fields) ? $invoice_layout->location_custom_fields : [];
    $custom_labels = json_decode(session('business.custom_labels'), true);
  @endphp
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">

        <div class="col-sm-6">
         <div class="form-group">
            @php
            $__f2 = ['name' => 'name', 'value' => __('invoice.layout_name') . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
              @php
              $__f3 = ['name' => 'name', 'value' => $invoice_layout->name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('invoice.layout_name')]];
              @endphp
              <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f4 = ['name' => 'design', 'value' => __('lang_v1.design') . ':*'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
              @php
              $__f5 = ['name' => 'design', 'list' => $designs, 'selected' => $invoice_layout->design, 'options' => ['class' => 'form-control']];
              @endphp
              <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
              <span class="help-block">
                @lang('lang_v1.used_for_browser_based_printing')
              </span>
          </div>

          <div class="form-group @if($invoice_layout->design != 'columnize-taxes') hide @endif" id="columnize-taxes">
            <div class="col-md-3">
              <input type="text" class="form-control" 
              name="table_tax_headings[]" required="required" placeholder="tax 1 name" value="{{$invoice_layout->table_tax_headings[0]}}"
              @if($invoice_layout->design != 'columnize-taxes') disabled @endif>
              @show_tooltip(__('lang_v1.tooltip_columnize_taxes_heading'))
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" 
              name="table_tax_headings[]" placeholder="tax 2 name" 
              value="{{$invoice_layout->table_tax_headings[1]}}"
              @if($invoice_layout->design != 'columnize-taxes') disabled @endif>
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" 
              name="table_tax_headings[]" placeholder="tax 3 name"
              value="{{$invoice_layout->table_tax_headings[2]}}"
              @if($invoice_layout->design != 'columnize-taxes') disabled @endif>
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" 
              name="table_tax_headings[]" placeholder="tax 4 name"
              value="{{$invoice_layout->table_tax_headings[3]}}"
              @if($invoice_layout->design != 'columnize-taxes') disabled @endif>
            </div>

          </div>
        </div>

        <!-- Logo -->
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f6 = ['name' => 'logo', 'value' => __('invoice.invoice_logo') . ':'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            @php
            $__f7 = ['name' => 'logo', 'options' => ['accept' => 'image/*']];
            @endphp
            <x-form.input type="file" :name="$__f7['name']" :options="$__f7['options']" />
            <span class="help-block">@lang('lang_v1.invoice_logo_help', ['max_size' => '1 MB'])<br> @lang('lang_v1.invoice_logo_help2')</span>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f8 = ['name' => 'show_logo', 'value' => 1, 'checked' => $invoice_layout->show_logo, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f8['name']" :value="$__f8['value']" :checked="$__f8['checked']" :options="$__f8['options']" /> @lang('invoice.show_logo')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f9 = ['name' => 'header_text', 'value' => __('invoice.header_text') . ':'];
            @endphp
            <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
              @php
              $__f10 = ['name' => 'header_text', 'value' => $invoice_layout->header_text, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.header_text'), 'rows' => 3]];
              @endphp
              <x-form.textarea :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f11 = ['name' => 'sub_heading_line1', 'value' => __('lang_v1.sub_heading_line', ['_number_' => 1]) . ':'];
            @endphp
            <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
            @php
            $__f12 = ['name' => 'sub_heading_line1', 'value' => $invoice_layout->sub_heading_line1, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 1]) ]];
            @endphp
            <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f13 = ['name' => 'sub_heading_line2', 'value' => __('lang_v1.sub_heading_line', ['_number_' => 2]) . ':'];
            @endphp
            <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
            @php
            $__f14 = ['name' => 'sub_heading_line2', 'value' => $invoice_layout->sub_heading_line2, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 2]) ]];
            @endphp
            <x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f15 = ['name' => 'sub_heading_line3', 'value' => __('lang_v1.sub_heading_line', ['_number_' => 3]) . ':'];
            @endphp
            <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
            @php
            $__f16 = ['name' => 'sub_heading_line3', 'value' => $invoice_layout->sub_heading_line3, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 3]) ]];
            @endphp
            <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f17 = ['name' => 'sub_heading_line4', 'value' => __('lang_v1.sub_heading_line', ['_number_' => 4]) . ':'];
            @endphp
            <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
            @php
            $__f18 = ['name' => 'sub_heading_line4', 'value' => $invoice_layout->sub_heading_line4, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 4]) ]];
            @endphp
            <x-form.input type="text" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f19 = ['name' => 'sub_heading_line5', 'value' => __('lang_v1.sub_heading_line', ['_number_' => 5]) . ':'];
            @endphp
            <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
            @php
            $__f20 = ['name' => 'sub_heading_line5', 'value' => $invoice_layout->sub_heading_line5, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 5]) ]];
            @endphp
            <x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f21 = ['name' => 'invoice_heading', 'value' => __('invoice.invoice_heading') . ':'];
            @endphp
            <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
            @php
            $__f22 = ['name' => 'invoice_heading', 'value' => $invoice_layout->invoice_heading, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.invoice_heading') ]];
            @endphp
            <x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f23 = ['name' => 'invoice_heading_not_paid', 'value' => __('invoice.invoice_heading_not_paid') . ':'];
            @endphp
            <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
            @php
            $__f24 = ['name' => 'invoice_heading_not_paid', 'value' => $invoice_layout->invoice_heading_not_paid, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.invoice_heading_not_paid') ]];
            @endphp
            <x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f25 = ['name' => 'invoice_heading_paid', 'value' => __('invoice.invoice_heading_paid') . ':'];
            @endphp
            <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
            @php
            $__f26 = ['name' => 'invoice_heading_paid', 'value' => $invoice_layout->invoice_heading_paid, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.invoice_heading_paid') ]];
            @endphp
            <x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f27 = ['name' => 'quotation_heading', 'value' => __('lang_v1.quotation_heading') . ':'];
            @endphp
            <x-form.label :name="$__f27['name']" :value="$__f27['value']" />@show_tooltip(__('lang_v1.tooltip_quotation_heading'))
            @php
            $__f28 = ['name' => 'quotation_heading', 'value' => $invoice_layout->quotation_heading, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.quotation_heading') ]];
            @endphp
            <x-form.input type="text" :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f29 = ['name' => 'invoice_no_prefix', 'value' => __('invoice.invoice_no_prefix') . ':'];
            @endphp
            <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
            @php
            $__f30 = ['name' => 'invoice_no_prefix', 'value' => $invoice_layout->invoice_no_prefix, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.invoice_no_prefix') ]];
            @endphp
            <x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f31 = ['name' => 'quotation_no_prefix', 'value' => __('lang_v1.quotation_no_prefix') . ':'];
            @endphp
            <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
            @php
            $__f32 = ['name' => 'quotation_no_prefix', 'value' => $invoice_layout->quotation_no_prefix, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.quotation_no_prefix') ]];
            @endphp
            <x-form.input type="text" :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f33 = ['name' => 'date_label', 'value' => __('lang_v1.date_label') . ':'];
            @endphp
            <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
            @php
            $__f34 = ['name' => 'date_label', 'value' => $invoice_layout->date_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.date_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f35 = ['name' => 'due_date_label', 'value' => __('lang_v1.due_date_label') . ':'];
            @endphp
            <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
            @php
            $__f36 = ['name' => 'common_settings[due_date_label]', 'value' => !empty($invoice_layout->common_settings['due_date_label']) ? $invoice_layout->common_settings['due_date_label'] : null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.due_date_label'), 'id' => 'due_date_label' ]];
            @endphp
            <x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f37 = ['name' => 'common_settings[show_due_date]', 'value' => 1, 'checked' => !empty($invoice_layout->common_settings['show_due_date']), 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f37['name']" :value="$__f37['value']" :checked="$__f37['checked']" :options="$__f37['options']" /> @lang('lang_v1.show_due_date')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f38 = ['name' => 'date_time_format', 'value' => __('lang_v1.date_time_format') . ':'];
            @endphp
            <x-form.label :name="$__f38['name']" :value="$__f38['value']" />
            @php
            $__f39 = ['name' => 'date_time_format', 'value' => $invoice_layout->date_time_format, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.date_time_format') ]];
            @endphp
            <x-form.input type="text" :name="$__f39['name']" :value="$__f39['value']" :options="$__f39['options']" /> 
              <p class="help-block">{!! __('lang_v1.date_time_format_help') !!}</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f40 = ['name' => 'sales_person_label', 'value' => __('lang_v1.sales_person_label') . ':'];
            @endphp
            <x-form.label :name="$__f40['name']" :value="$__f40['value']" />
            @php
            $__f41 = ['name' => 'sales_person_label', 'value' => $invoice_layout->sales_person_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.sales_person_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f41['name']" :value="$__f41['value']" :options="$__f41['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f42 = ['name' => 'show_business_name', 'value' => 1, 'checked' => $invoice_layout->show_business_name, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f42['name']" :value="$__f42['value']" :checked="$__f42['checked']" :options="$__f42['options']" /> @lang('invoice.show_business_name')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f43 = ['name' => 'show_location_name', 'value' => 1, 'checked' => $invoice_layout->show_location_name, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f43['name']" :value="$__f43['value']" :checked="$__f43['checked']" :options="$__f43['options']" /> @lang('invoice.show_location_name')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f44 = ['name' => 'show_sales_person', 'value' => 1, 'checked' => $invoice_layout->show_sales_person, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f44['name']" :value="$__f44['value']" :checked="$__f44['checked']" :options="$__f44['options']" /> @lang('lang_v1.show_sales_person')</label>
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
          <h4>@lang('lang_v1.fields_for_customer_details'):</h4>
        </div>
       <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f45 = ['name' => 'show_customer', 'value' => 1, 'checked' => $invoice_layout->show_customer, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f45['name']" :value="$__f45['value']" :checked="$__f45['checked']" :options="$__f45['options']" /> @lang('invoice.show_customer')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f46 = ['name' => 'customer_label', 'value' => __('invoice.customer_label') . ':'];
            @endphp
            <x-form.label :name="$__f46['name']" :value="$__f46['value']" />
            @php
            $__f47 = ['name' => 'customer_label', 'value' => $invoice_layout->customer_label, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.customer_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f47['name']" :value="$__f47['value']" :options="$__f47['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f48 = ['name' => 'show_client_id', 'value' => 1, 'checked' => $invoice_layout->show_client_id, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f48['name']" :value="$__f48['value']" :checked="$__f48['checked']" :options="$__f48['options']" /> @lang('lang_v1.show_client_id')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f49 = ['name' => 'client_id_label', 'value' => __('lang_v1.client_id_label') . ':'];
            @endphp
            <x-form.label :name="$__f49['name']" :value="$__f49['value']" />
            @php
            $__f50 = ['name' => 'client_id_label', 'value' => $invoice_layout->client_id_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.client_id_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f50['name']" :value="$__f50['value']" :options="$__f50['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f51 = ['name' => 'client_tax_label', 'value' => __('lang_v1.client_tax_label') . ':'];
            @endphp
            <x-form.label :name="$__f51['name']" :value="$__f51['value']" />
            @php
            $__f52 = ['name' => 'client_tax_label', 'value' => $invoice_layout->client_tax_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.client_tax_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f52['name']" :value="$__f52['value']" :options="$__f52['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f53 = ['name' => 'show_reward_point', 'value' => 1, 'checked' => $invoice_layout->show_reward_point, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f53['name']" :value="$__f53['value']" :checked="$__f53['checked']" :options="$__f53['options']" /> @lang('lang_v1.show_reward_point')</label>
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              @php
              $__f54 = ['name' => 'contact_custom_fields[]', 'value' => 'custom_field1', 'checked' => in_array('custom_field1', $contact_custom_fields), 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f54['name']" :value="$__f54['value']" :checked="$__f54['checked']" :options="$__f54['options']" /> {{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              @php
              $__f55 = ['name' => 'contact_custom_fields[]', 'value' => 'custom_field2', 'checked' => in_array('custom_field2', $contact_custom_fields), 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f55['name']" :value="$__f55['value']" :checked="$__f55['checked']" :options="$__f55['options']" /> {{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              @php
              $__f56 = ['name' => 'contact_custom_fields[]', 'value' => 'custom_field3', 'checked' => in_array('custom_field3', $contact_custom_fields), 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f56['name']" :value="$__f56['value']" :checked="$__f56['checked']" :options="$__f56['options']" /> {{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              @php
              $__f57 = ['name' => 'contact_custom_fields[]', 'value' => 'custom_field4', 'checked' => in_array('custom_field4', $contact_custom_fields), 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f57['name']" :value="$__f57['value']" :checked="$__f57['checked']" :options="$__f57['options']" /> {{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}</label>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4>@lang('invoice.fields_to_be_shown_in_address'):</h4>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f58 = ['name' => 'show_landmark', 'value' => 1, 'checked' => $invoice_layout->show_landmark, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f58['name']" :value="$__f58['value']" :checked="$__f58['checked']" :options="$__f58['options']" /> @lang('business.landmark')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f59 = ['name' => 'show_city', 'value' => 1, 'checked' => $invoice_layout->show_city, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f59['name']" :value="$__f59['value']" :checked="$__f59['checked']" :options="$__f59['options']" /> @lang('business.city')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f60 = ['name' => 'show_state', 'value' => 1, 'checked' => $invoice_layout->show_state, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f60['name']" :value="$__f60['value']" :checked="$__f60['checked']" :options="$__f60['options']" /> @lang('business.state')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f61 = ['name' => 'show_country', 'value' => 1, 'checked' => $invoice_layout->show_country, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f61['name']" :value="$__f61['value']" :checked="$__f61['checked']" :options="$__f61['options']" /> @lang('business.country')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f62 = ['name' => 'show_zip_code', 'value' => 1, 'checked' => $invoice_layout->show_zip_code, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f62['name']" :value="$__f62['value']" :checked="$__f62['checked']" :options="$__f62['options']" /> @lang('business.zip_code')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              @php
              $__f63 = ['name' => 'location_custom_fields[]', 'value' => 'custom_field1', 'checked' => in_array('custom_field1', $location_custom_fields), 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f63['name']" :value="$__f63['value']" :checked="$__f63['checked']" :options="$__f63['options']" /> {{ $custom_labels['location']['custom_field_1'] ?? __('lang_v1.location_custom_field1') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              @php
              $__f64 = ['name' => 'location_custom_fields[]', 'value' => 'custom_field2', 'checked' => in_array('custom_field2', $location_custom_fields), 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f64['name']" :value="$__f64['value']" :checked="$__f64['checked']" :options="$__f64['options']" /> {{ $custom_labels['location']['custom_field_2'] ?? __('lang_v1.location_custom_field2') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              @php
              $__f65 = ['name' => 'location_custom_fields[]', 'value' => 'custom_field3', 'checked' => in_array('custom_field3', $location_custom_fields), 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f65['name']" :value="$__f65['value']" :checked="$__f65['checked']" :options="$__f65['options']" /> {{ $custom_labels['location']['custom_field_3'] ?? __('lang_v1.location_custom_field3') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              @php
              $__f66 = ['name' => 'location_custom_fields[]', 'value' => 'custom_field4', 'checked' => in_array('custom_field4', $location_custom_fields), 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f66['name']" :value="$__f66['value']" :checked="$__f66['checked']" :options="$__f66['options']" /> {{ $custom_labels['location']['custom_field_4'] ?? __('lang_v1.location_custom_field4') }}</label>
          </div>
        </div>
      </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label>@lang('invoice.fields_to_shown_for_communication'):</label>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f67 = ['name' => 'show_mobile_number', 'value' => 1, 'checked' => $invoice_layout->show_mobile_number, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f67['name']" :value="$__f67['value']" :checked="$__f67['checked']" :options="$__f67['options']" /> @lang('invoice.show_mobile_number')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f68 = ['name' => 'show_alternate_number', 'value' => 1, 'checked' => $invoice_layout->show_alternate_number, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f68['name']" :value="$__f68['value']" :checked="$__f68['checked']" :options="$__f68['options']" /> @lang('invoice.show_alternate_number')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f69 = ['name' => 'show_email', 'value' => 1, 'checked' => $invoice_layout->show_email, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f69['name']" :value="$__f69['value']" :checked="$__f69['checked']" :options="$__f69['options']" /> @lang('invoice.show_email')</label>
              </div>
          </div>
        </div>
        
        <div class="col-sm-12">
          <div class="form-group">
            <label>@lang('invoice.fields_to_shown_for_tax'):</label>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f70 = ['name' => 'show_tax_1', 'value' => 1, 'checked' => $invoice_layout->show_tax_1, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f70['name']" :value="$__f70['value']" :checked="$__f70['checked']" :options="$__f70['options']" /> @lang('invoice.show_tax_1')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f71 = ['name' => 'show_tax_2', 'value' => 1, 'checked' => $invoice_layout->show_tax_2, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f71['name']" :value="$__f71['value']" :checked="$__f71['checked']" :options="$__f71['options']" /> @lang('invoice.show_tax_2')</label>
              </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f72 = ['name' => 'table_product_label', 'value' => __('lang_v1.product_label') . ':'];
            @endphp
            <x-form.label :name="$__f72['name']" :value="$__f72['value']" />
            @php
            $__f73 = ['name' => 'table_product_label', 'value' => $invoice_layout->table_product_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.product_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f73['name']" :value="$__f73['value']" :options="$__f73['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f74 = ['name' => 'table_qty_label', 'value' => __('lang_v1.qty_label') . ':'];
            @endphp
            <x-form.label :name="$__f74['name']" :value="$__f74['value']" />
            @php
            $__f75 = ['name' => 'table_qty_label', 'value' => $invoice_layout->table_qty_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.qty_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f75['name']" :value="$__f75['value']" :options="$__f75['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f76 = ['name' => 'table_unit_price_label', 'value' => __('lang_v1.unit_price_label') . ':'];
            @endphp
            <x-form.label :name="$__f76['name']" :value="$__f76['value']" />
            @php
            $__f77 = ['name' => 'table_unit_price_label', 'value' => $invoice_layout->table_unit_price_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.unit_price_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f77['name']" :value="$__f77['value']" :options="$__f77['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f78 = ['name' => 'table_subtotal_label', 'value' => __('lang_v1.subtotal_label') . ':'];
            @endphp
            <x-form.label :name="$__f78['name']" :value="$__f78['value']" />
            @php
            $__f79 = ['name' => 'table_subtotal_label', 'value' => $invoice_layout->table_subtotal_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.subtotal_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f79['name']" :value="$__f79['value']" :options="$__f79['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f80 = ['name' => 'cat_code_label', 'value' => 'HSN da categoria' . ':'];
            @endphp
            <x-form.label :name="$__f80['name']" :value="$__f80['value']" />
            @php
            $__f81 = ['name' => 'cat_code_label', 'value' => $invoice_layout->cat_code_label, 'options' => ['class' => 'form-control', 'placeholder' => 'HSN' ]];
            @endphp
            <x-form.input type="text" :name="$__f81['name']" :value="$__f81['value']" :options="$__f81['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f82 = ['name' => 'total_quantity_label', 'value' => __('lang_v1.total_quantity_label') . ':'];
            @endphp
            <x-form.label :name="$__f82['name']" :value="$__f82['value']" />
            @php
            $__f83 = ['name' => 'common_settings[total_quantity_label]', 'value' => !empty($invoice_layout->common_settings['total_quantity_label']) ? $invoice_layout->common_settings['total_quantity_label'] : null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.total_quantity_label'), 'id' => 'total_quantity_label' ]];
            @endphp
            <x-form.input type="text" :name="$__f83['name']" :value="$__f83['value']" :options="$__f83['options']" />
          </div>
        </div>
        
        <div class="col-sm-12">
          <h4>@lang('lang_v1.product_details_to_be_shown'):</h4>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f84 = ['name' => 'show_brand', 'value' => 1, 'checked' => $invoice_layout->show_brand, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f84['name']" :value="$__f84['value']" :checked="$__f84['checked']" :options="$__f84['options']" /> @lang('lang_v1.show_brand')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f85 = ['name' => 'show_sku', 'value' => 1, 'checked' => $invoice_layout->show_sku, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f85['name']" :value="$__f85['value']" :checked="$__f85['checked']" :options="$__f85['options']" /> @lang('lang_v1.show_sku')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f86 = ['name' => 'show_cat_code', 'value' => 1, 'checked' => $invoice_layout->show_cat_code, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f86['name']" :value="$__f86['value']" :checked="$__f86['checked']" :options="$__f86['options']" /> @lang('lang_v1.show_cat_code')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
              @php
              $__f87 = ['name' => 'show_sale_description', 'value' => 1, 'checked' => $invoice_layout->show_sale_description, 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f87['name']" :value="$__f87['value']" :checked="$__f87['checked']" :options="$__f87['options']" /> @lang('lang_v1.show_sale_description')</label>
            </div>
            <p class="help-block">@lang('lang_v1.product_imei_or_sn')</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f88 = ['name' => 'product_custom_fields[]', 'value' => 'product_custom_field1', 'checked' => in_array('product_custom_field1', $product_custom_fields), 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f88['name']" :value="$__f88['value']" :checked="$__f88['checked']" :options="$__f88['options']" /> {{ $custom_labels['product']['product_field_1'] ?? __('lang_v1.product_custom_field1') }}</label>
            </div>
          </div>
        </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              @php
              $__f89 = ['name' => 'product_custom_fields[]', 'value' => 'product_custom_field2', 'checked' => in_array('product_custom_field2', $product_custom_fields), 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f89['name']" :value="$__f89['value']" :checked="$__f89['checked']" :options="$__f89['options']" /> {{ $custom_labels['product']['product_field_2'] ?? __('lang_v1.product_custom_field2') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              @php
              $__f90 = ['name' => 'product_custom_fields[]', 'value' => 'product_custom_field3', 'checked' => in_array('product_custom_field3', $product_custom_fields), 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f90['name']" :value="$__f90['value']" :checked="$__f90['checked']" :options="$__f90['options']" /> {{ $custom_labels['product']['product_field_3'] ?? __('lang_v1.product_custom_field3') }}</label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <div class="checkbox">
            <label>
              @php
              $__f91 = ['name' => 'product_custom_fields[]', 'value' => 'product_custom_field4', 'checked' => in_array('product_custom_field4', $product_custom_fields), 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f91['name']" :value="$__f91['value']" :checked="$__f91['checked']" :options="$__f91['options']" /> {{ $custom_labels['product']['product_field_4'] ?? __('lang_v1.product_custom_field4') }}</label>
          </div>
        </div>
      </div>
        <div class="clearfix"></div>
        @if(request()->session()->get('business.enable_product_expiry') == 1)
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  @php
                  $__f92 = ['name' => 'show_expiry', 'value' => 1, 'checked' => $invoice_layout->show_expiry, 'options' => ['class' => 'input-icheck']];
                  @endphp
                  <x-form.checkbox :name="$__f92['name']" :value="$__f92['value']" :checked="$__f92['checked']" :options="$__f92['options']" /> @lang('lang_v1.show_product_expiry')</label>
                </div>
            </div>
          </div>
        @endif
        @if(request()->session()->get('business.enable_lot_number') == 1)
          <div class="col-sm-3">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  @php
                  $__f93 = ['name' => 'show_lot', 'value' => 1, 'checked' => $invoice_layout->show_lot, 'options' => ['class' => 'input-icheck']];
                  @endphp
                  <x-form.checkbox :name="$__f93['name']" :value="$__f93['value']" :checked="$__f93['checked']" :options="$__f93['options']" /> @lang('lang_v1.show_lot_number')</label>
                </div>
            </div>
          </div>
        @endif

        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f94 = ['name' => 'show_image', 'value' => 1, 'checked' => !empty($invoice_layout->show_image), 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f94['name']" :value="$__f94['value']" :checked="$__f94['checked']" :options="$__f94['options']" /> @lang('lang_v1.show_product_image')</label>
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f95 = ['name' => 'common_settings[show_warranty_name]', 'value' => 1, 'checked' => !empty($invoice_layout->common_settings['show_warranty_name']), 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f95['name']" :value="$__f95['value']" :checked="$__f95['checked']" :options="$__f95['options']" /> @lang('lang_v1.show_warranty_name')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f96 = ['name' => 'common_settings[show_warranty_exp_date]', 'value' => 1, 'checked' => !empty($invoice_layout->common_settings['show_warranty_exp_date']), 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f96['name']" :value="$__f96['value']" :checked="$__f96['checked']" :options="$__f96['options']" /> @lang('lang_v1.show_warranty_exp_date')</label>
              </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f97 = ['name' => 'common_settings[show_warranty_description]', 'value' => 1, 'checked' => !empty($invoice_layout->common_settings['show_warranty_description']), 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f97['name']" :value="$__f97['value']" :checked="$__f97['checked']" :options="$__f97['options']" /> @lang('lang_v1.show_warranty_description')</label>
              </div>
          </div>
        </div>

      </div>

    </div>
  </div>
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f98 = ['name' => 'sub_total_label', 'value' => __('invoice.sub_total_label') . ':'];
            @endphp
            <x-form.label :name="$__f98['name']" :value="$__f98['value']" />
            @php
            $__f99 = ['name' => 'sub_total_label', 'value' => $invoice_layout->sub_total_label, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.sub_total_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f99['name']" :value="$__f99['value']" :options="$__f99['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f100 = ['name' => 'discount_label', 'value' => __('invoice.discount_label') . ':'];
            @endphp
            <x-form.label :name="$__f100['name']" :value="$__f100['value']" />
            @php
            $__f101 = ['name' => 'discount_label', 'value' => $invoice_layout->discount_label, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.discount_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f101['name']" :value="$__f101['value']" :options="$__f101['options']" />
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f102 = ['name' => 'tax_label', 'value' => __('invoice.tax_label') . ':'];
            @endphp
            <x-form.label :name="$__f102['name']" :value="$__f102['value']" />
            @php
            $__f103 = ['name' => 'tax_label', 'value' => $invoice_layout->tax_label, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.tax_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f103['name']" :value="$__f103['value']" :options="$__f103['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f104 = ['name' => 'total_label', 'value' => __('invoice.total_label') . ':'];
            @endphp
            <x-form.label :name="$__f104['name']" :value="$__f104['value']" />
            @php
            $__f105 = ['name' => 'total_label', 'value' => $invoice_layout->total_label, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.total_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f105['name']" :value="$__f105['value']" :options="$__f105['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f106 = ['name' => 'round_off_label', 'value' => __('lang_v1.round_off_label') . ':'];
            @endphp
            <x-form.label :name="$__f106['name']" :value="$__f106['value']" />
            @php
            $__f107 = ['name' => 'round_off_label', 'value' => $invoice_layout->round_off_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.round_off_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f107['name']" :value="$__f107['value']" :options="$__f107['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f108 = ['name' => 'total_due_label', 'value' => __('invoice.total_due_label') . ' (' . __('lang_v1.current_sale') . '):'];
            @endphp
            <x-form.label :name="$__f108['name']" :value="$__f108['value']" />
            @php
            $__f109 = ['name' => 'total_due_label', 'value' => $invoice_layout->total_due_label, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.total_due_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f109['name']" :value="$__f109['value']" :options="$__f109['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f110 = ['name' => 'paid_label', 'value' => __('invoice.paid_label') . ':'];
            @endphp
            <x-form.label :name="$__f110['name']" :value="$__f110['value']" />
            @php
            $__f111 = ['name' => 'paid_label', 'value' => $invoice_layout->paid_label, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.paid_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f111['name']" :value="$__f111['value']" :options="$__f111['options']" />
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f112 = ['name' => 'show_payments', 'value' => 1, 'checked' => $invoice_layout->show_payments, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f112['name']" :value="$__f112['value']" :checked="$__f112['checked']" :options="$__f112['options']" /> @lang('invoice.show_payments')</label>
              </div>
          </div>
        </div>

        <!-- Barcode -->
        <div class="col-sm-3">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f113 = ['name' => 'show_barcode', 'value' => 1, 'checked' => $invoice_layout->show_barcode, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f113['name']" :value="$__f113['value']" :checked="$__f113['checked']" :options="$__f113['options']" /> @lang('invoice.show_barcode')</label>
              </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-3">
          <div class="form-group">
            @php
            $__f114 = ['name' => 'prev_bal_label', 'value' => __('invoice.total_due_label') . ' (' . __('lang_v1.all_sales') . '):'];
            @endphp
            <x-form.label :name="$__f114['name']" :value="$__f114['value']" />
            @php
            $__f115 = ['name' => 'prev_bal_label', 'value' => $invoice_layout->prev_bal_label, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.total_due_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f115['name']" :value="$__f115['value']" :options="$__f115['options']" />
          </div>
        </div>
        <div class="col-sm-5">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f116 = ['name' => 'show_previous_bal', 'value' => 1, 'checked' => $invoice_layout->show_previous_bal, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f116['name']" :value="$__f116['value']" :checked="$__f116['checked']" :options="$__f116['options']" /> @lang('lang_v1.show_previous_bal_due')</label>
                @show_tooltip(__('lang_v1.previous_bal_due_help'))
              </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f117 = ['name' => 'change_return_label', 'value' => __('lang_v1.change_return_label') . ':'];
            @endphp
            <x-form.label :name="$__f117['name']" :value="$__f117['value']" /> @show_tooltip(__('lang_v1.change_return_help'))
            @php
            $__f118 = ['name' => 'change_return_label', 'value' => $invoice_layout->change_return_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.change_return_label') ]];
            @endphp
            <x-form.input type="text" :name="$__f118['name']" :value="$__f118['value']" :options="$__f118['options']" />
          </div>
        </div>
        <div class="col-sm-3 @if($invoice_layout->design != 'slim') hide @endif" id="hide_price_div">
          <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f119 = ['name' => 'common_settings[hide_price]', 'value' => 1, 'checked' => !empty($invoice_layout->common_settings['hide_price']), 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f119['name']" :value="$__f119['value']" :checked="$__f119['checked']" :options="$__f119['options']" /> @lang('lang_v1.hide_all_prices')</label>
              </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
        
        <div class="col-sm-6 hide">
          <div class="form-group">
            @php
            $__f120 = ['name' => 'highlight_color', 'value' => __('invoice.highlight_color') . ':'];
            @endphp
            <x-form.label :name="$__f120['name']" :value="$__f120['value']" />
            @php
            $__f121 = ['name' => 'highlight_color', 'value' => $invoice_layout->highlight_color, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.highlight_color') ]];
            @endphp
            <x-form.input type="text" :name="$__f121['name']" :value="$__f121['value']" :options="$__f121['options']" />
          </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-12 hide">
          <hr/>
        </div>
        
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f122 = ['name' => 'footer_text', 'value' => __('invoice.footer_text') . ':'];
            @endphp
            <x-form.label :name="$__f122['name']" :value="$__f122['value']" />
              @php
              $__f123 = ['name' => 'footer_text', 'value' => $invoice_layout->footer_text, 'options' => ['class' => 'form-control', 'placeholder' => __('invoice.footer_text'), 'rows' => 3]];
              @endphp
              <x-form.textarea :name="$__f123['name']" :value="$__f123['value']" :options="$__f123['options']" />
          </div>
        </div>
        @if(empty($invoice_layout->is_default))
        <div class="col-sm-6">
          <div class="form-group">
            <br>
            <div class="checkbox">
              <label>
                @php
                $__f124 = ['name' => 'is_default', 'value' => 1, 'checked' => $invoice_layout->is_default, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f124['name']" :value="$__f124['value']" :checked="$__f124['checked']" :options="$__f124['options']" /> @lang('barcode.set_as_default')</label>
            </div>
          </div>
        </div>
        @endif
        
      </div>
    </div>
  </div>
</div>

@if(!empty($enabled_modules) && in_array('types_of_service', $enabled_modules) )
    @include('types_of_service.invoice_layout_settings', ['module_info' => $invoice_layout->module_info])
@endif
<!-- Call restaurant module if defined -->
@include('restaurant.partials.invoice_layout', ['module_info' => $invoice_layout->module_info, 'edit_il' => true])

@if(Module::has('Repair'))
  @include('repair::layouts.partials.invoice_layout_settings', ['module_info' => $invoice_layout->module_info, 'edit_il' => true])
@endif


<div class="box box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">@lang('lang_v1.layout_credit_note')</h3>
  </div>

  <div class="box-body">
    <div class="row">
      
      <div class="col-sm-3">
        <div class="form-group">
          @php
          $__f125 = ['name' => 'cn_heading', 'value' => __('lang_v1.cn_heading') . ':'];
          @endphp
          <x-form.label :name="$__f125['name']" :value="$__f125['value']" />
          @php
          $__f126 = ['name' => 'cn_heading', 'value' => $invoice_layout->cn_heading, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.cn_heading') ]];
          @endphp
          <x-form.input type="text" :name="$__f126['name']" :value="$__f126['value']" :options="$__f126['options']" />
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          @php
          $__f127 = ['name' => 'cn_no_label', 'value' => __('lang_v1.cn_no_label') . ':'];
          @endphp
          <x-form.label :name="$__f127['name']" :value="$__f127['value']" />
          @php
          $__f128 = ['name' => 'cn_no_label', 'value' => $invoice_layout->cn_no_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.cn_no_label') ]];
          @endphp
          <x-form.input type="text" :name="$__f128['name']" :value="$__f128['value']" :options="$__f128['options']" />
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          @php
          $__f129 = ['name' => 'cn_amount_label', 'value' => __('lang_v1.cn_amount_label') . ':'];
          @endphp
          <x-form.label :name="$__f129['name']" :value="$__f129['value']" />
          @php
          $__f130 = ['name' => 'cn_amount_label', 'value' => $invoice_layout->cn_amount_label, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.cn_amount_label') ]];
          @endphp
          <x-form.input type="text" :name="$__f130['name']" :value="$__f130['value']" :options="$__f130['options']" />
        </div>
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <button type="submit" class="btn btn-primary pull-right">@lang('messages.update')</button>
  </div>
</div>

  <x-form.close />
</section>
<!-- /.content -->
@endsection