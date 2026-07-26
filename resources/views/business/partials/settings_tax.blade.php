<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f1 = ['name' => 'tax_label_1', 'value' => __('business.tax_1_name') . ':'];
                @endphp
                <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    @php
                    $__f2 = ['name' => 'tax_label_1', 'value' => $business->tax_label_1, 'options' => ['class' => 'form-control','placeholder' => __('business.tax_1_placeholder')]];
                    @endphp
                    <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f3 = ['name' => 'tax_number_1', 'value' => __('business.tax_1_no') . ':'];
                @endphp
                <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    @php
                    $__f4 = ['name' => 'tax_number_1', 'value' => $business->tax_number_1, 'options' => ['class' => 'form-control']];
                    @endphp
                    <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f5 = ['name' => 'tax_label_2', 'value' => __('business.tax_2_name') . ':'];
                @endphp
                <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    @php
                    $__f6 = ['name' => 'tax_label_2', 'value' => $business->tax_label_2, 'options' => ['class' => 'form-control','placeholder' => __('business.tax_1_placeholder')]];
                    @endphp
                    <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f7 = ['name' => 'tax_number_2', 'value' => __('business.tax_2_no') . ':'];
                @endphp
                <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    @php
                    $__f8 = ['name' => 'tax_number_2', 'value' => $business->tax_number_2, 'options' => ['class' => 'form-control']];
                    @endphp
                    <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f9 = ['name' => 'enable_inline_tax', 'value' => 1, 'checked' => $business->enable_inline_tax, 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f9['name']" :value="$__f9['value']" :checked="$__f9['checked']" :options="$__f9['options']" /> {{ __( 'lang_v1.enable_inline_tax' ) }}
                  </label>
                </div>
            </div>
        </div>
    </div>
</div>