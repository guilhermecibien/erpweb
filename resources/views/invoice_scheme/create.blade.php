<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('InvoiceSchemeController@store'), 'method' => 'post', 'id' => 'invoice_scheme_add_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'invoice.add_invoice' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="option-div-group">
          <div class="col-sm-4">
            <div class="form-group">
              <div class="option-div">
                <h4>FORMAT: <br>XXXX <i class="fa fa-check-circle pull-right icon"></i></h4>
                @php
                $__f2 = ['name' => 'scheme_type', 'value' => 'blank'];
                @endphp
                <x-form.radio :name="$__f2['name']" :value="$__f2['value']" />
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <div class="option-div">
                <h4>FORMAT: <br>{{ date('Y') }}-XXXX <i class="fa fa-check-circle pull-right icon"></i></h4>
                @php
                $__f3 = ['name' => 'scheme_type', 'value' => 'year'];
                @endphp
                <x-form.radio :name="$__f3['name']" :value="$__f3['value']" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>@lang('invoice.preview'):</label>
            <div id="preview_format">@lang('invoice.not_selected')</div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f4 = ['name' => 'name', 'value' => __( 'invoice.name' ) . ':*'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
              @php
              $__f5 = ['name' => 'name', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'invoice.name' ) ]];
              @endphp
              <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
          </div>
        </div>
        <div id="invoice_format_settings" class="hide">
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f6 = ['name' => 'prefix', 'value' => __( 'invoice.prefix' ) . ':'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-addon">
                  <i class="fa fa-info"></i>
              </span>
                @php
                $__f7 = ['name' => 'prefix', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => '']];
                @endphp
                <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f8 = ['name' => 'start_number', 'value' => __( 'invoice.start_number' ) . ':'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-addon">
                  <i class="fa fa-info"></i>
              </span>
                @php
                $__f9 = ['name' => 'start_number', 'value' => 0, 'options' => ['class' => 'form-control', 'required', 'min' => 0 ]];
                @endphp
                <x-form.input type="number" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
            </div>
          </div>
        </div>
        <div class="clearfix">
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f10 = ['name' => 'total_digits', 'value' => __( 'invoice.total_digits' ) . ':'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-addon">
                  <i class="fa fa-info"></i>
              </span>
              @php
              $__f11 = ['name' => 'total_digits', 'list' => ['4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9'=>'9', '10' => '10'], 'selected' => 4, 'options' => ['class' => 'form-control', 'required']];
              @endphp
              <x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <br>
            <div class="checkbox">
              <label>
                @php
                $__f12 = ['name' => 'is_default', 'value' => 1];
                @endphp
                <x-form.checkbox :name="$__f12['name']" :value="$__f12['value']" /> @lang('barcode.set_as_default')</label>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->