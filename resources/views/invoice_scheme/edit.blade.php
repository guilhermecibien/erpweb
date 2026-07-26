<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('InvoiceSchemeController@update', [$invoice->id]), 'method' => 'put', 'id' => 'invoice_scheme_add_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'invoice.edit_invoice' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="option-div-group">
          <div class="col-sm-4">
            <div class="form-group">
              <div class="option-div @if($invoice->scheme_type == 'blank') {{ 'active'}} @endif">
                <h4>FORMAT: <br>XXXX <i class="fa fa-check-circle pull-right icon"></i></h4>
                <input type="radio" name="scheme_type" value="blank" @if($invoice->scheme_type == 'blank') {{ 'checked'}} @endif>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <div class="option-div  @if($invoice->scheme_type == 'year') {{ 'active'}} @endif">
                <h4>FORMAT: <br>{{ date('Y') }}-XXXX <i class="fa fa-check-circle pull-right icon"></i></h4>
                <input type="radio" name="scheme_type" value="year" @if($invoice->scheme_type == 'year') {{ 'checked'}} @endif>
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
            $__f2 = ['name' => 'name', 'value' => __( 'invoice.name' ) . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
              @php
              $__f3 = ['name' => 'name', 'value' => $invoice->name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'invoice.name' ) ]];
              @endphp
              <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          </div>
        </div>
        <div id="invoice_format_settings">
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f4 = ['name' => 'prefix', 'value' => __( 'invoice.prefix' ) . ':'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-addon">
                  <i class="fa fa-info"></i>
              </span>
                @php
                  $disabled = '';
                  $prefix = $invoice->prefix;
                  if( $invoice->scheme_type == 'year'){
                    $prefix = date('Y') . '-';
                    $disabled = 'disabled';
                  }
                @endphp
                @php
                $__f5 = ['name' => 'prefix', 'value' => $prefix, 'options' => ['class' => 'form-control', 'placeholder' => '', $disabled]];
                @endphp
                <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f6 = ['name' => 'start_number', 'value' => __( 'invoice.start_number' ) . ':'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-addon">
                  <i class="fa fa-info"></i>
              </span>
                @php
                $__f7 = ['name' => 'start_number', 'value' => $invoice->start_number, 'options' => ['class' => 'form-control', 'required', 'min' => 0 ]];
                @endphp
                <x-form.input type="number" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
            </div>
          </div>
        </div>
        <div class="clearfix">
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f8 = ['name' => 'total_digits', 'value' => __( 'invoice.total_digits' ) . ':'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-addon">
                  <i class="fa fa-info"></i>
              </span>
              @php
              $__f9 = ['name' => 'total_digits', 'list' => ['4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9'=>'9', '10' => '10'], 'selected' => $invoice->total_digits, 'options' => ['class' => 'form-control', 'required']];
              @endphp
              <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
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