@php
$__f1 = ['options' => ['url' => action('PaymentController@paymentCartao'), 'method' => 'post', 'id' => 'form_cartao' ]];
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
            $__f3 = ['name' => 'plano_id', 'list' => ['' => 'Selecione o plano'] + $planos->pluck('info', 'id')->all(), 'selected' => '', 'options' => ['class' => 'form-control', 'id' => 'plano_cartao_id', 'required']];
            @endphp
            <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            @php
            $__f4 = ['name' => 'cardholderName', 'value' => 'Titular do cartão'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            @php
            $__f5 = ['name' => 'cardholderName', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Nome', 'required', 'data-checkout' => 'cardholderName' ]];
            @endphp
            <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            @php
            $__f6 = ['name' => 'docType', 'value' => 'Tipo do documento'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            @php
            $__f7 = ['name' => 'docType', 'list' => [], 'selected' => '', 'options' => ['class' => 'form-control', 'id' => 'docType3', 'required', 'data-checkout' => 'docType']];
            @endphp
            <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            @php
            $__f8 = ['name' => 'docNumber', 'value' => 'Número do documento'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            @php
            $__f9 = ['name' => 'docNumber', 'value' => null, 'options' => ['class' => 'form-control cpf_cnpj', 'placeholder' => 'Número do documento', 'required', 'data-checkout' => 'docNumber', 'id' => 'docNumberCartao']];
            @endphp
            <x-form.input type="tel" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            @php
            $__f10 = ['name' => 'payerEmail', 'value' => 'Email'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
            @php
            $__f11 = ['name' => 'payerEmail', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Email', 'required', 'data-checkout' => 'payerEmail']];
            @endphp
            <x-form.input type="email" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
        </div>
    </div>

    <div class="col-md-4">
        <div class="col-md-10">
            <div class="form-group">
                @php
                $__f12 = ['name' => 'cardNumber', 'value' => 'Número do cartão'];
                @endphp
                <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
                @php
                $__f13 = ['name' => 'cardNumber', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Número do cartão', 'required', 'data-checkout' => 'cardNumber', 'data-mask' => '0000 0000 0000 0000']];
                @endphp
                <x-form.input type="tel" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
            </div>
        </div>
        <div class="col-md-2 card-band">
            <img id="band-img" style="width: 20px; margin-top: 30px;" src="">
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            @php
            $__f14 = ['name' => 'installments', 'value' => 'Parcelas'];
            @endphp
            <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
            @php
            $__f15 = ['name' => 'installments', 'list' => [], 'selected' => '', 'options' => ['class' => 'form-control', 'required']];
            @endphp
            <x-form.select :name="$__f15['name']" :list="$__f15['list']" :selected="$__f15['selected']" :options="$__f15['options']" />
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="col-md-2">
        <div class="form-group">
            @php
            $__f16 = ['name' => 'cardExpirationMonth', 'value' => 'Venc. Mês'];
            @endphp
            <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
            @php
            $__f17 = ['name' => 'cardExpirationMonth', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Venc. Mês', 'required', 'data-checkout' => 'cardExpirationMonth', 'data-mask' => '00']];
            @endphp
            <x-form.input type="tel" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            @php
            $__f18 = ['name' => 'cardExpirationYear', 'value' => 'Venc. Ano'];
            @endphp
            <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
            @php
            $__f19 = ['name' => 'cardExpirationYear', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Venc. Ano', 'required', 'data-checkout' => 'cardExpirationYear', 'data-mask' => '00']];
            @endphp
            <x-form.input type="tel" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            @php
            $__f20 = ['name' => 'securityCode', 'value' => 'Código de segurança'];
            @endphp
            <x-form.label :name="$__f20['name']" :value="$__f20['value']" />
            @php
            $__f21 = ['name' => 'securityCode', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Código de segurança', 'required', 'data-checkout' => 'securityCode', 'data-mask' => 'AAAA']];
            @endphp
            <x-form.input type="tel" :name="$__f21['name']" :value="$__f21['value']" :options="$__f21['options']" />
        </div>
    </div>

    <input style="visibility: hidden" name="paymentMethodId" id="paymentMethodId" />
    <input style="visibility: hidden;" type="" name="transactionAmount" id="transactionAmount" value="" />

    <select style="visibility: hidden"  class="custom-select" id="issuer" name="issuer" data-checkout="issuer">
    </select>

</div>
<div class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-success pull-right" id="submit_button_cartao">
        <i style="display: none" class="fa fa-spinner fa-spin"></i> Pagar com Cartão de Crédito</button>
  </div>
</div>  
<x-form.close />
