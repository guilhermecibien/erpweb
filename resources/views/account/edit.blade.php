<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('AccountController@update',$account->id), 'method' => 'PUT', 'id' => 'edit_payment_account_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'account.edit_account' )</h4>
    </div>

    <div class="modal-body">
            <div class="form-group">
                @php
                $__f2 = ['name' => 'name', 'value' => __( 'lang_v1.name' ) .":*"];
                @endphp
                <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
                @php
                $__f3 = ['name' => 'name', 'value' => $account->name, 'options' => ['class' => 'form-control', 'required','placeholder' => __( 'lang_v1.name' ) ]];
                @endphp
                <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
            </div>

             <div class="form-group">
                @php
                $__f4 = ['name' => 'account_number', 'value' => __( 'account.account_number' ) .":*"];
                @endphp
                <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
                @php
                $__f5 = ['name' => 'account_number', 'value' => $account->account_number, 'options' => ['class' => 'form-control', 'required','placeholder' => __( 'account.account_number' ) ]];
                @endphp
                <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
            </div>

            <div class="form-group">
                @php
                $__f6 = ['name' => 'account_type_id', 'value' => __( 'account.account_type' ) .":"];
                @endphp
                <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
                <select name="account_type_id" class="form-control select2">
                    <option>@lang('messages.please_select')</option>
                    @foreach($account_types as $account_type)
                        <optgroup label="{{$account_type->name}}">
                            <option value="{{$account_type->id}}" @if($account->account_type_id == $account_type->id) selected @endif >{{$account_type->name}}</option>
                            @foreach($account_type->sub_types as $sub_type)
                                <option value="{{$sub_type->id}}" @if($account->account_type_id == $sub_type->id) selected @endif >{{$sub_type->name}}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                @php
                $__f7 = ['name' => 'note', 'value' => __( 'brand.note' )];
                @endphp
                <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
                @php
                $__f8 = ['name' => 'note', 'value' => $account->note, 'options' => ['class' => 'form-control', 'placeholder' => __( 'brand.note' ), 'rows' => 4]];
                @endphp
                <x-form.textarea :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
            </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->