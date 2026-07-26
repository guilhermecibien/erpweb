@extends('layouts.app')
@section('title', __( 'lang_v1.quotation'))
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>@lang('lang_v1.list_quotations')
        <small></small>
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
        @component('components.filters', ['title' => __('report.filters')])
        <div class="col-md-3">
            <div class="form-group">
                @php
                $__f1 = ['name' => 'sell_list_filter_location_id', 'value' => __('purchase.business_location') . ':'];
                @endphp
                <x-form.label :name="$__f1['name']" :value="$__f1['value']" />

                @php
                $__f2 = ['name' => 'sell_list_filter_location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]];
                @endphp
                <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                @php
                $__f3 = ['name' => 'sell_list_filter_customer_id', 'value' => __('contact.customer') . ':'];
                @endphp
                <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                @php
                $__f4 = ['name' => 'sell_list_filter_customer_id', 'list' => $customers, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]];
                @endphp
                <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                @php
                $__f5 = ['name' => 'sell_list_filter_date_range', 'value' => __('report.date_range') . ':'];
                @endphp
                <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                @php
                $__f6 = ['name' => 'sell_list_filter_date_range', 'value' => null, 'options' => ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']];
                @endphp
                <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                @php
                $__f7 = ['name' => 'created_by', 'value' => __('report.user') . ':'];
                @endphp
                <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
                @php
                $__f8 = ['name' => 'created_by', 'list' => $sales_representative, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%']];
                @endphp
                <x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
            </div>
        </div>
    @endcomponent
    @component('components.widget', ['class' => 'box-primary'])
        @slot('tool')
            <div class="box-tools">
                <a class="btn btn-block btn-primary" href="{{action('SellPosController@create')}}">
                <i class="fa fa-plus"></i> @lang('messages.add')</a>
            </div>
        @endslot
        <div class="table-responsive">
            <table class="table table-bordered table-striped ajax_view" id="sell_table">
                <thead>
                    <tr>
                        <th>@lang('messages.date')</th>
                        <th>@lang('purchase.ref_no')</th>
                        <th>@lang('sale.customer_name')</th>
                        <th>@lang('sale.location')</th>
                        <th>@lang('messages.action')</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endcomponent
</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
$(document).ready( function(){
    //Date range as a button
    $('#sell_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            sell_table.ajax.reload();
        }
    );
    $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#sell_list_filter_date_range').val('');
        sell_table.ajax.reload();
    });
    
    sell_table = $('#sell_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[0, 'desc']],
        "ajax": {
            "url": '/sells/draft-dt?is_quotation=1',
            "data": function ( d ) {
                if($('#sell_list_filter_date_range').val()) {
                    var start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    d.start_date = start;
                    d.end_date = end;
                }

                if($('#sell_list_filter_location_id').length) {
                    d.location_id = $('#sell_list_filter_location_id').val();
                }
                d.customer_id = $('#sell_list_filter_customer_id').val();

                if($('#created_by').length) {
                    d.created_by = $('#created_by').val();
                }
            }
        },
        columnDefs: [ {
            "targets": 4,
            "orderable": false,
            "searchable": false
        } ],
        columns: [
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'invoice_no', name: 'invoice_no'},
            { data: 'name', name: 'contacts.name'},
            { data: 'business_location', name: 'bl.name'},
            { data: 'action', name: 'action'}
        ],
        "fnDrawCallback": function (oSettings) {
            __currency_convert_recursively($('#purchase_table'));
        }
    });
    
    $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #created_by',  function() {
        sell_table.ajax.reload();
    });
});
</script>
	
@endsection