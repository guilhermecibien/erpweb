<div class="pos-tab-content">
     <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f1 = ['name' => 'theme_color', 'value' => __('lang_v1.theme_color')];
                @endphp
                <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                @php
                $__f2 = ['name' => 'theme_color', 'list' => $theme_colors, 'selected' => $business->theme_color, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']];
                @endphp
                <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $page_entries = [10 => 10, 25 => 25, 50 => 50, 100 => 100, 200 => 200, 500 => 500, 1000 => 1000, -1 => __('lang_v1.all')];
                @endphp
                @php
                $__f3 = ['name' => 'default_datatable_page_entries', 'value' => __('lang_v1.default_datatable_page_entries')];
                @endphp
                <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                @php
                $__f4 = ['name' => 'common_settings[default_datatable_page_entries]', 'list' => $page_entries, 'selected' => !empty($common_settings['default_datatable_page_entries']) ? $common_settings['default_datatable_page_entries'] : 25, 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'default_datatable_page_entries']];
                @endphp
                <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                  <label>
                    @php
                    $__f5 = ['name' => 'enable_tooltip', 'value' => 1, 'checked' => $business->enable_tooltip, 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f5['name']" :value="$__f5['value']" :checked="$__f5['checked']" :options="$__f5['options']" /> {{ __( 'business.show_help_text' ) }}
                  </label>
                </div>
            </div>
        </div>
    </div>
</div>