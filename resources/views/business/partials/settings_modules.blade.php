<div class="pos-tab-content">
	<div class="row">
    @if(!empty($modules))
    <h4>@lang('lang_v1.enable_disable_modules')</h4>
    @foreach($modules as $k => $v)
    @if(!in_array($v['name'], $not_in_package))
    <div class="col-sm-4">
      <div class="form-group">
        <div class="checkbox">
          <br>
          <label>
            @php
            $__f1 = ['name' => 'enabled_modules[]', 'value' => $k, 'checked' => in_array($k, $enabled_modules), 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f1['name']" :value="$__f1['value']" :checked="$__f1['checked']" :options="$__f1['options']" /> {{$v['name']}}
          </label>
          @if(!empty($v['tooltip'])) @show_tooltip($v['tooltip']) @endif
        </div>
      </div>
    </div>
    @endif

    @endforeach
    @endif
  </div>
  <div class="row">

    <h4>Módulos não inclusos neste plano</h4>
    @foreach($not_in_package as $k => $v)
    <div class="col-sm-4">
      <div class="form-group">
        <div class="">
          <br>
          <label>
            {{$v}}
          </label>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>