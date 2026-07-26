@extends('layouts.app')
@section('title', __('restaurant.service_staff_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('restaurant.service_staff_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f1 = ['name' => 'ssr_location_id', 'value' => __('purchase.business_location') . ':'];
                        @endphp
                        <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                        @php
                        $__f2 = ['name' => 'ssr_location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%']];
                        @endphp
                        <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f3 = ['name' => 'service_staff_id', 'value' => __('restaurant.service_staff') . ':'];
                        @endphp
                        <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                        @php
                        $__f4 = ['name' => 'service_staff_id', 'list' => $waiters, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]];
                        @endphp
                        <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f5 = ['name' => 'ssr_date_range', 'value' => __('report.date_range') . ':'];
                        @endphp
                        <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                        @php
                        $__f6 = ['name' => 'date_range', 'value' => \Carbon::createFromTimestamp(strtotime('first day of this month'))->format(session('business.date_format')) . ' ~ ' . \Carbon::createFromTimestamp(strtotime('last day of this month'))->format(session('business.date_format')), 'options' => ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'ssr_date_range', 'readonly']];
                        @endphp
                        <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#ss_orders_tab" data-toggle="tab" aria-expanded="true">@lang('restaurant.orders')</a>
                    </li>

                    <li>
                        <a href="#ss_line_orders_tab" data-toggle="tab" aria-expanded="true">@lang('lang_v1.line_orders')</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="ss_orders_tab">
                        @include('report.partials.service_staff_orders_table')
                    </div>

                    <div class="tab-pane" id="ss_line_orders_tab">
                        @include('report.partials.service_staff_line_orders_table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
    
    <script type="text/javascript">
        $(document).ready(function(){
            if($('#ssr_date_range').length == 1){
                $('#ssr_date_range').daterangepicker({
                    ranges: ranges,
                    autoUpdateInput: false,
                    startDate: moment().startOf('month'),
                    endDate: moment().endOf('month'),
                    locale: {
                        format: moment_date_format
                    }
                });
                $('#ssr_date_range').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format(moment_date_format) + ' ~ ' + picker.endDate.format(moment_date_format));
                    service_staff_report.ajax.reload();
                    service_staff_line_orders.ajax.reload();
                });

                $('#ssr_date_range').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                    service_staff_report.ajax.reload();
                    service_staff_line_orders.ajax.reload();
                });
            }

        service_staff_report = $('table#service_staff_report').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[0, 'desc']],
            "ajax": {
                "url": "/sells",
                "data": function ( d ) {
                    var start = $('input#ssr_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var end = $('input#ssr_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');

                    d.list_for = 'service_staff_report';
                    d.location_id = $('select#ssr_location_id').val();
                    d.start_date = start;
                    d.end_date = end;
                    d.res_waiter_id = $('select#service_staff_id').val();
                }
            },
            columns: [
                { data: 'transaction_date', name: 'transaction_date'  },
                { data: 'invoice_no', name: 'invoice_no'},
                { data: 'waiter', name: 'ss.first_name'},
                { data: 'business_location', name: 'bl.name'},
                { data: 'total_before_tax', name: 'transactions.total_before_tax'},
                { data: 'discount_amount', name: 'transactions.discount_amount'},
                { data: 'tax_amount', name: 'transactions.tax_amount'},
                { data: 'final_total', name: 'final_total'}
            ],
            columnDefs: [
                    {
                        'searchable'    : false, 
                        'targets'       : [4, 5, 6] 
                    },
                ],
            "fnDrawCallback": function (oSettings) {
                $('#footer_total_amount').text(sum_table_col($('#service_staff_report'), 'final-total'));
                $('#footer_subtotal').text(sum_table_col($('#service_staff_report'), 'total_before_tax'));
                $('#footer_total_tax').text(sum_table_col($('#service_staff_report'), 'total-tax'));

                $('#footer_total_discount').text(sum_table_col($('#service_staff_report'), 'total-discount'));
                
                __currency_convert_recursively($('#service_staff_report'));
            }
        });

        service_staff_line_orders = $('table#service_staff_line_orders').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[0, 'desc']],
            "ajax": {
                "url": "/reports/service-staff-line-orders",
                "data": function ( d ) {
                    var start = $('input#ssr_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var end = $('input#ssr_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');

                    d.location_id = $('select#ssr_location_id').val();
                    d.start_date = start;
                    d.end_date = end;
                    d.service_staff_id = $('select#service_staff_id').val();
                }
            },
            columns: [
                { data: 'transaction_date', name: 't.transaction_date'  },
                { data: 'invoice_no', name: 't.invoice_no'},
                { data: 'service_staff', name: 'ss.first_name'},
                { data: 'product_name', name: 'p.name'},
                { data: 'quantity', name: 'quantity'},
                { data: 'unit_price_before_discount', name: 'unit_price_before_discount'},
                { data: 'line_discount_amount', name: 'line_discount_amount'},
                { data: 'item_tax', name: 'item_tax'},
                { data: 'unit_price_inc_tax', name: 'unit_price_inc_tax'},
                { data: 'total', searchable: false}
            ],
            "fnDrawCallback": function (oSettings) {
                $('#sslo_quantity').html(__sum_stock($('#service_staff_line_orders'), 'quantity'));
                $('#sslo_total_tax').text(sum_table_col($('#service_staff_line_orders'), 'item_tax'));
                $('#sslo_unit_price').text(sum_table_col($('#service_staff_line_orders'), 'unit_price_before_discount'));
                $('#sslo_total_discount').text(sum_table_col($('#service_staff_line_orders'), 'total-discount'));

                $('#sslo_subtotal').text(sum_table_col($('#service_staff_line_orders'), 'unit_price_inc_tax'));
                $('#sslo_total').text(sum_table_col($('#service_staff_line_orders'), 'total'));
                
                __currency_convert_recursively($('#service_staff_line_orders'));
            }
        });

            
        //Customer Group report filter
        $('select#ssr_location_id, #ssr_date_range, #service_staff_id').change( function(){
            service_staff_report.ajax.reload();
            service_staff_line_orders.ajax.reload();
        });
    })
    </script>
@endsection