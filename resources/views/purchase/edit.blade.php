@extends('layouts.app')
@section('title', __('purchase.edit_purchase'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('purchase.edit_purchase') <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="@include('purchase.partials.keyboard_shortcuts_details')" data-html="true" data-trigger="hover" data-original-title="" title=""></i></h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Page level currency setting -->
  <input type="hidden" id="p_code" value="{{$currency_details->code}}">
  <input type="hidden" id="p_symbol" value="{{$currency_details->symbol}}">
  <input type="hidden" id="p_thousand" value="{{$currency_details->thousand_separator}}">
  <input type="hidden" id="p_decimal" value="{{$currency_details->decimal_separator}}">

  @include('layouts.partials.error')

  @php
  $__f1 = ['options' => ['url' =>  action('PurchaseController@update' , [$purchase->id] ), 'method' => 'PUT', 'id' => 'add_purchase_form', 'files' => true ]];
  @endphp
  <x-form.open :options="$__f1['options']" />

  @php
    $currency_precision = config('constants.currency_precision', 2);
  @endphp

  <input type="hidden" id="purchase_id" value="{{ $purchase->id }}">

    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
              <div class="form-group">
                @php
                $__f2 = ['name' => 'supplier_id', 'value' => __('purchase.supplier') . ':*'];
                @endphp
                <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </span>
                  @php
                  $__f3 = ['name' => 'contact_id', 'list' => [ $purchase->contact_id => $purchase->contact->name], 'selected' => $purchase->contact_id, 'options' => ['class' => 'form-control', 'placeholder' => __('messages.please_select') , 'required', 'id' => 'supplier_id']];
                  @endphp
                  <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default bg-white btn-flat add_new_supplier" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                  </span>
                </div>
              </div>
            </div>

            <div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
              <div class="form-group">
                @php
                $__f4 = ['name' => 'ref_no', 'value' => __('purchase.ref_no') . '*'];
                @endphp
                <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
                @php
                $__f5 = ['name' => 'ref_no', 'value' => $purchase->ref_no, 'options' => ['class' => 'form-control', 'required']];
                @endphp
                <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
              </div>
            </div>
            
            <div class="@if(!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
              <div class="form-group">
                @php
                $__f6 = ['name' => 'transaction_date', 'value' => __('purchase.purchase_date') . ':*'];
                @endphp
                <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                  @php
                  $__f7 = ['name' => 'transaction_date', 'value' => \Carbon::createFromTimestamp(strtotime($purchase->transaction_date))->format(session('business.date_format') . ' ' . (session('business.time_format') == 24 ? 'H:i' : 'h:i A')), 'options' => ['class' => 'form-control', 'readonly', 'required']];
                  @endphp
                  <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                </div>
              </div>
            </div>
            
            <div class="col-sm-3 @if(!empty($default_purchase_status)) hide @endif">
              <div class="form-group">
                @php
                $__f8 = ['name' => 'status', 'value' => __('purchase.purchase_status') . ':*'];
                @endphp
                <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
                @show_tooltip(__('tooltip.order_status'))
                @php
                $__f9 = ['name' => 'status', 'list' => $orderStatuses, 'selected' => $purchase->status, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select') , 'required']];
                @endphp
                <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-3">
              <div class="form-group">
                @php
                $__f10 = ['name' => 'location_id', 'value' => __('purchase.business_location').':*'];
                @endphp
                <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
                @show_tooltip(__('tooltip.purchase_location'))
                @php
                $__f11 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => $purchase->location_id, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'disabled']];
                @endphp
                <x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
              </div>
            </div>

            <!-- Currency Exchange Rate -->
            <div class="col-sm-3 @if(!$currency_details->purchase_in_diff_currency) hide @endif">
              <div class="form-group">
                @php
                $__f12 = ['name' => 'exchange_rate', 'value' => __('purchase.p_exchange_rate') . ':*'];
                @endphp
                <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
                @show_tooltip(__('tooltip.currency_exchange_factor'))
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                  </span>
                  @php
                  $__f13 = ['name' => 'exchange_rate', 'value' => $purchase->exchange_rate, 'options' => ['class' => 'form-control', 'required', 'step' => 0.001]];
                  @endphp
                  <x-form.input type="number" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
                </div>
                <span class="help-block text-danger">
                  @lang('purchase.diff_purchase_currency_help', ['currency' => $currency_details->name])
                </span>
              </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                  <div class="multi-input">
                    @php
                    $__f14 = ['name' => 'pay_term_number', 'value' => __('contact.pay_term') . ':'];
                    @endphp
                    <x-form.label :name="$__f14['name']" :value="$__f14['value']" /> @show_tooltip(__('tooltip.pay_term'))
                    <br/>
                    @php
                    $__f15 = ['name' => 'pay_term_number', 'value' => $purchase->pay_term_number, 'options' => ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]];
                    @endphp
                    <x-form.input type="number" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />

                    @php
                    $__f16 = ['name' => 'pay_term_type', 'list' => ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], 'selected' => $purchase->pay_term_type, 'options' => ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select'), 'id' => 'pay_term_type']];
                    @endphp
                    <x-form.select :name="$__f16['name']" :list="$__f16['list']" :selected="$__f16['selected']" :options="$__f16['options']" />
                  </div>
              </div>
          </div>

            <div class="col-sm-3">
                <div class="form-group">
                    @php
                    $__f17 = ['name' => 'document', 'value' => __('purchase.attach_document') . ':'];
                    @endphp
                    <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
                    @php
                    $__f18 = ['name' => 'document', 'options' => ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]];
                    @endphp
                    <x-form.input type="file" :name="$__f18['name']" :options="$__f18['options']" />
                    <p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                    @includeIf('components.document_help_text')</p>
                </div>
            </div>
        </div>
    @endcomponent

    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-search"></i>
                  </span>
                  @php
                  $__f19 = ['name' => 'search_product', 'value' => null, 'options' => ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus']];
                  @endphp
                  <x-form.input type="text" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <button tabindex="-1" type="button" class="btn btn-link btn-modal"data-href="{{action('ProductController@quickAdd')}}" 
                      data-container=".quick_add_product_modal"><i class="fa fa-plus"></i> @lang( 'product.add_new_product' ) </button>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
              @include('purchase.partials.edit_purchase_entry_row')
              <hr/>
              <div class="pull-right col-md-5">
                <table class="pull-right col-md-12">
                  <tr>
                    <th class="col-md-7 text-right">@lang( 'lang_v1.total_items' ):</th>
                    <td class="col-md-5 text-left">
                      <span id="total_quantity" class="display_currency" data-currency_symbol="false"></span>
                    </td>
                  </tr>
                  <tr class="hide">
                    <th class="col-md-7 text-right">@lang( 'purchase.total_before_tax' ):</th>
                    <td class="col-md-5 text-left">
                      <span id="total_st_before_tax" class="display_currency"></span>
                      <input type="hidden" id="st_before_tax_input" value=0>
                    </td>
                  </tr>
                  <tr>
                    <th class="col-md-7 text-right">@lang( 'purchase.net_total_amount' ):</th>
                    <td class="col-md-5 text-left">
                      <span id="total_subtotal" class="display_currency">{{$purchase->total_before_tax/$purchase->exchange_rate}}</span>
                      <!-- This is total before purchase tax-->

                      <input type="hidden" id="total_subtotal_input" value="{{ number_format($purchase->total_before_tax/$purchase->exchange_rate, 2, ',', '')}}" name="total_before_tax">
                    </td>
                  </tr>
                </table>
              </div>

            </div>
        </div>
    @endcomponent

    @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
            <div class="col-sm-12">
                <table class="table">
                  <tr>
                    <td class="col-md-3">
                      <div class="form-group">
                        @php
                        $__f20 = ['name' => 'discount_type', 'value' => __( 'purchase.discount_type' ) . ':'];
                        @endphp
                        <x-form.label :name="$__f20['name']" :value="$__f20['value']" />
                        @php
                        $__f21 = ['name' => 'discount_type', 'list' => [ '' => __('lang_v1.none'), 'fixed' => __( 'lang_v1.fixed' ), 'percentage' => __( 'lang_v1.percentage' )], 'selected' => $purchase->discount_type, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]];
                        @endphp
                        <x-form.select :name="$__f21['name']" :list="$__f21['list']" :selected="$__f21['selected']" :options="$__f21['options']" />
                      </div>
                    </td>
                    <td class="col-md-3">
                      <div class="form-group">
                      @php
                      $__f22 = ['name' => 'discount_amount', 'value' => __( 'purchase.discount_amount' ) . ':'];
                      @endphp
                      <x-form.label :name="$__f22['name']" :value="$__f22['value']" />
                      @php
                      $__f23 = ['name' => 'discount_amount', 'value' => ($purchase->discount_type == 'fixed' ? number_format($purchase->discount_amount/$purchase->exchange_rate, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator) : number_format($purchase->discount_amount, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator) ), 'options' => ['class' => 'form-control input_number']];
                      @endphp
                      <x-form.input type="text" :name="$__f23['name']" :value="$__f23['value']" :options="$__f23['options']" />
                      </div>
                    </td>
                    <td class="col-md-3">
                      &nbsp;
                    </td>
                    <td class="col-md-3">
                      <b>Desconto:</b>(-) 
                      <span id="discount_calculated_amount" class="display_currency">0</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-group">
                      @php
                      $__f24 = ['name' => 'tax_id', 'value' => __( 'purchase.purchase_tax' ) . ':'];
                      @endphp
                      <x-form.label :name="$__f24['name']" :value="$__f24['value']" />
                      <select name="tax_id" id="tax_id" class="form-control select2" placeholder="'Please Select'">
                        <option value="" data-tax_amount="0" selected>@lang('lang_v1.none')</option>
                        @foreach($taxes as $tax)
                          <option value="{{ $tax->id }}" @if($purchase->tax_id == $tax->id) {{'selected'}} @endif data-tax_amount="{{ $tax->amount }}"
                          >
                            {{ $tax->name }}
                          </option>
                        @endforeach
                      </select>
                      @php
                      $__f25 = ['name' => 'tax_amount', 'value' => $purchase->tax_amount, 'options' => ['id' => 'tax_amount']];
                      @endphp
                      <x-form.input type="hidden" :name="$__f25['name']" :value="$__f25['value']" :options="$__f25['options']" />
                      </div>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
                      <b>@lang( 'purchase.purchase_tax' ):</b>(+) 
                      <span id="tax_calculated_amount" class="display_currency">0</span>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <div class="form-group">
                      @php
                      $__f26 = ['name' => 'shipping_details', 'value' => __( 'purchase.shipping_details' ) . ':'];
                      @endphp
                      <x-form.label :name="$__f26['name']" :value="$__f26['value']" />
                      @php
                      $__f27 = ['name' => 'shipping_details', 'value' => $purchase->shipping_details, 'options' => ['class' => 'form-control']];
                      @endphp
                      <x-form.input type="text" :name="$__f27['name']" :value="$__f27['value']" :options="$__f27['options']" />
                      </div>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
                      <div class="form-group">
                      @php
                      $__f28 = ['name' => 'shipping_charges', 'value' => '(+) ' . __( 'purchase.additional_shipping_charges') . ':'];
                      @endphp
                      <x-form.label :name="$__f28['name']" :value="$__f28['value']" />
                      @php
                      $__f29 = ['name' => 'shipping_charges', 'value' => number_format($purchase->shipping_charges/$purchase->exchange_rate, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), 'options' => ['class' => 'form-control input_number']];
                      @endphp
                      <x-form.input type="text" :name="$__f29['name']" :value="$__f29['value']" :options="$__f29['options']" />
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>


                    <td>
                      @php
                      $__f30 = ['name' => 'final_total', 'value' => $purchase->final_total, 'options' => ['id' => 'grand_total_hidden']];
                      @endphp
                      <x-form.input type="hidden" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
                      <b>@lang('purchase.purchase_total'): </b><span id="grand_total" class="display_currency" data-currency_symbol='true'>{{ number_format($purchase->final_total, 2, ',', '')}}</span>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4">
                      <div class="form-group">
                        @php
                        $__f31 = ['name' => 'additional_notes', 'value' => __('purchase.additional_notes')];
                        @endphp
                        <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
                        @php
                        $__f32 = ['name' => 'additional_notes', 'value' => $purchase->additional_notes, 'options' => ['class' => 'form-control', 'rows' => 3]];
                        @endphp
                        <x-form.textarea :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
                      </div>
                    </td>
                  </tr>

                </table>
            </div>
        </div>
    @endcomponent
  
    <div class="row">
        <div class="col-sm-12">
          <button type="button" id="submit_purchase_form" class="btn btn-primary pull-right btn-flat">@lang('messages.update')</button>
        </div>
    </div>
<x-form.close />
</section>
<!-- /.content -->
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  @include('contact.create', ['quick_add' => true])
</div>

@endsection

@section('javascript')
  <script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>
  <script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
  <script type="text/javascript">
    $(document).ready( function(){
      update_table_total();
      update_grand_total();
    });
  </script>
  @include('purchase.partials.keyboard_shortcuts')
@endsection
