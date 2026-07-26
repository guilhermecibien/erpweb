<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('SalesCommissionAgentController@store'), 'method' => 'post', 'id' => 'sale_commission_agent_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'lang_v1.add_sales_commission_agent' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="col-md-2">
        <div class="form-group">
          @php
          $__f2 = ['name' => 'surname', 'value' => __( 'business.prefix' ) . ':'];
          @endphp
          <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            @php
            $__f3 = ['name' => 'surname', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]];
            @endphp
            <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group">
          @php
          $__f4 = ['name' => 'first_name', 'value' => __( 'business.first_name' ) . ':*'];
          @endphp
          <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            @php
            $__f5 = ['name' => 'first_name', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]];
            @endphp
            <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group">
          @php
          $__f6 = ['name' => 'last_name', 'value' => 'Sobre nome' . ':'];
          @endphp
          <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            @php
            $__f7 = ['name' => 'last_name', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Sobre nome' ]];
            @endphp
            <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-6">
        <div class="form-group">
          @php
          $__f8 = ['name' => 'email', 'value' => __( 'business.email' ) . ':'];
          @endphp
          <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            @php
            $__f9 = ['name' => 'email', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.email' ) ]];
            @endphp
            <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          @php
          $__f10 = ['name' => 'contact_no', 'value' => __( 'lang_v1.contact_no' ) . ':'];
          @endphp
          <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
            @php
            $__f11 = ['name' => 'contact_no', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.contact_no' ) ]];
            @endphp
            <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          @php
          $__f12 = ['name' => 'address', 'value' => __( 'business.address' ) . ':'];
          @endphp
          <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
            @php
            $__f13 = ['name' => 'address', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.address'), 'rows' => 3 ]];
            @endphp
            <x-form.textarea :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          @php
          $__f14 = ['name' => 'cmmsn_percent', 'value' => __( 'lang_v1.cmmsn_percent' ) . ':'];
          @endphp
          <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
            @php
            $__f15 = ['name' => 'cmmsn_percent', 'value' => null, 'options' => ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.cmmsn_percent' ), 'required' ]];
            @endphp
            <x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
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