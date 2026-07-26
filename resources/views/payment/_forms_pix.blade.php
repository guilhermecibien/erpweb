@php
$__f1 = ['options' => ['url' => action('PaymentController@paymentPix'), 'method' => 'post', 'id' => 'form_pix' ]];
@endphp
<x-form.open :options="$__f1['options']" />

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            @php
            $__f2 = ['name' => 'plano_id', 'value' => 'Plano'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            @php
            $__f3 = ['name' => 'plano_id', 'list' => ['' => 'Selecione o plano'] + $planos->pluck('info', 'id')->all(), 'selected' => '', 'options' => ['class' => 'form-control', 'id' => 'plano_id', 'required']];
            @endphp
            <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            @php
            $__f4 = ['name' => 'payerFirstName', 'value' => 'Nome'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            @php
            $__f5 = ['name' => 'payerFirstName', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Nome', 'required' ]];
            @endphp
            <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            @php
            $__f6 = ['name' => 'payerLastName', 'value' => 'Sobre Nome'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            @php
            $__f7 = ['name' => 'payerLastName', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Sobre Nome', 'required' ]];
            @endphp
            <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            @php
            $__f8 = ['name' => 'payerEmail', 'value' => 'Email'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            @php
            $__f9 = ['name' => 'payerEmail', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Email', 'required' ]];
            @endphp
            <x-form.input type="email" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            @php
            $__f10 = ['name' => 'docType', 'value' => 'Tipo do documento'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
            @php
            $__f11 = ['name' => 'docType', 'list' => [], 'selected' => '', 'options' => ['class' => 'form-control', 'id' => 'docType', 'required', 'data-checkout' => 'docType']];
            @endphp
            <x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            @php
            $__f12 = ['name' => 'docNumber', 'value' => 'Número do documento'];
            @endphp
            <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
            @php
            $__f13 = ['name' => 'docNumber', 'value' => null, 'options' => ['class' => 'form-control cpf_cnpj', 'placeholder' => 'Número do documento', 'required' ]];
            @endphp
            <x-form.input type="tel" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-success pull-right" id="submit_button_pix">Pagar com PIX</button>
  </div>
</div>   
<x-form.close />

