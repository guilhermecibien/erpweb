<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('Restaurant\ModifierSetsController@update', [$modifer_set->id]), 'method' => 'PUT', 'id' => 'edit_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'restaurant.edit_modifier' )</h4>
    </div>

    <div class="modal-body">

      <div class="row">
        
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f2 = ['name' => 'name', 'value' => __( 'restaurant.modifier_set' ) . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            @php
            $__f3 = ['name' => 'name', 'value' => $modifer_set->name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'messages.name' ) ]];
            @endphp
            <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          </div>
        </div>

        <div class="col-sm-12">
          <h4>@lang( 'restaurant.modifiers' )</h4>
        </div>

        <div class="col-sm-12">
          <table class="table table-condensed" id="add-modifier-table">
            <thead>
              <tr>
                <th>@lang( 'restaurant.modifier')</th>
                <th>
                  @lang( 'messages.price')

                  @php
                    $html = '<tr><td>
                          <div class="form-group">
                            <input type="text" name="modifier_name[]" 
                            class="form-control" 
                            placeholder="' . __( 'messages.name' ) . '" required>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input type="text" name="modifier_price[]" class="form-control input_number" 
                            placeholder="' . __( 'messages.price' ) . '" required>
                          </div>
                        </td>
                        <td>
                          <button class="btn btn-danger btn-xs pull-right remove-modifier-row" type="button"><i class="fa fa-minus"></i></button>
                        </td>
                        </tr>';
                  @endphp
                </th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              @foreach($modifer_set->variations as $modifier)
                <tr>
                  <td>
                    <div class="form-group">
                      <input type="text" name="modifier_name_edit[{{$modifier->id}}]" 
                        class="form-control" value="{{$modifier->name}}" placeholder="@lang( 'messages.name' )" required>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" name="modifier_price_edit[{{$modifier->id}}]" 
                      class="form-control input_number" value="{{@num_format($modifier->sell_price_inc_tax)}}" placeholder="@lang( 'messages.price' )" required>
                    </div>
                  </td>
                  <td>
                    @if(!$loop->first)
                      <button class="btn btn-danger btn-xs pull-right remove-modifier-row" type="button"><i class="fa fa-minus"></i></button>
                    @else
                      <button class="btn btn-primary btn-xs pull-right add-modifier-row" type="button" data-html="{{ $html }}">
                        <i class="fa fa-plus"></i>
                      </button>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->