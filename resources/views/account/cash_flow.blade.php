@extends('layouts.app')
@section('title', __('lang_v1.cash_flow'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('lang_v1.cash_flow')
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title"> <i class="fa fa-filter" aria-hidden="true"></i> @lang('report.filters'):</h3>
                </div>
                <div class="box-body">
                    <div class="col-sm-4">
                        <div class="form-group">
                            @php
                            $__f1 = ['name' => 'account_id', 'value' => __('account.account') . ':'];
                            @endphp
                            <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                            @php
                            $__f2 = ['name' => 'account_id', 'list' => $accounts, 'selected' => '', 'options' => ['class' => 'form-control', 'placeholder' => __('messages.all')]];
                            @endphp
                            <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            @php
                            $__f3 = ['name' => 'transaction_date_range', 'value' => __('report.date_range') . ':'];
                            @endphp
                            <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                @php
                                $__f4 = ['name' => 'transaction_date_range', 'value' => null, 'options' => ['class' => 'form-control', 'readonly', 'placeholder' => __('report.date_range')]];
                                @endphp
                                <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            @php
                            $__f5 = ['name' => 'transaction_type', 'value' => __('account.transaction_type') . ':'];
                            @endphp
                            <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-exchange-alt"></i></span>
                                @php
                                $__f6 = ['name' => 'transaction_type', 'list' => ['' => __('messages.all'),'debit' => __('account.debit'), 'credit' => __('account.credit')], 'selected' => '', 'options' => ['class' => 'form-control']];
                                @endphp
                                <x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        	<div class="box">
                <div class="box-body">
                    @can('account.access')
                        <div class="table-responsive">
                    	<table class="table table-bordered table-striped" id="cash_flow_table">
                    		<thead>
                    			<tr>
                                    <th>@lang( 'messages.date' )</th>
                                    <th>@lang( 'account.account' )</th>
                                    <th>@lang( 'lang_v1.description' )</th>
                    				<th>@lang('account.credit')</th>
                                    <th>@lang('account.debit')</th>
                    				<th>@lang( 'lang_v1.balance' )</th>
                    			</tr>
                    		</thead>
                    	</table>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade account_model" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection

@section('javascript')
<script>
    $(document).ready(function(){

        // dateRangeSettings.autoUpdateInput = false
        $('#transaction_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#transaction_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                cash_flow_table.ajax.reload();
            }
        );
        
        // Cash Flow Table
        cash_flow_table = $('#cash_flow_table').DataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                    "url": "{{action("AccountController@cashFlow")}}",
                    "data": function ( d ) {
                        var start = '';
                        var end = '';
                        if($('#transaction_date_range').val() != ''){
                            start = $('#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                            end = $('#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        }
                        
                        d.account_id = $('#account_id').val();
                        d.type = $('#transaction_type').val();
                        d.start_date = start,
                        d.end_date = end
                    }
                },
            "ordering": false,
            "searching": false,
            columns: [
                {data: 'operation_date', name: 'operation_date'},
                {data: 'account_name', name: 'account_name'},
                {data: 'sub_type', name: 'sub_type'},
                {data: 'credit', name: 'amount'},
                {data: 'debit', name: 'amount'},
                {data: 'balance', name: 'balance'},
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#cash_flow_table'));
            }
        });
        $('#transaction_type, #account_id').change( function(){
            cash_flow_table.ajax.reload();
        });
        $('#transaction_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#transaction_date_range').val('').change();
            cash_flow_table.ajax.reload();
        });

    });
</script>
@endsection