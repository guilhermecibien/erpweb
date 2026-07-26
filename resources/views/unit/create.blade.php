<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('UnitController@store'), 'method' => 'post', 'id' => $quick_add ? 'quick_add_unit_form' : 'unit_add_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'unit.add_unit' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="form-group col-sm-12">
          @php
          $__f2 = ['name' => 'actual_name', 'value' => __( 'unit.name' ) . ':*'];
          @endphp
          <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            @php
            $__f3 = ['name' => 'actual_name', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'unit.name' )]];
            @endphp
            <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
        </div>

        <div class="form-group col-sm-12">
          @php
          $__f4 = ['name' => 'short_name', 'value' => __( 'unit.short_name' ) . ':*'];
          @endphp
          <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            @php
            $__f5 = ['name' => 'short_name', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'unit.short_name' ), 'required']];
            @endphp
            <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
        </div>

        <div class="form-group col-sm-12">
          @php
          $__f6 = ['name' => 'allow_decimal', 'value' => __( 'unit.allow_decimal' ) . ':*'];
          @endphp
          <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            @php
            $__f7 = ['name' => 'allow_decimal', 'list' => ['1' => __('messages.yes'), '0' => __('messages.no')], 'selected' => null, 'options' => ['placeholder' => __( 'messages.please_select' ), 'required', 'class' => 'form-control']];
            @endphp
            <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
        </div>
        @if(!$quick_add)
          <div class="form-group col-sm-12">
            <div class="form-group">
                <div class="checkbox">
                  <label>
                     @php
                     $__f8 = ['name' => 'define_base_unit', 'value' => 1, 'checked' => false, 'options' => [ 'class' => 'toggler', 'data-toggle_id' => 'base_unit_div' ]];
                     @endphp
                     <x-form.checkbox :name="$__f8['name']" :value="$__f8['value']" :checked="$__f8['checked']" :options="$__f8['options']" /> @lang( 'lang_v1.add_as_multiple_of_base_unit' )
                  </label> @show_tooltip(__('lang_v1.multi_unit_help'))
                </div>
            </div>
          </div>
          <div class="form-group col-sm-12 hide" id="base_unit_div">
            <table class="table">
              <tr>
                <th style="vertical-align: middle;">1 <span id="unit_name">@lang('product.unit')</span></th>
                <th style="vertical-align: middle;">=</th>
                <td style="vertical-align: middle;">
                  @php
                  $__f9 = ['name' => 'base_unit_multiplier', 'value' => null, 'options' => ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.times_base_unit' )]];
                  @endphp
                  <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" /></td>
                <td style="vertical-align: middle;">
                  @php
                  $__f10 = ['name' => 'base_unit_id', 'list' => $units, 'selected' => null, 'options' => ['placeholder' => __( 'lang_v1.select_base_unit' ), 'class' => 'form-control']];
                  @endphp
                  <x-form.select :name="$__f10['name']" :list="$__f10['list']" :selected="$__f10['selected']" :options="$__f10['options']" />
                </td>
              </tr>
            </table>
          </div>
        @endif
      </div>

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->