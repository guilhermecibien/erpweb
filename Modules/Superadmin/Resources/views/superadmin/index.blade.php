@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.packages'))

@section('content')
	<section class="content-header sa-header">
		<div class="sa-header-text">
			<h1>Olá, SuperAdmin</h1>
			<p>Visão geral das assinaturas e negócios cadastrados na plataforma.</p>
		</div>
	</section>

	<section class="content sa-dashboard">

		@include('superadmin::layouts.partials.currency')

		<div class="sa-toolbar">
			<div class="sa-filter-pills">
				<label class="sa-filter-pill active">
					<input type="radio" name="date-filter"
					data-start="{{ date('Y-m-d') }}"
					data-end="{{ date('Y-m-d') }}"
					checked> {{ __('home.today') }}
				</label>
				<label class="sa-filter-pill">
					<input type="radio" name="date-filter"
					data-start="{{ $date_filters['this_week']['start']}}"
					data-end="{{ $date_filters['this_week']['end']}}"
					> {{ __('home.this_week') }}
				</label>
				<label class="sa-filter-pill">
					<input type="radio" name="date-filter"
					data-start="{{ $date_filters['this_month']['start']}}"
					data-end="{{ $date_filters['this_month']['end']}}"
					> {{ __('home.this_month') }}
				</label>
				<label class="sa-filter-pill">
					<input type="radio" name="date-filter"
					data-start="{{ $date_filters['this_yr']['start']}}"
					data-end="{{ $date_filters['this_yr']['end']}}"
					> {{ __('superadmin::lang.this_year') }}
				</label>
			</div>
		</div>

		<div class="sa-stats-grid">
			<div class="sa-stat-card sa-stat-card-blue">
				<div class="sa-stat-icon"><i class="fa fa-refresh"></i></div>
				<div class="sa-stat-body">
					<span class="sa-stat-label">@lang('superadmin::lang.new_subscriptions')</span>
					<span class="sa-stat-value new_subscriptions">&nbsp;</span>
				</div>
				<a href="{{action('\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController@index')}}" class="sa-stat-link">
					@lang('superadmin::lang.more_info') <i class="fa fa-arrow-right"></i>
				</a>
			</div>

			<div class="sa-stat-card sa-stat-card-amber">
				<div class="sa-stat-icon"><i class="ion ion-person-add"></i></div>
				<div class="sa-stat-body">
					<span class="sa-stat-label">@lang('superadmin::lang.new_registrations')</span>
					<span class="sa-stat-value new_registrations">&nbsp;</span>
				</div>
				<a href="{{action('\Modules\Superadmin\Http\Controllers\BusinessController@index')}}" class="sa-stat-link">
					@lang('superadmin::lang.more_info') <i class="fa fa-arrow-right"></i>
				</a>
			</div>

			<div class="sa-stat-card sa-stat-card-red">
				<div class="sa-stat-icon"><i class="ion ion-pie-graph"></i></div>
				<div class="sa-stat-body">
					<span class="sa-stat-label">@lang('superadmin::lang.not_subscribed')</span>
					<span class="sa-stat-value">{{$not_subscribed}}</span>
				</div>
				<a href="{{action('\Modules\Superadmin\Http\Controllers\BusinessController@index')}}" class="sa-stat-link">
					@lang('superadmin::lang.more_info') <i class="fa fa-arrow-right"></i>
				</a>
			</div>
		</div>

		<div class="sa-chart-card">
			<div class="sa-chart-header">
				<h3>{{ __('superadmin::lang.monthly_sales_trend') }}</h3>
			</div>
			<div class="sa-chart-body">
				{!! $monthly_sells_chart->container() !!}
			</div>
		</div>

	</section>
@endsection

@section('javascript')
<script type="text/javascript">
	if (window.Highcharts) {
		Highcharts.setOptions({
			lang: {
				viewFullscreen: 'Ver em tela cheia',
				printChart: 'Imprimir gráfico',
				downloadPNG: 'Baixar imagem PNG',
				downloadJPEG: 'Baixar imagem JPEG',
				downloadPDF: 'Baixar documento PDF',
				downloadSVG: 'Baixar imagem SVG',
				contextButtonTitle: 'Opções do gráfico',
				loading: 'Carregando...',
				noData: 'Não há dados para exibir'
			}
		});
	}
</script>

{!! $monthly_sells_chart->script() !!}

<script type="text/javascript">
	$(document).ready(function(){

		var start = $('input[name="date-filter"]:checked').data('start');
		var end = $('input[name="date-filter"]:checked').data('end');
		update_statistics(start, end);
		$(document).on('change', 'input[name="date-filter"]', function(){
			$('.sa-filter-pill').removeClass('active');
			$('input[name="date-filter"]:checked').closest('.sa-filter-pill').addClass('active');

			var start = $('input[name="date-filter"]:checked').data('start');
			var end = $('input[name="date-filter"]:checked').data('end');
			update_statistics(start, end);
		});
	});

	function update_statistics(start, end){
		var data = { start: start, end: end };

		//get purchase details
		var loader = '<i class="fa fa-refresh fa-spin fa-fw"></i>';
		$('.new_subscriptions').html(loader);
		$('.new_registrations').html(loader);
		$.ajax({
			method: "GET",
			url: '/superadmin/stats',
			dataType: "json",
			data: data,
			success: function(data){
				$('.new_subscriptions').html(__currency_trans_from_en(data.new_subscriptions, true, true));
				$('.new_registrations').html(data.new_registrations);
			}
		});
	}
</script>
@endsection
