<div class="pos-tab-content">
    <h4>@lang('business.add_keyboard_shortcuts'):</h4>
    <p class="help-block">@lang('lang_v1.shortcut_help'); @lang('lang_v1.example'): <b>ctrl+shift+b</b>, <b>ctrl+h</b></p>
    <p class="help-block">
        <b>@lang('lang_v1.available_key_names_are'):</b>
        <br> shift, ctrl, alt, backspace, tab, enter, return, capslock, esc, escape, space, pageup, pagedown, end, home, <br>left, up, right, down, ins, del, and plus
    </p>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th>@lang('business.operations')</th>
                    <th>@lang('business.keyboard_shortcut')</th>
                </tr>
                <tr>
                    <td>{!! __('sale.express_finalize') !!}:</td>
                    <td>
                        @php
                        $__f1 = ['name' => 'shortcuts[pos][express_checkout]', 'value' => !empty($shortcuts["pos"]["express_checkout"]) ? $shortcuts["pos"]["express_checkout"] : null, 'options' => ['class' => 'form-control']];
                        @endphp
                        <x-form.input type="text" :name="$__f1['name']" :value="$__f1['value']" :options="$__f1['options']" />
                    </td>
                </tr>
                <tr>
                    <td>@lang('sale.finalize'):</td>
                    <td>
                        @php
                        $__f2 = ['name' => 'shortcuts[pos][pay_n_ckeckout]', 'value' => !empty($shortcuts["pos"]["pay_n_ckeckout"]) ? $shortcuts["pos"]["pay_n_ckeckout"] : null, 'options' => ['class' => 'form-control']];
                        @endphp
                        <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
                    </td>
                </tr>
                <tr>
                    <td>@lang('sale.draft'):</td>
                    <td>
                        @php
                        $__f3 = ['name' => 'shortcuts[pos][draft]', 'value' => !empty($shortcuts["pos"]["draft"]) ? $shortcuts["pos"]["draft"] : null, 'options' => ['class' => 'form-control']];
                        @endphp
                        <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
                    </td>
                </tr>
                <tr>
                    <td>@lang('messages.cancel'):</td>
                    <td>
                        @php
                        $__f4 = ['name' => 'shortcuts[pos][cancel]', 'value' => !empty($shortcuts["pos"]["cancel"]) ? $shortcuts["pos"]["cancel"] : null, 'options' => ['class' => 'form-control']];
                        @endphp
                        <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
                    </td>
                </tr>
                <tr>
                    <td>@lang('lang_v1.recent_product_quantity'):</td>
                    <td>
                        @php
                        $__f5 = ['name' => 'shortcuts[pos][recent_product_quantity]', 'value' => !empty($shortcuts["pos"]["recent_product_quantity"]) ? $shortcuts["pos"]["recent_product_quantity"] : null, 'options' => ['class' => 'form-control']];
                        @endphp
                        <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
                    </td>
                </tr>
                <tr>
                    <td>@lang('lang_v1.weighing_scale'):</td>
                    <td>
                        @php
                        $__f6 = ['name' => 'shortcuts[pos][weighing_scale]', 'value' => !empty($shortcuts["pos"]["weighing_scale"]) ? $shortcuts["pos"]["weighing_scale"] : null, 'options' => ['class' => 'form-control']];
                        @endphp
                        <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th>@lang('business.operations')</th>
                    <th>@lang('business.keyboard_shortcut')</th>
                </tr>
                <tr>
                    <td>@lang('sale.edit_discount'):</td>
                    <td>
                        @php
                        $__f7 = ['name' => 'shortcuts[pos][edit_discount]', 'value' => !empty($shortcuts["pos"]["edit_discount"]) ? $shortcuts["pos"]["edit_discount"] : null, 'options' => ['class' => 'form-control']];
                        @endphp
                        <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                    </td>
                </tr>
                <tr>
                    <td>@lang('sale.edit_order_tax'):</td>
                    <td>
                        @php
                        $__f8 = ['name' => 'shortcuts[pos][edit_order_tax]', 'value' => !empty($shortcuts["pos"]["edit_order_tax"]) ? $shortcuts["pos"]["edit_order_tax"] : null, 'options' => ['class' => 'form-control']];
                        @endphp
                        <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
                    </td>
                </tr>
                <tr>
                    <td>@lang('sale.add_payment_row'):</td>
                    <td>
                        @php
                        $__f9 = ['name' => 'shortcuts[pos][add_payment_row]', 'value' => !empty($shortcuts["pos"]["add_payment_row"]) ? $shortcuts["pos"]["add_payment_row"] : null, 'options' => ['class' => 'form-control']];
                        @endphp
                        <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
                    </td>
                </tr>
                <tr>
                    <td>@lang('sale.finalize_payment'):</td>
                    <td>
                        @php
                        $__f10 = ['name' => 'shortcuts[pos][finalize_payment]', 'value' => !empty($shortcuts["pos"]["finalize_payment"]) ? $shortcuts["pos"]["finalize_payment"] : null, 'options' => ['class' => 'form-control']];
                        @endphp
                        <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
                    </td>
                </tr>
                <tr>
                    <td>@lang('lang_v1.add_new_product'):</td>
                    <td>
                        @php
                        $__f11 = ['name' => 'shortcuts[pos][add_new_product]', 'value' => !empty($shortcuts["pos"]["add_new_product"]) ? $shortcuts["pos"]["add_new_product"] : null, 'options' => ['class' => 'form-control']];
                        @endphp
                        <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4>@lang('lang_v1.pos_settings'):</h4>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f12 = ['name' => 'pos_settings[disable_pay_checkout]', 'value' => 1, 'checked' => $pos_settings['disable_pay_checkout'], 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f12['name']" :value="$__f12['value']" :checked="$__f12['checked']" :options="$__f12['options']" /> {{ __( 'lang_v1.disable_pay_checkout' ) }}
                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f13 = ['name' => 'pos_settings[disable_draft]', 'value' => 1, 'checked' => $pos_settings['disable_draft'], 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f13['name']" :value="$__f13['value']" :checked="$__f13['checked']" :options="$__f13['options']" /> {{ __( 'lang_v1.disable_draft' ) }}
                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f14 = ['name' => 'pos_settings[disable_express_checkout]', 'value' => 1, 'checked' => $pos_settings['disable_express_checkout'], 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f14['name']" :value="$__f14['value']" :checked="$__f14['checked']" :options="$__f14['options']" /> {{ __( 'lang_v1.disable_express_checkout' ) }}
                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f15 = ['name' => 'pos_settings[hide_product_suggestion]', 'value' => 1, 'checked' => $pos_settings['hide_product_suggestion'], 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f15['name']" :value="$__f15['value']" :checked="$__f15['checked']" :options="$__f15['options']" /> {{ __( 'lang_v1.hide_product_suggestion' ) }}
                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f16 = ['name' => 'pos_settings[hide_recent_trans]', 'value' => 1, 'checked' => $pos_settings['hide_recent_trans'], 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f16['name']" :value="$__f16['value']" :checked="$__f16['checked']" :options="$__f16['options']" /> {{ __( 'lang_v1.hide_recent_trans' ) }}
                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f17 = ['name' => 'pos_settings[disable_discount]', 'value' => 1, 'checked' => $pos_settings['disable_discount'], 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f17['name']" :value="$__f17['value']" :checked="$__f17['checked']" :options="$__f17['options']" /> {{ __( 'lang_v1.disable_discount' ) }}
                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f18 = ['name' => 'pos_settings[disable_order_tax]', 'value' => 1, 'checked' => $pos_settings['disable_order_tax'], 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f18['name']" :value="$__f18['value']" :checked="$__f18['checked']" :options="$__f18['options']" /> {{ __( 'lang_v1.disable_order_tax' ) }}
                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f19 = ['name' => 'pos_settings[is_pos_subtotal_editable]', 'value' => 1, 'checked' => empty($pos_settings['is_pos_subtotal_editable']) ? 0 : 1, 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f19['name']" :value="$__f19['value']" :checked="$__f19['checked']" :options="$__f19['options']" /> {{ __( 'lang_v1.subtotal_editable' ) }}
                  </label>
                  @show_tooltip(__('lang_v1.subtotal_editable_help_text'))
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f20 = ['name' => 'pos_settings[disable_suspend]', 'value' => 1, 'checked' => empty($pos_settings['disable_suspend']) ? 0 : 1, 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f20['name']" :value="$__f20['value']" :checked="$__f20['checked']" :options="$__f20['options']" /> {{ __( 'lang_v1.disable_suspend_sale' ) }}
                  </label>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f21 = ['name' => 'pos_settings[enable_transaction_date]', 'value' => 1, 'checked' => empty($pos_settings['enable_transaction_date']) ? 0 : 1, 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f21['name']" :value="$__f21['value']" :checked="$__f21['checked']" :options="$__f21['options']" /> {{ __( 'lang_v1.enable_pos_transaction_date' ) }}
                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f22 = ['name' => 'pos_settings[inline_service_staff]', 'value' => 1, 'checked' => !empty($pos_settings['inline_service_staff']) ? true : false, 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f22['name']" :value="$__f22['value']" :checked="$__f22['checked']" :options="$__f22['options']" /> {{ __( 'lang_v1.enable_service_staff_in_product_line' ) }}
                  </label>
                  @show_tooltip(__('lang_v1.inline_service_staff_tooltip'))
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f23 = ['name' => 'pos_settings[is_service_staff_required]', 'value' => 1, 'checked' => empty($pos_settings['is_service_staff_required']) ? 0 : 1, 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f23['name']" :value="$__f23['value']" :checked="$__f23['checked']" :options="$__f23['options']" /> {{ __( 'lang_v1.is_service_staff_required' ) }}
                  </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f24 = ['name' => 'pos_settings[show_credit_sale_button]', 'value' => 1, 'checked' => empty($pos_settings['show_credit_sale_button']) ? 0 : 1, 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f24['name']" :value="$__f24['value']" :checked="$__f24['checked']" :options="$__f24['options']" /> {{ __( 'lang_v1.show_credit_sale_button' ) }}
                  </label>
                  @show_tooltip(__('lang_v1.show_credit_sale_btn_help'))
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f25 = ['name' => 'pos_settings[enable_weighing_scale]', 'value' => 1, 'checked' => empty($pos_settings['enable_weighing_scale']) ? 0 : 1, 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f25['name']" :value="$__f25['value']" :checked="$__f25['checked']" :options="$__f25['options']" /> {{ __( 'lang_v1.enable_weighing_scale' ) }}
                  </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f26 = ['name' => 'pos_settings[show_invoice_layout]', 'value' => 1, 'checked' => !empty($pos_settings['show_invoice_layout']), 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f26['name']" :value="$__f26['value']" :checked="$__f26['checked']" :options="$__f26['options']" /> {{ __( 'lang_v1.show_invoice_layout' ) }}
                  </label>
                </div>
            </div>
        </div>

    </div>

    <hr>
    @include('business.partials.settings_weighing_scale')
</div>