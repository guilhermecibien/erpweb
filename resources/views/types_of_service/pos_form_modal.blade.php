<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{$types_of_service->name}}</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="form-group col-md-12">
                    @php
                        $packing_charge = !empty($transaction) ? $transaction->packing_charge : $types_of_service->packing_charge;
                        $packing_charge_type = !empty($transaction) ? $transaction->packing_charge_type : $types_of_service->packing_charge_type;
                    @endphp
                    @php
                    $__f1 = ['name' => 'packing_charge', 'value' => __( 'lang_v1.packing_charge' ) . ':'];
                    @endphp
                    <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                    <div class="input-group" @if($types_of_service->packing_charge_type != 'percent') style="width: 100%;" @endif>
                        @php
                        $__f2 = ['name' => 'packing_charge', 'value' => number_format($packing_charge, 2, ',', '.'), 'options' => ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.packing_charge'), 'style' => 'width: 100%;' ]];
                        @endphp
                        <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
                        @if($packing_charge_type == 'percent')
                            <span class="input-group-addon">%</span>
                        @endif

                        @php
                        $__f3 = ['name' => 'packing_charge_type', 'value' => $packing_charge_type, 'options' => ['id' => 'packing_charge_type']];
                        @endphp
                        <x-form.input type="hidden" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
                    </div>
                </div>
                @if($types_of_service->enable_custom_fields == 1)
                    @php
                        $custom_labels = json_decode(session('business.custom_labels'), true);
                        $service_custom_field_1 = !empty($custom_labels['types_of_service']['custom_field_1']) ? $custom_labels['types_of_service']['custom_field_1'] : __('lang_v1.service_custom_field_1');
                        $service_custom_field_2 = !empty($custom_labels['types_of_service']['custom_field_2']) ? $custom_labels['types_of_service']['custom_field_2'] : __('lang_v1.service_custom_field_2');
                        $service_custom_field_3 = !empty($custom_labels['types_of_service']['custom_field_3']) ? $custom_labels['types_of_service']['custom_field_3'] : __('lang_v1.service_custom_field_3');
                        $service_custom_field_4 = !empty($custom_labels['types_of_service']['custom_field_4']) ? $custom_labels['types_of_service']['custom_field_4'] : __('lang_v1.service_custom_field_4');
                    @endphp
                    <div class="form-group col-md-6">
                        @php
                        $__f4 = ['name' => 'service_custom_field_1', 'value' => $service_custom_field_1 . ':'];
                        @endphp
                        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
                        @php
                        $__f5 = ['name' => 'service_custom_field_1', 'value' => !empty($transaction) ? $transaction->service_custom_field_1 : null, 'options' => ['class' => 'form-control', 'placeholder' => $service_custom_field_1 ]];
                        @endphp
                        <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
                    </div>
                    <div class="form-group col-md-6">
                        @php
                        $__f6 = ['name' => 'service_custom_field_2', 'value' => $service_custom_field_2 . ':'];
                        @endphp
                        <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
                        @php
                        $__f7 = ['name' => 'service_custom_field_2', 'value' => !empty($transaction) ? $transaction->service_custom_field_2 : null, 'options' => ['class' => 'form-control', 'placeholder' => $service_custom_field_2 ]];
                        @endphp
                        <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                    </div>
                    <div class="form-group col-md-6">
                        @php
                        $__f8 = ['name' => 'service_custom_field_3', 'value' => $service_custom_field_3 . ':'];
                        @endphp
                        <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
                        @php
                        $__f9 = ['name' => 'service_custom_field_3', 'value' => !empty($transaction) ? $transaction->service_custom_field_3 : null, 'options' => ['class' => 'form-control', 'placeholder' => $service_custom_field_3 ]];
                        @endphp
                        <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
                    </div>
                    <div class="form-group col-md-6">
                        @php
                        $__f10 = ['name' => 'service_custom_field_4', 'value' => $service_custom_field_4 . ':'];
                        @endphp
                        <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
                        @php
                        $__f11 = ['name' => 'service_custom_field_4', 'value' => !empty($transaction) ? $transaction->service_custom_field_4 : null, 'options' => ['class' => 'form-control', 'placeholder' => $service_custom_field_4 ]];
                        @endphp
                        <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
                    </div>
                @endif
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->