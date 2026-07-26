<div class="tab-pane 
    @if(!empty($view_type) &&  $view_type == 'subscriptions')
        active
    @else
        ''
    @endif"
id="subscriptions_tab">
    <div class="row">
        <div class="col-md-12">
            @component('components.widget')
                <div class="col-md-3">
                    <div class="form-group">
                        @php
                        $__f1 = ['name' => 'subscriptions_filter_date_range', 'value' => __('report.date_range') . ':'];
                        @endphp
                        <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                        @php
                        $__f2 = ['name' => 'subscriptions_filter_date_range', 'value' => null, 'options' => ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']];
                        @endphp
                        <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('sale_pos.partials.subscriptions_table')
        </div>
    </div>
</div>