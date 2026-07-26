@php 
$colspan = 15;
$custom_labels = json_decode(session('business.custom_labels'), true);
@endphp
<div class="table-responsive">
    <table class="table table-bordered table-striped ajax_view hide-footer" id="product_table">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all-row"></th>
                <th>&nbsp;</th>
                <th>@lang('sale.product')</th>
                <th>@lang('purchase.business_location') @show_tooltip(__('lang_v1.product_business_location_tooltip'))</th>
                @can('view_purchase_price')
                @php 
                $colspan++;
                @endphp
                <th>@lang('lang_v1.unit_perchase_price')</th>
                @endcan
                @can('access_default_selling_price')
                @php 
                $colspan++;
                @endphp
                <th>@lang('lang_v1.selling_price')</th>
                @endcan
                <th>@lang('report.current_stock')</th>
                <th>@lang('product.product_type')</th>
                <th>@lang('product.category')</th>
                <th>@lang('product.brand')</th>
                <th>@lang('product.tax')</th>
                <th>@lang('product.sku')</th>
                <th>NCM</th>
                <th>CFOP</th>
                <th>CEST</th>
                <th style="display: none;"></th>
                <th>@lang('messages.action')</th>


            </tr>
        </thead>

    </table>


</div>

<div class="row" style="margin-left: 5px;">
    <tr >
        <td colspan="{{$colspan}}">
            <div style="display: flex; width: 100%;">
                @can('product.delete')
                @php
                $__f1 = ['options' => ['url' => action('ProductController@massDestroy'), 'method' => 'post', 'id' => 'mass_delete_form' ]];
                @endphp
                <x-form.open :options="$__f1['options']" />
                @php
                $__f2 = ['name' => 'selected_rows', 'value' => null, 'options' => ['id' => 'selected_rows']];
                @endphp
                <x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
                @php
                $__f3 = ['value' => __('lang_v1.delete_selected'), 'options' => array('class' => 'btn btn-xs btn-danger', 'id' => 'delete-selected')];
                @endphp
                <x-form.submit :value="$__f3['value']" :options="$__f3['options']" />
                <x-form.close />
                @endcan
                @can('product.update')
                &nbsp;
                @php
                $__f5 = ['options' => ['url' => action('ProductController@bulkEdit'), 'method' => 'post', 'id' => 'bulk_edit_form' ]];
                @endphp
                <x-form.open :options="$__f5['options']" />
                @php
                $__f6 = ['name' => 'selected_products', 'value' => null, 'options' => ['id' => 'selected_products_for_edit']];
                @endphp
                <x-form.input type="hidden" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
                <button type="submit" class="btn btn-xs btn-primary" id="edit-selected"> <i class="fa fa-edit"></i>{{__('lang_v1.bulk_edit')}}</button>
                <x-form.close />
                &nbsp;
                <button type="button" class="btn btn-xs btn-success update_product_location" data-type="add">Adicionar localização</button>
                &nbsp;
                <button type="button" class="btn btn-xs bg-navy update_product_location" data-type="remove">Remover localização</button>
                @endcan
                &nbsp;
                @php
                $__f8 = ['options' => ['url' => action('ProductController@massDeactivate'), 'method' => 'post', 'id' => 'mass_deactivate_form' ]];
                @endphp
                <x-form.open :options="$__f8['options']" />
                @php
                $__f9 = ['name' => 'selected_products', 'value' => null, 'options' => ['id' => 'selected_products']];
                @endphp
                <x-form.input type="hidden" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
                @php
                $__f10 = ['value' => 'Desativar selecionado', 'options' => array('class' => 'btn btn-xs btn-warning', 'id' => 'deactivate-selected')];
                @endphp
                <x-form.submit :value="$__f10['value']" :options="$__f10['options']" />
                <x-form.close /> @show_tooltip('Destivar os produtos selecionados')
            </div>
        </td>
    </tr>
</div>