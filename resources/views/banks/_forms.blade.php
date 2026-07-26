<div class="col-md-4">
  <div class="form-group">
    @php
    $__f1 = ['name' => 'banco', 'value' => 'Banco' . ':*'];
    @endphp
    <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
    @php
    $__f2 = ['name' => 'banco', 'list' => App\Models\Bank::bancos(), 'selected' => isset($item) ? $item->banco : '', 'options' => ['id' => 'banco', 'class' => 'form-control select2', 'required']];
    @endphp
    <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">
    @php
    $__f3 = ['name' => 'agencia', 'value' => 'Agencia' . '*:'];
    @endphp
    <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
    @php
    $__f4 = ['name' => 'agencia', 'value' => isset($item) ? $item->agencia : '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Agencia', 'data-mask="00000000"' ]];
    @endphp
    <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">
    @php
    $__f5 = ['name' => 'conta', 'value' => 'Conta' . '*:'];
    @endphp
    <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
    @php
    $__f6 = ['name' => 'conta', 'value' => isset($item) ? $item->conta : '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Conta', 'data-mask="00000000"' ]];
    @endphp
    <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
  </div>
</div>

<div class="col-md-4">
  <div class="form-group">
    @php
    $__f7 = ['name' => 'titular', 'value' => 'Titular' . '*:'];
    @endphp
    <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
    @php
    $__f8 = ['name' => 'titular', 'value' => isset($item) ? $item->titular : '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Titular' ]];
    @endphp
    <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
  </div>
</div>

<div class="col-md-3">
  <div class="form-group">
    @php
    $__f9 = ['name' => 'cnpj', 'value' => 'CPF/CNPJ' . '*:'];
    @endphp
    <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
    @php
    $__f10 = ['name' => 'cnpj', 'value' => isset($item) ? $item->cnpj : '', 'options' => ['class' => 'form-control cpf_cnpj', 'required', 'placeholder' => 'CPF/CNPJ' ]];
    @endphp
    <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
  </div>
</div>

<div class="col-md-5">
  <div class="form-group">
    @php
    $__f11 = ['name' => 'endereco', 'value' => 'Endereço' . '*:'];
    @endphp
    <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
    @php
    $__f12 = ['name' => 'endereco', 'value' => isset($item) ? $item->endereco : '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Endereço' ]];
    @endphp
    <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">
    @php
    $__f13 = ['name' => 'cep', 'value' => 'CEP' . '*:'];
    @endphp
    <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
    @php
    $__f14 = ['name' => 'cep', 'value' => isset($item) ? $item->cep : '', 'options' => ['class' => 'form-control cep', 'required', 'placeholder' => 'CEP' ]];
    @endphp
    <x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">
    @php
    $__f15 = ['name' => 'bairro', 'value' => 'Bairro' . '*:'];
    @endphp
    <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
    @php
    $__f16 = ['name' => 'bairro', 'value' => isset($item) ? $item->bairro : '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Bairro' ]];
    @endphp
    <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
  </div>
</div>

<div class="col-md-5">
  <div class="form-group">
    @php
    $__f17 = ['name' => 'cidade_id', 'value' => 'Cidade:*'];
    @endphp
    <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
    @php
    $__f18 = ['name' => 'cidade_id', 'list' => ['' => 'Selecione a cidade'] + $cities, 'selected' => isset($item) ? $item->cidade_id : '', 'options' => ['id' => 'cidade', 'class' => 'form-control select2 featured-field', 'required']];
    @endphp
    <x-form.select :name="$__f18['name']" :list="$__f18['list']" :selected="$__f18['selected']" :options="$__f18['options']" />
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">

    @php
    $__f19 = ['name' => 'padrao', 'value' => 'Padrão' . ':'];
    @endphp
    <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
    @php
    $__f20 = ['name' => 'padrao', 'list' => ['0' => 'Não', '1' => 'Sim'], 'selected' => isset($item) ? $item->padrao : '', 'options' => ['id' => 'padrao', 'class' => 'form-control', 'required']];
    @endphp
    <x-form.select :name="$__f20['name']" :list="$__f20['list']" :selected="$__f20['selected']" :options="$__f20['options']" />
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">
    @php
    $__f21 = ['name' => 'carteira', 'value' => 'Carteira' . '*:'];
    @endphp
    <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
    @php
    $__f22 = ['name' => 'carteira', 'value' => isset($item) ? $item->carteira : '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Carteira' ]];
    @endphp
    <x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">
    @php
    $__f23 = ['name' => 'convenio', 'value' => 'Convênio' . '*:'];
    @endphp
    <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
    @php
    $__f24 = ['name' => 'convenio', 'value' => isset($item) ? $item->convenio : '', 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Convênio' ]];
    @endphp
    <x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">
    @php
    $__f25 = ['name' => 'juros', 'value' => 'Juros' . '*:'];
    @endphp
    <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
    @php
    $__f26 = ['name' => 'juros', 'value' => isset($item) ? $item->juros : '', 'options' => ['class' => 'form-control money', 'required', 'placeholder' => 'Juros' ]];
    @endphp
    <x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">
    @php
    $__f27 = ['name' => 'multa', 'value' => 'Multa' . '*:'];
    @endphp
    <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
    @php
    $__f28 = ['name' => 'multa', 'value' => isset($item) ? $item->multa : '', 'options' => ['class' => 'form-control money', 'required', 'placeholder' => 'Multa' ]];
    @endphp
    <x-form.input type="text" :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">
    @php
    $__f29 = ['name' => 'juros_apos', 'value' => 'Juros após (dias)' . '*:'];
    @endphp
    <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
    @php
    $__f30 = ['name' => 'juros_apos', 'value' => isset($item) ? $item->juros_apos : '', 'options' => ['class' => 'form-control money', 'required', 'placeholder' => 'Juros após (dias)' ]];
    @endphp
    <x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
  </div>
</div>

<div class="col-md-2">
  <div class="form-group">

    @php
    $__f31 = ['name' => 'tipo', 'value' => 'Tipo' . ':'];
    @endphp
    <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
    @php
    $__f32 = ['name' => 'tipo', 'list' => ['Cnab400' => 'Cnab400', 'Cnab240' => 'Cnab240'], 'selected' => isset($item) ? $item->tipo : '', 'options' => ['id' => 'tipo', 'class' => 'form-control', 'required']];
    @endphp
    <x-form.select :name="$__f32['name']" :list="$__f32['list']" :selected="$__f32['selected']" :options="$__f32['options']" />
  </div>
</div>

