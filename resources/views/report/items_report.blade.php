@extends('layouts.app')
@section('title', __('lang_v1.items_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('lang_v1.items_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
            <div class="col-md-3">
                <div class="form-group">
                    @php
                    $__f1 = ['name' => 'ir_supplier_id', 'value' => __('purchase.supplier') . ':'];
                    @endphp
                    <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        @php
                        $__f2 = ['name' => 'ir_supplier_id', 'list' => $suppliers, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all')]];
                        @endphp
                        <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    @php
                    $__f3 = ['name' => 'ir_purchase_date_filter', 'value' => __('purchase.purchase_date') . ':'];
                    @endphp
                    <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                    @php
                    $__f4 = ['name' => 'ir_purchase_date_filter', 'value' => null, 'options' => ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']];
                    @endphp
                    <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    @php
                    $__f5 = ['name' => 'ir_customer_id', 'value' => __('contact.customer') . ':'];
                    @endphp
                    <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        @php
                        $__f6 = ['name' => 'ir_customer_id', 'list' => $customers, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all')]];
                        @endphp
                        <x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    @php
                    $__f7 = ['name' => 'ir_sale_date_filter', 'value' => __('lang_v1.sell_date') . ':'];
                    @endphp
                    <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
                    @php
                    $__f8 = ['name' => 'ir_sale_date_filter', 'value' => null, 'options' => ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']];
                    @endphp
                    <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    @php
                    $__f9 = ['name' => 'ir_location_id', 'value' => __('purchase.business_location').':'];
                    @endphp
                    <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        @php
                        $__f10 = ['name' => 'ir_location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
                        @endphp
                        <x-form.select :name="$__f10['name']" :list="$__f10['list']" :selected="$__f10['selected']" :options="$__f10['options']" />
                    </div>
                </div>
            </div>
            @if(Module::has('Manufacturing'))
                <div class="col-md-3">
                    <div class="form-group">
                        <br>
                        <div class="checkbox">
                            <label>
                              @php
                              $__f11 = ['name' => 'only_mfg', 'value' => 1, 'checked' => false, 'options' => [ 'class' => 'input-icheck', 'id' => 'only_mfg_products']];
                              @endphp
                              <x-form.checkbox :name="$__f11['name']" :value="$__f11['value']" :checked="$__f11['checked']" :options="$__f11['options']" /> {{ __('manufacturing::lang.only_mfg_products') }}
                            </label>
                        </div>
                    </div>
                </div>
            @endif
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" 
                    id="items_report_table">
                        <thead>
                            <tr>
                                <th>@lang('sale.product')</th>
                                <th>@lang('product.sku')</th>
                                <th>@lang('purchase.purchase_date')</th>
                                <th>@lang('lang_v1.purchase')</th>
                                <th>@lang('purchase.supplier')</th>
                                <th>@lang('lang_v1.purchase_price')</th>
                                <th>@lang('lang_v1.sell_date')</th>
                                <th>@lang('business.sale')</th>
                                <th>@lang('contact.customer')</th>
                                <th>@lang('sale.location')</th>
                                <th>@lang('lang_v1.quantity')</th>
                                <th>@lang('lang_v1.selling_price')</th>
                                <th>@lang('sale.subtotal')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 text-center footer-total">
                                <td colspan="5"><strong>@lang('sale.total'):</strong></td>
                                <td id="footer_total_pp" 
                                    class="display_currency" data-currency_symbol="true"></td>
                                <td colspan="4"></td>
                                <td id="footer_total_qty"></td>
                                <td id="footer_total_sp"
                                    class="display_currency" data-currency_symbol="true"></td>
                                <td id="footer_total_subtotal"
                                    class="display_currency" data-currency_symbol="true"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection