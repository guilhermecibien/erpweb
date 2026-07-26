@extends('layouts.app')
@section('title', 'Contas a pagar')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Contas a pagar</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f1 = ['name' => 'location_id', 'value' => __('purchase.business_location') . ':'];
                        @endphp
                        <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                        @php
                        $__f2 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%']];
                        @endphp
                        <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        @php
                        $__f3 = ['name' => 'expense_for', 'value' => __('expense.expense_for').':'];
                        @endphp
                        <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                        @php
                        $__f4 = ['name' => 'expense_for', 'list' => $users, 'selected' => null, 'options' => ['class' => 'form-control select2']];
                        @endphp
                        <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f5 = ['name' => 'expense_category_id', 'value' => __('expense.expense_category').':'];
                        @endphp
                        <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                        @php
                        $__f6 = ['name' => 'expense_category_id', 'list' => $categories, 'selected' => null, 'options' => ['placeholder' => __('report.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'expense_category_id']];
                        @endphp
                        <x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f7 = ['name' => 'expense_date_range', 'value' => __('report.date_range') . ':'];
                        @endphp
                        <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
                        @php
                        $__f8 = ['name' => 'date_range', 'value' => null, 'options' => ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'expense_date_range', 'readonly']];
                        @endphp
                        <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f9 = ['name' => 'expense_payment_status', 'value' => __('purchase.payment_status') . ':'];
                        @endphp
                        <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
                        @php
                        $__f10 = ['name' => 'expense_payment_status', 'list' => ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial')], 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]];
                        @endphp
                        <x-form.select :name="$__f10['name']" :list="$__f10['list']" :selected="$__f10['selected']" :options="$__f10['options']" />
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary', 'title' => 'Todas as contas a pagar'])
                @can('expense.access')
                    @slot('tool')
                        <div class="box-tools">
                            <a class="btn btn-block btn-primary" href="{{action('ExpenseController@create')}}">
                            <i class="fa fa-plus"></i> @lang('messages.add')</a>
                        </div>
                    @endslot
                @endcan
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="expense_table">
                        <thead>
                            <tr>
                                <th>@lang('messages.action')</th>
                                <th>Fornecedor</th>
                                <th>@lang('messages.date')</th>
                                <th>@lang('purchase.ref_no')</th>
                                <th>@lang('expense.expense_category')</th>
                                <th>@lang('business.location')</th>
                                <th>@lang('sale.payment_status')</th>
                                <th>@lang('product.tax')</th>
                                <th>@lang('sale.total_amount')</th>
                                <th>Total a Pagar</th>
                                <th>@lang('expense.expense_for')</th>
                                <th>@lang('expense.expense_note')</th>
                                <th>@lang('lang_v1.added_by')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 text-center footer-total">
                                <td colspan="6"><strong>@lang('sale.total'):</strong></td>
                                <td id="footer_payment_status_count"></td>
                                <td><span class="display_currency" id="footer_expense_total" data-currency_symbol ="true"></span></td>
                                <td><span class="display_currency" id="footer_total_due" data-currency_symbol ="true"></span></td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endcomponent
        </div>
    </div>

</section>
<!-- /.content -->
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
@stop
@section('javascript')
 <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection