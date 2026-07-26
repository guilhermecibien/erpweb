<div class="pos-tab-content">
     <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f1 = ['name' => 'stock_expiry_alert_days', 'value' => 'Veja o alerta de expiração da estoque para' . ':*'];
                @endphp
                <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fas fa-calendar-times"></i>
                </span>
                @php
                $__f2 = ['name' => 'stock_expiry_alert_days', 'value' => $business->stock_expiry_alert_days, 'options' => ['class' => 'form-control','required']];
                @endphp
                <x-form.input type="number" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
                <span class="input-group-addon">
                    Dias
                </span>
                </div>
            </div>
        </div>
    </div>
</div>