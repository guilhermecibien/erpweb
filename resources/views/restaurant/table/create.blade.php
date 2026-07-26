<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('Restaurant\TableController@store'), 'method' => 'post', 'id' => 'table_add_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Adicionar Mesa</h4>
    </div>

    <div class="modal-body">

      @if(count($business_locations) == 1)
        @php 
            $default_location = current(array_keys($business_locations->toArray())) 
        @endphp
      @else
        @php $default_location = null; @endphp
      @endif
      <div class="form-group">
        @php
        $__f2 = ['name' => 'location_id', 'value' => __('purchase.business_location').':*'];
        @endphp
        <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
        @php
        $__f3 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => $default_location, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
        @endphp
        <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
      </div>
      
      <div class="form-group">
        @php
        $__f4 = ['name' => 'name', 'value' => 'Nome da mesa' . ':*'];
        @endphp
        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'name', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'Nome da mesa' ) ]];
          @endphp
          <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
      </div>

      <div class="form-group">
        @php
        $__f6 = ['name' => 'description', 'value' => 'Descrição breve' . ':'];
        @endphp
        <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
          @php
          $__f7 = ['name' => 'description', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __( 'Descrição breve' )]];
          @endphp
          <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->