<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('TaxonomyController@update', [$category->id]), 'method' => 'PUT', 'id' => 'category_edit_form', 'files' => true ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'messages.edit' )</h4>
    </div>

    <div class="modal-body">
      @php
      $name_label = !empty($module_category_data['taxonomy_label']) ? $module_category_data['taxonomy_label'] : __( 'category.category_name' );
      $cat_code_enabled = isset($module_category_data['enable_taxonomy_code']) && !$module_category_data['enable_taxonomy_code'] ? false : true;

      $cat_code_label = !empty($module_category_data['taxonomy_code_label']) ? $module_category_data['taxonomy_code_label'] : __( 'category.code' );

      $enable_sub_category = isset($module_category_data['enable_sub_taxonomy']) && !$module_category_data['enable_sub_taxonomy'] ? false : true;

      $category_code_help_text = !empty($module_category_data['taxonomy_code_help_text']) ? $module_category_data['taxonomy_code_help_text'] : __('lang_v1.category_code_help');
      @endphp
      <div class="form-group">
        @php
        $__f2 = ['name' => 'name', 'value' => $name_label . ':*'];
        @endphp
        <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
        @php
        $__f3 = ['name' => 'name', 'value' => $category->name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => $name_label]];
        @endphp
        <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
      </div>
      @if($cat_code_enabled)
      <div class="form-group">
        @php
        $__f4 = ['name' => 'short_code', 'value' => $cat_code_label . ':'];
        @endphp
        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
        @php
        $__f5 = ['name' => 'short_code', 'value' => $category->short_code, 'options' => ['class' => 'form-control', 'placeholder' => $cat_code_label]];
        @endphp
        <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
        <!-- <p class="help-block">{!! $category_code_help_text !!}</p> -->
      </div>
      @endif
      <div class="form-group">
        @php
        $__f6 = ['name' => 'description', 'value' => __( 'lang_v1.description' ) . ':'];
        @endphp
        <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
        @php
        $__f7 = ['name' => 'description', 'value' => $category->description, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.description'), 'rows' => 3]];
        @endphp
        <x-form.textarea :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
      </div>

      <div class="form-group img">
        @php
        $__f8 = ['name' => 'image', 'value' => 'Imagem' . ':'];
        @endphp
        <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
        @php
        $__f9 = ['name' => 'image', 'options' => ['id' => 'upload_image', 'accept' => 'image/*']];
        @endphp
        <x-form.input type="file" :name="$__f9['name']" :options="$__f9['options']" />
        <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]) <br> @lang('lang_v1.aspect_ratio_should_be_1_1')</p></small>
      </div>

      @if (in_array('ecommerce', $enabled_modules) && auth()->user()->can('ecommerce.view'))
      <div class="form-group">
        @php
        $__f10 = ['name' => 'ecommerce', 'value' => 'Ecommerce' . ':'];
        @endphp
        <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
        @php
        $__f11 = ['name' => 'ecommerce', 'value' => 1, 'checked' => $category->ecommerce, 'options' => ['class' => 'input-icheck']];
        @endphp
        <x-form.checkbox :name="$__f11['name']" :value="$__f11['value']" :checked="$__f11['checked']" :options="$__f11['options']" />
      </div>

      <div class="form-group">
        @php
        $__f12 = ['name' => 'destaque', 'value' => 'Destaque ecommerce' . ':'];
        @endphp
        <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
        @php
        $__f13 = ['name' => 'destaque', 'value' => 1, 'checked' => $category->destaque, 'options' => ['class' => 'input-icheck']];
        @endphp
        <x-form.checkbox :name="$__f13['name']" :value="$__f13['value']" :checked="$__f13['checked']" :options="$__f13['options']" />
      </div>
      @endif

      @if(!empty($parent_categories) && $enable_sub_category)
          <div class="form-group">
            <div class="checkbox">
              <label>
                 @php
                 $__f14 = ['name' => 'add_as_sub_cat', 'value' => 1, 'checked' => !$is_parent, 'options' => [ 'class' => 'toggler', 'data-toggle_id' => 'parent_cat_div' ]];
                 @endphp
                 <x-form.checkbox :name="$__f14['name']" :value="$__f14['value']" :checked="$__f14['checked']" :options="$__f14['options']" /> @lang( 'lang_v1.add_as_sub_txonomy' )
              </label>
            </div>
          </div>
          <div class="form-group @if($is_parent) {{'hide' }} @endif" id="parent_cat_div">
            @php
            $__f15 = ['name' => 'parent_id', 'value' => 'Categoria:'];
            @endphp
            <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
            @php
            $__f16 = ['name' => 'parent_id', 'list' => $parent_categories, 'selected' => $selected_parent, 'options' => ['class' => 'form-control']];
            @endphp
            <x-form.select :name="$__f16['name']" :list="$__f16['list']" :selected="$__f16['selected']" :options="$__f16['options']" />
          </div>
          @endif
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
        </div>

        <x-form.close />

      </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->