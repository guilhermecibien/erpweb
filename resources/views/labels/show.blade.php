@extends('layouts.app')
@section('title', __('barcode.print_labels'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
<br>
    <h1>@lang('barcode.print_labels') @show_tooltip(__('tooltip.print_label'))</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content no-print">
	@php
	$__f1 = ['options' => ['url' => '#', 'method' => 'post', 'id' => 'preview_setting_form', 'onsubmit' => 'return false']];
	@endphp
	<x-form.open :options="$__f1['options']" />
	@component('components.widget', ['class' => 'box-primary', 'title' => __('product.add_product_for_labels')])
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-search"></i>
						</span>
						@php
						$__f2 = ['name' => 'search_product', 'value' => null, 'options' => ['class' => 'form-control', 'id' => 'search_product_for_label', 'placeholder' => __('lang_v1.enter_product_name_to_print_labels'), 'autofocus']];
						@endphp
						<x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<table class="table table-bordered table-striped table-condensed" id="product_table">
					<thead>
						<tr>
							<th class="col-sm-8">@lang( 'barcode.products' )</th>
							<th class="col-sm-4">@lang( 'barcode.no_of_labels' )</th>
						</tr>
					</thead>
					<tbody>
						@include('labels.partials.show_table_rows', ['index' => 0])
					</tbody>
				</table>
			</div>
		</div>
	@endcomponent

	@component('components.widget', ['class' => 'box-primary', 'title' => __( 'barcode.info_in_labels' )])
		<div class="row">
			<div class="col-sm-3">
				<div class="checkbox">
				    <label>
				    	<input type="checkbox" checked name="print[name]" value="1"> <b>@lang( 'barcode.print_name' )</b>
				    </label>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="checkbox">
				    <label>
				    	<input type="checkbox" checked name="print[variations]" value="1"> <b>@lang( 'barcode.print_variations' )</b>
				    </label>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="checkbox">
				    <label>
				    	<input type="checkbox" checked name="print[price]" value="1" id="is_show_price"> <b>@lang( 'barcode.print_price' )</b>
				    </label>
				</div>
			</div>

			<div class="col-sm-3" id="price_type_div">
				<div class="form-group">
					@php
					$__f3 = ['name' => 'print[price_type]', 'value' => @trans( 'barcode.show_price' ) . ':'];
					@endphp
					<x-form.label :name="$__f3['name']" :value="$__f3['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-info"></i>
						</span>
						@php
						$__f4 = ['name' => 'print[price_type]', 'list' => ['inclusive' => __('product.inc_of_tax'), 'exclusive' => __('product.exc_of_tax')], 'selected' => 'inclusive', 'options' => ['class' => 'form-control']];
						@endphp
						<x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
					</div>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="checkbox">
				    <label>
				    	<input type="checkbox" checked name="print[business_name]" value="1"> <b>@lang( 'barcode.print_business_name' )</b>
				    </label>
				</div>
			</div>

			<div class="col-sm-12">
				<hr/>
			</div>

			<div class="col-sm-4">
				<div class="form-group">
					@php
					$__f5 = ['name' => 'price_type', 'value' => @trans( 'barcode.barcode_setting' ) . ':'];
					@endphp
					<x-form.label :name="$__f5['name']" :value="$__f5['value']" />
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-cog"></i>
						</span>
						@php
						$__f6 = ['name' => 'barcode_setting', 'list' => $barcode_settings, 'selected' => null, 'options' => ['class' => 'form-control']];
						@endphp
						<x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
					</div>
				</div>
			</div>

			<div class="clearfix"></div>
			
			<div class="col-sm-4 col-sm-offset-8">
				<button type="button" id="labels_preview" class="btn btn-primary pull-right btn-flat btn-block">@lang( 'barcode.preview' )</button>
			</div>
		</div>
	@endcomponent
	<x-form.close />

	<div class="col-sm-8 hide display_label_div">
		<h3 class="box-title">@lang( 'barcode.preview' )</h3>
		<button type="button" class="col-sm-offset-2 btn btn-success btn-block" id="print_label">Print</button>
	</div>
	<div class="clearfix"></div>
</section>

<!-- Preview section-->
<div id="preview_box">
</div>

@stop
@section('javascript')
	<script src="{{ asset('js/labels.js?v=' . $asset_v) }}"></script>
@endsection
