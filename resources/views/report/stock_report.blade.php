@extends('layouts.app')
@section('title', __('report.stock_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('report.stock_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              @php
              $__f1 = ['options' => ['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'stock_report_filter_form' ]];
              @endphp
              <x-form.open :options="$__f1['options']" />
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f2 = ['name' => 'location_id', 'value' => __('purchase.business_location') . ':'];
                        @endphp
                        <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
                        @php
                        $__f3 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%']];
                        @endphp
                        <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f4 = ['name' => 'category_id', 'value' => __('category.category') . ':'];
                        @endphp
                        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
                        @php
                        $__f5 = ['name' => 'category', 'list' => $categories, 'selected' => null, 'options' => ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']];
                        @endphp
                        <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f6 = ['name' => 'sub_category_id', 'value' => __('product.sub_category') . ':'];
                        @endphp
                        <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
                        @php
                        $__f7 = ['name' => 'sub_category', 'list' => array(), 'selected' => null, 'options' => ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']];
                        @endphp
                        <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f8 = ['name' => 'brand', 'value' => __('product.brand') . ':'];
                        @endphp
                        <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
                        @php
                        $__f9 = ['name' => 'brand', 'list' => $brands, 'selected' => null, 'options' => ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']];
                        @endphp
                        <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f10 = ['name' => 'unit', 'value' => __('product.unit') . ':'];
                        @endphp
                        <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
                        @php
                        $__f11 = ['name' => 'unit', 'list' => $units, 'selected' => null, 'options' => ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']];
                        @endphp
                        <x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
                    </div>
                </div>
                @if($show_manufacturing_data)
                    <div class="col-md-3">
                        <div class="form-group">
                            <br>
                            <div class="checkbox">
                                <label>
                                  @php
                                  $__f12 = ['name' => 'only_mfg', 'value' => 1, 'checked' => false, 'options' => [ 'class' => 'input-icheck', 'id' => 'only_mfg_products']];
                                  @endphp
                                  <x-form.checkbox :name="$__f12['name']" :value="$__f12['value']" :checked="$__f12['checked']" :options="$__f12['options']" /> {{ __('manufacturing::lang.only_mfg_products') }}
                                </label>
                            </div>
                        </div>
                    </div>
                @endif
                <x-form.close />
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-solid'])
            <table class="table no-border">
                <tr>
                    <td>@lang('report.closing_stock') (@lang('lang_v1.by_purchase_price'))</td>
                    <td>@lang('report.closing_stock') (@lang('lang_v1.by_sale_price'))</td>
                    <td>@lang('lang_v1.potential_profit')</td>
                    <td>@lang('lang_v1.profit_margin')</td>
                </tr>
                <tr>
                    <td><h3 id="closing_stock_by_pp" class="mb-0 mt-0"></h3></td>
                    <td><h3 id="closing_stock_by_sp" class="mb-0 mt-0"></h3></td>
                    <td><h3 id="potential_profit" class="mb-0 mt-0"></h3></td>
                    <td><h3 id="profit_margin" class="mb-0 mt-0"></h3></td>
                </tr>
            </table>
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-solid'])
                @include('report.partials.stock_report_table')
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection