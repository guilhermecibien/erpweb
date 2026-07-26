@extends('layouts.app')
@section('title', __('report.register_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('report.register_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              @php
              $__f1 = ['options' => ['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'register_report_filter_form' ]];
              @endphp
              <x-form.open :options="$__f1['options']" />
                <div class="col-md-4">
                    <div class="form-group">
                        @php
                        $__f2 = ['name' => 'register_user_id', 'value' => __('report.user') . ':'];
                        @endphp
                        <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
                        @php
                        $__f3 = ['name' => 'register_user_id', 'list' => $users, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all_users')]];
                        @endphp
                        <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        @php
                        $__f4 = ['name' => 'register_status', 'value' => __('sale.status') . ':'];
                        @endphp
                        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
                        @php
                        $__f5 = ['name' => 'register_status', 'list' => ['open' => __('cash_register.open'), 'close' => __('cash_register.close')], 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all')]];
                        @endphp
                        <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        @php
                        $__f6 = ['name' => 'register_report_date_range', 'value' => __('report.date_range') . ':'];
                        @endphp
                        <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
                        @php
                        $__f7 = ['name' => 'register_report_date_range', 'value' => null, 'options' => ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'register_report_date_range', 'readonly']];
                        @endphp
                        <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                    </div>
                </div>
                <x-form.close />
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="register_report_table">
                        <thead>
                            <tr>
                                <th>@lang('report.open_time')</th>
                                <th>@lang('report.close_time')</th>
                                <th>@lang('sale.location')</th>
                                <th>@lang('report.user')</th>
                                <th>@lang('cash_register.total_card_slips')</th>
                                <th>@lang('cash_register.total_cheques')</th>
                                <th>@lang('cash_register.total_cash')</th>
                                <th>@lang('messages.action')</th>
                            </tr>
                        </thead>
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