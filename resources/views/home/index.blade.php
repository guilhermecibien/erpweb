@extends('layouts.app')
@section('title', __('home.home'))

@section('content')

@if(auth()->user()->can('dashboard.data'))
<!-- Content Header (Page header) -->
<section class="content-header content-header-custom">
    <!-- <h1>{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}
    </h1> -->
</section>
<!-- Main content -->
<section class="content content-custom no-print">
  <br>

  @php
    $__i18n = [
        'select_location' => __('lang_v1.select_location'),
        'today' => 'Hoje',
        'this_week' => 'Esta Semana',
        'this_month' => 'Este Mês',
        'this_year' => 'Este Ano',
        'kpi' => [
            'total_purchase' => __('home.total_purchase'),
            'total_sell' => __('home.total_sell'),
            'purchase_due' => __('home.purchase_due'),
            'invoice_due' => __('home.invoice_due'),
            'expense' => __('lang_v1.expense'),
        ],
        'sales_payment_dues' => __('lang_v1.sales_payment_dues'),
        'purchase_payment_dues' => __('lang_v1.purchase_payment_dues'),
        'product_stock_alert' => __('home.product_stock_alert'),
        'customer' => __('contact.customer'),
        'invoice_no' => __('sale.invoice_no'),
        'supplier' => __('purchase.supplier'),
        'ref_no' => __('purchase.ref_no'),
        'due_amount' => __('home.due_amount'),
        'no_data' => 'Nenhum registro encontrado',
        'stock_alert' => [
            'product' => __('sale.product'),
            'location' => __('business.location'),
            'stock' => __('report.current_stock'),
            'empty' => 'Nenhum registro encontrado',
        ],
    ];
  @endphp

  <div
    id="dashboard-app"
    data-all-locations="{{ json_encode($all_locations) }}"
    data-date-filters="{{ json_encode($date_filters) }}"
    data-i18n="{{ json_encode($__i18n) }}"
  ></div>

    @if(!empty($widgets['after_sale_purchase_totals']))
      @foreach($widgets['after_sale_purchase_totals'] as $widget)
        {!! $widget !!}
      @endforeach
    @endif
    @if(!empty($widgets['after_sales_last_30_days']))
      @foreach($widgets['after_sales_last_30_days'] as $widget)
        {!! $widget !!}
      @endforeach
    @endif
    @if(!empty($widgets['after_sales_current_fy']))
      @foreach($widgets['after_sales_current_fy'] as $widget)
        {!! $widget !!}
      @endforeach
    @endif

    <div class="row">
      @can('stock_report.view')
        @if(session('business.enable_product_expiry') == 1)
          <div class="col-sm-6">
              @component('components.widget', ['class' => 'box-warning'])
                  @slot('icon')
                    <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                  @endslot
                  @slot('title')
                    {{ __('home.stock_expiry_alert') }} @show_tooltip( __('tooltip.stock_expiry_alert', [ 'days' =>session('business.stock_expiry_alert_days', 30) ]) )
                  @endslot
                  <input type="hidden" id="stock_expiry_alert_days" value="{{ \Carbon::now()->addDays(session('business.stock_expiry_alert_days', 30))->format('Y-m-d') }}">
                  <table class="table table-bordered table-striped" id="stock_expiry_alert_table">
                    <thead>
                      <tr>
                          <th>@lang('business.product')</th>
                          <th>@lang('business.location')</th>
                          <th>@lang('report.stock_left')</th>
                          <th>@lang('product.expires_in')</th>
                      </tr>
                    </thead>
                  </table>
              @endcomponent
          </div>
        @endif
      @endcan
  	</div>

    @if(!empty($widgets['after_dashboard_reports']))
      @foreach($widgets['after_dashboard_reports'] as $widget)
        {!! $widget !!}
      @endforeach
    @endif
</section>
<!-- /.content -->
@else
<section class="content-header">
    <h1>{{ __('home.home') }}</h1>
</section>
<section class="content no-print empty-dashboard-wrapper">
    <div class="empty-dashboard">
        <i class="fas fa-store empty-dashboard-icon"></i>
        <h2>{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}</h2>
        <p>{{ __('lang_v1.empty_dashboard_message') }}</p>
        @php
            $administrators = array_filter(array_map('trim', explode(',', (string) config('constants.administrator_usernames', ''))));
            $is_superadmin = in_array(trim((string) auth()->user()->username), $administrators, true);
        @endphp
        @if($is_superadmin)
        <a href="{{ url('superadmin') }}" class="btn btn-primary empty-dashboard-btn">
            {{ __('lang_v1.go_to_superadmin_panel') }} <i class="fas fa-arrow-right"></i>
        </a>
        @endif
    </div>
</section>
@endif
@stop
@section('javascript')
@if(auth()->user()->can('dashboard.data'))
    <script src="{{ asset('js/dashboard.js?v=' . $asset_v) }}"></script>
    @can('stock_report.view')
      @if(session('business.enable_product_expiry') == 1)
        <script>
        $(document).ready(function() {
            $('#stock_expiry_alert_table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                dom: 'Btirp',
                ajax: {
                    url: '/reports/stock-expiry',
                    data: function(d) {
                        d.exp_date_filter = $('#stock_expiry_alert_days').val();
                    },
                },
                order: [[3, 'asc']],
                columns: [
                    { data: 'product', name: 'p.name' },
                    { data: 'location', name: 'l.name' },
                    { data: 'stock_left', name: 'stock_left' },
                    { data: 'exp_date', name: 'exp_date' },
                ],
                fnDrawCallback: function(oSettings) {
                    __show_date_diff_for_human($('#stock_expiry_alert_table'));
                    __currency_convert_recursively($('#stock_expiry_alert_table'));
                },
            });
        });
        </script>
      @endif
    @endcan
@endif
@endsection

