@extends('layouts.app')
@section('title', __('report.expense_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('report.expense_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row no-print">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              @php
              $__f1 = ['options' => ['url' => action('ReportController@getExpenseReport'), 'method' => 'get' ]];
              @endphp
              <x-form.open :options="$__f1['options']" />
                <div class="col-md-4">
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
                <div class="col-md-4">
                    <div class="form-group">
                        @php
                        $__f4 = ['name' => 'category_id', 'value' => __('category.category').':'];
                        @endphp
                        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
                        @php
                        $__f5 = ['name' => 'category', 'list' => $categories, 'selected' => null, 'options' => ['placeholder' => __('report.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']];
                        @endphp
                        <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        @php
                        $__f6 = ['name' => 'trending_product_date_range', 'value' => __('report.date_range') . ':'];
                        @endphp
                        <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
                        @php
                        $__f7 = ['name' => 'date_range', 'value' => null, 'options' => ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'trending_product_date_range', 'readonly']];
                        @endphp
                        <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                    </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary pull-right">@lang('report.apply_filters')</button>
                </div> 
                <x-form.close />
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @component('components.widget', ['class' => 'box-primary'])
                {!! $chart->container() !!}
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        @component('components.widget', ['class' => 'box-primary'])
            <table class="table" id="expense_report_table">
                <thead>
                    <tr>
                        <th>@lang( 'expense.expense_categories' )</th>
                        <th>@lang( 'report.total_expense' )</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_expense = 0;
                    @endphp
                    @foreach($expenses as $expense)
                        <tr>
                            <td>{{$expense['category'] ?? __('report.others')}}</td>
                            <td><span class="display_currency" data-currency_symbol="true">{{$expense['total_expense']}}</span></td>
                        </tr>
                        @php
                            $total_expense += $expense['total_expense'];
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>@lang('sale.total')</td>
                        <td><span class="display_currency" data-currency_symbol="true">{{$total_expense}}</span></td>
                    </tr>
                </tfoot>
            </table>
        @endcomponent
        </div>
    </div>

</section>
<!-- /.content -->

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    {!! $chart->script() !!}
@endsection