@extends('layouts.app')
@section('title', __('messages.business_location_settings'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'messages.business_location_settings' ) - {{$location->name}}</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">@lang('receipt.receipt_settings')</a></li>
                <li><a href="#tab_2" data-toggle="tab" aria-expanded="true">Certificado</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>@lang('receipt.receipt_settings')
                                <small>@lang( 'receipt.receipt_settings_mgs')</small>
                            </h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            @php
                            $__f1 = ['options' => ['url' => route('location.settings_update', [$location->id]), 'method' => 'post', 'id' => 'bl_receipt_setting_form']];
                            @endphp
                            <x-form.open :options="$__f1['options']" />

                            <div class="col-sm-4">
                                <div class="form-group">
                                    @php
                                    $__f2 = ['name' => 'print_receipt_on_invoice', 'value' => 'Impressão automática após a conclusão' . ':'];
                                    @endphp
                                    <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
                                    @show_tooltip(__('tooltip.print_receipt_on_invoice'))
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-file-alt"></i>
                                        </span>
                                        @php
                                        $__f3 = ['name' => 'print_receipt_on_invoice', 'list' => $printReceiptOnInvoice, 'selected' => $location->print_receipt_on_invoice, 'options' => ['class' => 'form-control select2', 'required']];
                                        @endphp
                                        <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    @php
                                    $__f4 = ['name' => 'receipt_printer_type', 'value' => __('receipt.receipt_printer_type') . ':*'];
                                    @endphp
                                    <x-form.label :name="$__f4['name']" :value="$__f4['value']" /> @show_tooltip(__('tooltip.receipt_printer_type'))
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-print"></i>
                                        </span>
                                        @php
                                        $__f5 = ['name' => 'receipt_printer_type', 'list' => $receiptPrinterType, 'selected' => $location->receipt_printer_type, 'options' => ['class' => 'form-control select2', 'required']];
                                        @endphp
                                        <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
                                    </div>
                                    @if(config('app.env') == 'demo')
                                    <span class="help-block">Only Browser based option is enabled in demo.</span>
                                    @endif

                                </div>
                            </div>

                            <div class="col-sm-4" id="location_printer_div">
                                <div class="form-group">
                                    @php
                                    $__f6 = ['name' => 'printer_id', 'value' => 'Impressoras de recibos' . ':*'];
                                    @endphp
                                    <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-share-alt"></i>
                                        </span>
                                        @php
                                        $__f7 = ['name' => 'printer_id', 'list' => $printers, 'selected' => $location->printer_id, 'options' => ['class' => 'form-control select2']];
                                        @endphp
                                        <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br/>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    @php
                                    $__f8 = ['name' => 'invoice_layout_id', 'value' => __('invoice.invoice_layout') . ':*'];
                                    @endphp
                                    <x-form.label :name="$__f8['name']" :value="$__f8['value']" /> @show_tooltip(__('tooltip.invoice_layout'))
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-info"></i>
                                        </span>
                                        @php
                                        $__f9 = ['name' => 'invoice_layout_id', 'list' => $invoice_layouts, 'selected' => $location->invoice_layout_id, 'options' => ['class' => 'form-control select2', 'required']];
                                        @endphp
                                        <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    @php
                                    $__f10 = ['name' => 'invoice_scheme_id', 'value' => __('invoice.invoice_scheme') . ':*'];
                                    @endphp
                                    <x-form.label :name="$__f10['name']" :value="$__f10['value']" /> @show_tooltip(__('tooltip.invoice_scheme'))
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-info"></i>
                                        </span>
                                        @php
                                        $__f11 = ['name' => 'invoice_scheme_id', 'list' => $invoice_schemes, 'selected' => $location->invoice_scheme_id, 'options' => ['class' => 'form-control select2', 'required']];
                                        @endphp
                                        <x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group">
                                    @php
                                    $__f12 = ['name' => 'invoice_scheme_id', 'value' => 'Informação complementar' . ':*'];
                                    @endphp
                                    <x-form.label :name="$__f12['name']" :value="$__f12['value']" /> @show_tooltip('Informação complementar para NFe')
                                    @php
                                    $__f13 = ['name' => 'info_complementar', 'value' => $location->info_complementar, 'options' => ['class' => 'form-control', 'rows' => 3]];
                                    @endphp
                                    <x-form.textarea :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />

                                </div>
                            </div>




                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary pull-right" type="submit">@lang('messages.update')</button>
                                </div>
                            </div>
                            <x-form.close />
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab_2">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Configuração de Certificado
                            </h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">

                            @php
                            $__f15 = ['options' => ['url' => route('location.settings_update_certificado', [$location->id]), 'method' => 'post', 'id' => 'bl_receipt_setting_form', 'files' => true ]];
                            @endphp
                            <x-form.open :options="$__f15['options']" />


                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="certificado">Certificado:</label>
                                        <input name="certificado" type="file" id="certificado">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        @php
                                        $__f16 = ['name' => 'senha_certificado', 'value' => 'Senha' . ':'];
                                        @endphp
                                        <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
                                        @php
                                        $__f17 = ['name' => 'senha_certificado', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Senha']];
                                        @endphp
                                        <x-form.input type="text" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
                                    </div>
                                </div>

                                @if($infoCertificado != null && $infoCertificado != -1)
                                <h5>Serial: <strong>{{$infoCertificado['serial']}}</strong></h5>
                                <h5>Expiração: <strong>{{$infoCertificado['expiracao']}}</strong></h5>
                                <h5>ID: <strong>{{$infoCertificado['id']}}</strong></h5>
                                @endif

                                @if($infoCertificado == -1)
                                <h5 style="color: red">Erro na leitura do certificado, verifique a senha e outros dados, e realize o upload novamente!!</h5>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-primary pull-right" type="submit">Salvar</button>
                        </div>
                    </div>
                    <x-form.close />

                </div>
            </div>
        </div>
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->
</div>
</div>

<div class="modal fade invoice_modal" tabindex="-1" role="dialog" 
aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade invoice_edit_modal" tabindex="-1" role="dialog" 
aria-labelledby="gridSystemModalLabel">
</div>

</section>
<!-- /.content -->

@endsection
