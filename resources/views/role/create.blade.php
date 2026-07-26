@extends('layouts.app')
@section('title', 'Adicionar Controle de acesso')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Adicionar Controle de acesso</h1>
</section>

<!-- Main content -->
<section class="content">
  @component('components.widget', ['class' => 'box-primary'])
  @php
  $__f1 = ['options' => ['url' => action('RoleController@store'), 'method' => 'post', 'id' => 'role_add_form' ]];
  @endphp
  <x-form.open :options="$__f1['options']" />
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        @php
        $__f2 = ['name' => 'name', 'value' => 'Nome:*'];
        @endphp
        <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
        @php
        $__f3 = ['name' => 'name', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'user.role_name' ) ]];
        @endphp
        <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
      </div>
    </div>
  </div>
  @if(in_array('service_staff', $enabled_modules))
  <div class="row">
    <div class="col-md-2">
      <h4>Tipo de usuário</h4>
    </div>
    <div class="col-md-9 col-md-offset-1">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f4 = ['name' => 'is_service_staff', 'value' => 1, 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f4['name']" :value="$__f4['value']" :checked="$__f4['checked']" :options="$__f4['options']" /> {{ __( 'restaurant.service_staff' ) }}
          </label>
          @show_tooltip(__('restaurant.tooltip_service_staff'))
        </div>
      </div>
    </div>
  </div>
  @endif
  <div class="row">
    <div class="col-md-3">
      <label>@lang( 'user.permissions' ):</label> 
    </div>
  </div>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'role.user' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f5 = ['name' => 'permissions[]', 'value' => 'user.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f5['name']" :value="$__f5['value']" :checked="$__f5['checked']" :options="$__f5['options']" /> {{ __( 'role.user.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f6 = ['name' => 'permissions[]', 'value' => 'user.create', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f6['name']" :value="$__f6['value']" :checked="$__f6['checked']" :options="$__f6['options']" /> {{ __( 'role.user.create' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f7 = ['name' => 'permissions[]', 'value' => 'user.update', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f7['name']" :value="$__f7['value']" :checked="$__f7['checked']" :options="$__f7['options']" /> {{ __( 'role.user.update' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f8 = ['name' => 'permissions[]', 'value' => 'user.delete', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f8['name']" :value="$__f8['value']" :checked="$__f8['checked']" :options="$__f8['options']" /> {{ __( 'role.user.delete' ) }}
          </label>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'user.roles' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f9 = ['name' => 'permissions[]', 'value' => 'roles.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f9['name']" :value="$__f9['value']" :checked="$__f9['checked']" :options="$__f9['options']" /> Ver controle de acesso
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f10 = ['name' => 'permissions[]', 'value' => 'roles.create', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f10['name']" :value="$__f10['value']" :checked="$__f10['checked']" :options="$__f10['options']" /> Criar controle de acesso
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f11 = ['name' => 'permissions[]', 'value' => 'roles.update', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f11['name']" :value="$__f11['value']" :checked="$__f11['checked']" :options="$__f11['options']" /> Editar controle de acesso
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f12 = ['name' => 'permissions[]', 'value' => 'roles.delete', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f12['name']" :value="$__f12['value']" :checked="$__f12['checked']" :options="$__f12['options']" /> Deletar controle de acesso
          </label>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'role.supplier' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f13 = ['name' => 'permissions[]', 'value' => 'supplier.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f13['name']" :value="$__f13['value']" :checked="$__f13['checked']" :options="$__f13['options']" /> {{ __( 'role.supplier.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f14 = ['name' => 'permissions[]', 'value' => 'supplier.create', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f14['name']" :value="$__f14['value']" :checked="$__f14['checked']" :options="$__f14['options']" /> {{ __( 'role.supplier.create' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f15 = ['name' => 'permissions[]', 'value' => 'supplier.update', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f15['name']" :value="$__f15['value']" :checked="$__f15['checked']" :options="$__f15['options']" /> {{ __( 'role.supplier.update' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f16 = ['name' => 'permissions[]', 'value' => 'supplier.delete', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f16['name']" :value="$__f16['value']" :checked="$__f16['checked']" :options="$__f16['options']" /> {{ __( 'role.supplier.delete' ) }}
          </label>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'role.customer' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f17 = ['name' => 'permissions[]', 'value' => 'customer.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f17['name']" :value="$__f17['value']" :checked="$__f17['checked']" :options="$__f17['options']" /> {{ __( 'role.customer.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f18 = ['name' => 'permissions[]', 'value' => 'customer.create', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f18['name']" :value="$__f18['value']" :checked="$__f18['checked']" :options="$__f18['options']" /> {{ __( 'role.customer.create' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f19 = ['name' => 'permissions[]', 'value' => 'customer.update', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f19['name']" :value="$__f19['value']" :checked="$__f19['checked']" :options="$__f19['options']" /> {{ __( 'role.customer.update' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f20 = ['name' => 'permissions[]', 'value' => 'customer.delete', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f20['name']" :value="$__f20['value']" :checked="$__f20['checked']" :options="$__f20['options']" /> {{ __( 'role.customer.delete' ) }}
          </label>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'business.product' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f21 = ['name' => 'permissions[]', 'value' => 'product.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f21['name']" :value="$__f21['value']" :checked="$__f21['checked']" :options="$__f21['options']" /> {{ __( 'role.product.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f22 = ['name' => 'permissions[]', 'value' => 'product.create', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f22['name']" :value="$__f22['value']" :checked="$__f22['checked']" :options="$__f22['options']" /> {{ __( 'role.product.create' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f23 = ['name' => 'permissions[]', 'value' => 'product.update', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f23['name']" :value="$__f23['value']" :checked="$__f23['checked']" :options="$__f23['options']" /> {{ __( 'role.product.update' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f24 = ['name' => 'permissions[]', 'value' => 'product.delete', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f24['name']" :value="$__f24['value']" :checked="$__f24['checked']" :options="$__f24['options']" /> {{ __( 'role.product.delete' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f25 = ['name' => 'permissions[]', 'value' => 'product.opening_stock', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f25['name']" :value="$__f25['value']" :checked="$__f25['checked']" :options="$__f25['options']" /> {{ __( 'lang_v1.add_opening_stock' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f26 = ['name' => 'permissions[]', 'value' => 'view_purchase_price', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f26['name']" :value="$__f26['value']" :checked="$__f26['checked']" :options="$__f26['options']" />
            {{ __('lang_v1.view_purchase_price') }}
          </label>
          @show_tooltip(__('lang_v1.view_purchase_price_tooltip'))
        </div>
      </div>
    </div>
  </div>
  <hr>
  @if(in_array('purchases', $enabled_modules) || in_array('stock_adjustment', $enabled_modules) )
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'role.purchase' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f27 = ['name' => 'permissions[]', 'value' => 'purchase.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f27['name']" :value="$__f27['value']" :checked="$__f27['checked']" :options="$__f27['options']" /> {{ __( 'role.purchase.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f28 = ['name' => 'permissions[]', 'value' => 'purchase.create', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f28['name']" :value="$__f28['value']" :checked="$__f28['checked']" :options="$__f28['options']" /> {{ __( 'role.purchase.create' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f29 = ['name' => 'permissions[]', 'value' => 'purchase.update', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f29['name']" :value="$__f29['value']" :checked="$__f29['checked']" :options="$__f29['options']" /> {{ __( 'role.purchase.update' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f30 = ['name' => 'permissions[]', 'value' => 'purchase.delete', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f30['name']" :value="$__f30['value']" :checked="$__f30['checked']" :options="$__f30['options']" /> {{ __( 'role.purchase.delete' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f31 = ['name' => 'permissions[]', 'value' => 'purchase.payments', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f31['name']" :value="$__f31['value']" :checked="$__f31['checked']" :options="$__f31['options']" />
            {{ __('lang_v1.purchase.payments') }}
          </label>
          @show_tooltip(__('lang_v1.purchase_payments'))
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f32 = ['name' => 'permissions[]', 'value' => 'purchase.update_status', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f32['name']" :value="$__f32['value']" :checked="$__f32['checked']" :options="$__f32['options']" />
            {{ __('lang_v1.update_status') }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f33 = ['name' => 'permissions[]', 'value' => 'view_own_purchase', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f33['name']" :value="$__f33['value']" :checked="$__f33['checked']" :options="$__f33['options']" />
            {{ __('lang_v1.view_own_purchase') }}
          </label>
        </div>
      </div>

    </div>
  </div>
  <hr>
  @endif
  <div class="row check_group">
    <div class="col-md-3">
      <h4>Vender</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f34 = ['name' => 'permissions[]', 'value' => 'sell.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f34['name']" :value="$__f34['value']" :checked="$__f34['checked']" :options="$__f34['options']" /> {{ __( 'role.sell.view' ) }}
          </label>
        </div>
      </div>
      @if(in_array('pos_sale', $enabled_modules))
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f35 = ['name' => 'permissions[]', 'value' => 'sell.create', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f35['name']" :value="$__f35['value']" :checked="$__f35['checked']" :options="$__f35['options']" /> {{ __( 'role.sell.create' ) }}
          </label>
        </div>
      </div>
      @endif
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f36 = ['name' => 'permissions[]', 'value' => 'sell.update', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f36['name']" :value="$__f36['value']" :checked="$__f36['checked']" :options="$__f36['options']" /> {{ __( 'role.sell.update' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f37 = ['name' => 'permissions[]', 'value' => 'sell.delete', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f37['name']" :value="$__f37['value']" :checked="$__f37['checked']" :options="$__f37['options']" /> {{ __( 'role.sell.delete' ) }}
          </label>
        </div>
      </div>
      @if(in_array('add_sale', $enabled_modules))
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f38 = ['name' => 'permissions[]', 'value' => 'direct_sell.access', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f38['name']" :value="$__f38['value']" :checked="$__f38['checked']" :options="$__f38['options']" /> {{ __( 'role.direct_sell.access' ) }}
          </label>
        </div>
      </div>
      @endif
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f39 = ['name' => 'permissions[]', 'value' => 'list_drafts', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f39['name']" :value="$__f39['value']" :checked="$__f39['checked']" :options="$__f39['options']" /> {{ __( 'lang_v1.list_drafts' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f40 = ['name' => 'permissions[]', 'value' => 'list_quotations', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f40['name']" :value="$__f40['value']" :checked="$__f40['checked']" :options="$__f40['options']" /> {{ __( 'lang_v1.list_quotations' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f41 = ['name' => 'permissions[]', 'value' => 'view_own_sell_only', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f41['name']" :value="$__f41['value']" :checked="$__f41['checked']" :options="$__f41['options']" /> {{ __( 'lang_v1.view_own_sell_only' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f42 = ['name' => 'permissions[]', 'value' => 'sell.payments', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f42['name']" :value="$__f42['value']" :checked="$__f42['checked']" :options="$__f42['options']" />
            {{ __('lang_v1.sell.payments') }}
          </label>
          @show_tooltip(__('lang_v1.sell_payments'))
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f43 = ['name' => 'permissions[]', 'value' => 'edit_product_price_from_sale_screen', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f43['name']" :value="$__f43['value']" :checked="$__f43['checked']" :options="$__f43['options']" />
            {{ __('lang_v1.edit_product_price_from_sale_screen') }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f44 = ['name' => 'permissions[]', 'value' => 'edit_product_price_from_pos_screen', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f44['name']" :value="$__f44['value']" :checked="$__f44['checked']" :options="$__f44['options']" />
            {{ __('lang_v1.edit_product_price_from_pos_screen') }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f45 = ['name' => 'permissions[]', 'value' => 'edit_product_discount_from_sale_screen', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f45['name']" :value="$__f45['value']" :checked="$__f45['checked']" :options="$__f45['options']" />
            {{ __('lang_v1.edit_product_discount_from_sale_screen') }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f46 = ['name' => 'permissions[]', 'value' => 'edit_product_discount_from_pos_screen', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f46['name']" :value="$__f46['value']" :checked="$__f46['checked']" :options="$__f46['options']" />
            {{ __('lang_v1.edit_product_discount_from_pos_screen') }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f47 = ['name' => 'permissions[]', 'value' => 'discount.access', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f47['name']" :value="$__f47['value']" :checked="$__f47['checked']" :options="$__f47['options']" />
            {{ __('lang_v1.discount.access') }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f48 = ['name' => 'permissions[]', 'value' => 'access_shipping', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f48['name']" :value="$__f48['value']" :checked="$__f48['checked']" :options="$__f48['options']" />
            {{ __('lang_v1.access_shipping') }}
          </label>
        </div>
      </div>
      @if(in_array('types_of_service', $enabled_modules))
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f49 = ['name' => 'permissions[]', 'value' => 'access_types_of_service', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f49['name']" :value="$__f49['value']" :checked="$__f49['checked']" :options="$__f49['options']" /> {{ __( 'lang_v1.access_types_of_service' ) }}
          </label>
        </div>
      </div>
      @endif
    </div>
  </div>

  <hr>

  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'role.brand' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f50 = ['name' => 'permissions[]', 'value' => 'brand.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f50['name']" :value="$__f50['value']" :checked="$__f50['checked']" :options="$__f50['options']" /> {{ __( 'role.brand.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f51 = ['name' => 'permissions[]', 'value' => 'brand.create', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f51['name']" :value="$__f51['value']" :checked="$__f51['checked']" :options="$__f51['options']" /> {{ __( 'role.brand.create' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f52 = ['name' => 'permissions[]', 'value' => 'brand.update', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f52['name']" :value="$__f52['value']" :checked="$__f52['checked']" :options="$__f52['options']" /> {{ __( 'role.brand.update' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f53 = ['name' => 'permissions[]', 'value' => 'brand.delete', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f53['name']" :value="$__f53['value']" :checked="$__f53['checked']" :options="$__f53['options']" /> {{ __( 'role.brand.delete' ) }}
          </label>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'role.tax_rate' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f54 = ['name' => 'permissions[]', 'value' => 'tax_rate.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f54['name']" :value="$__f54['value']" :checked="$__f54['checked']" :options="$__f54['options']" /> {{ __( 'role.tax_rate.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f55 = ['name' => 'permissions[]', 'value' => 'tax_rate.create', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f55['name']" :value="$__f55['value']" :checked="$__f55['checked']" :options="$__f55['options']" /> {{ __( 'role.tax_rate.create' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f56 = ['name' => 'permissions[]', 'value' => 'tax_rate.update', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f56['name']" :value="$__f56['value']" :checked="$__f56['checked']" :options="$__f56['options']" /> {{ __( 'role.tax_rate.update' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f57 = ['name' => 'permissions[]', 'value' => 'tax_rate.delete', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f57['name']" :value="$__f57['value']" :checked="$__f57['checked']" :options="$__f57['options']" /> {{ __( 'role.tax_rate.delete' ) }}
          </label>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>Unidade</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f58 = ['name' => 'permissions[]', 'value' => 'unit.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f58['name']" :value="$__f58['value']" :checked="$__f58['checked']" :options="$__f58['options']" /> {{ __( 'role.unit.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f59 = ['name' => 'permissions[]', 'value' => 'unit.create', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f59['name']" :value="$__f59['value']" :checked="$__f59['checked']" :options="$__f59['options']" /> {{ __( 'role.unit.create' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f60 = ['name' => 'permissions[]', 'value' => 'unit.update', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f60['name']" :value="$__f60['value']" :checked="$__f60['checked']" :options="$__f60['options']" /> {{ __( 'role.unit.update' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f61 = ['name' => 'permissions[]', 'value' => 'unit.delete', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f61['name']" :value="$__f61['value']" :checked="$__f61['checked']" :options="$__f61['options']" /> {{ __( 'role.unit.delete' ) }}
          </label>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'category.category' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f62 = ['name' => 'permissions[]', 'value' => 'category.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f62['name']" :value="$__f62['value']" :checked="$__f62['checked']" :options="$__f62['options']" /> {{ __( 'role.category.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f63 = ['name' => 'permissions[]', 'value' => 'category.create', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f63['name']" :value="$__f63['value']" :checked="$__f63['checked']" :options="$__f63['options']" /> {{ __( 'role.category.create' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f64 = ['name' => 'permissions[]', 'value' => 'category.update', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f64['name']" :value="$__f64['value']" :checked="$__f64['checked']" :options="$__f64['options']" /> {{ __( 'role.category.update' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f65 = ['name' => 'permissions[]', 'value' => 'category.delete', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f65['name']" :value="$__f65['value']" :checked="$__f65['checked']" :options="$__f65['options']" /> {{ __( 'role.category.delete' ) }}
          </label>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'role.report' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      @if(in_array('purchases', $enabled_modules) || in_array('add_sale', $enabled_modules) || in_array('pos_sale', $enabled_modules))
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f66 = ['name' => 'permissions[]', 'value' => 'purchase_n_sell_report.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f66['name']" :value="$__f66['value']" :checked="$__f66['checked']" :options="$__f66['options']" /> {{ __( 'role.purchase_n_sell_report.view' ) }}
          </label>
        </div>
      </div>
      @endif
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f67 = ['name' => 'permissions[]', 'value' => 'tax_report.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f67['name']" :value="$__f67['value']" :checked="$__f67['checked']" :options="$__f67['options']" /> {{ __( 'role.tax_report.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f68 = ['name' => 'permissions[]', 'value' => 'contacts_report.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f68['name']" :value="$__f68['value']" :checked="$__f68['checked']" :options="$__f68['options']" /> {{ __( 'role.contacts_report.view' ) }}
          </label>
        </div>
      </div>
      @if(in_array('expenses', $enabled_modules))
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f69 = ['name' => 'permissions[]', 'value' => 'expense_report.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f69['name']" :value="$__f69['value']" :checked="$__f69['checked']" :options="$__f69['options']" /> {{ __( 'role.expense_report.view' ) }}
          </label>
        </div>
      </div>
      @endif
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f70 = ['name' => 'permissions[]', 'value' => 'profit_loss_report.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f70['name']" :value="$__f70['value']" :checked="$__f70['checked']" :options="$__f70['options']" /> {{ __( 'role.profit_loss_report.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f71 = ['name' => 'permissions[]', 'value' => 'stock_report.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f71['name']" :value="$__f71['value']" :checked="$__f71['checked']" :options="$__f71['options']" /> {{ __( 'role.stock_report.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f72 = ['name' => 'permissions[]', 'value' => 'trending_product_report.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f72['name']" :value="$__f72['value']" :checked="$__f72['checked']" :options="$__f72['options']" /> {{ __( 'role.trending_product_report.view' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f73 = ['name' => 'permissions[]', 'value' => 'register_report.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f73['name']" :value="$__f73['value']" :checked="$__f73['checked']" :options="$__f73['options']" /> {{ __( 'role.register_report.view' ) }}
          </label>
        </div>
      </div>

      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f74 = ['name' => 'permissions[]', 'value' => 'sales_representative.view', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f74['name']" :value="$__f74['value']" :checked="$__f74['checked']" :options="$__f74['options']" /> {{ __( 'role.sales_representative.view' ) }}
          </label>
        </div>
      </div> 

    </div>
  </div>
  <hr>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'role.settings' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f75 = ['name' => 'permissions[]', 'value' => 'business_settings.access', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f75['name']" :value="$__f75['value']" :checked="$__f75['checked']" :options="$__f75['options']" /> {{ __( 'role.business_settings.access' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f76 = ['name' => 'permissions[]', 'value' => 'barcode_settings.access', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f76['name']" :value="$__f76['value']" :checked="$__f76['checked']" :options="$__f76['options']" /> {{ __( 'role.barcode_settings.access' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f77 = ['name' => 'permissions[]', 'value' => 'invoice_settings.access', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f77['name']" :value="$__f77['value']" :checked="$__f77['checked']" :options="$__f77['options']" /> {{ __( 'role.invoice_settings.access' ) }}
          </label>
        </div>
      </div>
      @if(in_array('expenses', $enabled_modules))
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f78 = ['name' => 'permissions[]', 'value' => 'expense.access', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f78['name']" :value="$__f78['value']" :checked="$__f78['checked']" :options="$__f78['options']" /> {{ __( 'role.expense.access' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f79 = ['name' => 'permissions[]', 'value' => 'view_own_expense', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f79['name']" :value="$__f79['value']" :checked="$__f79['checked']" :options="$__f79['options']" />
            {{ __('lang_v1.view_own_expense') }}
          </label>
        </div>
      </div>
      @endif
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f80 = ['name' => 'permissions[]', 'value' => 'access_printers', 'checked' => false, 'options' => ['class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f80['name']" :value="$__f80['value']" :checked="$__f80['checked']" :options="$__f80['options']" />
            {{ __('lang_v1.access_printers') }}
          </label>
        </div>
      </div>

    </div>
  </div>
  <hr>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'role.dashboard' ) @show_tooltip(__('tooltip.dashboard_permission'))</h4>
    </div>
    <div class="col-md-9">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f81 = ['name' => 'permissions[]', 'value' => 'dashboard.data', 'checked' => true, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f81['name']" :value="$__f81['value']" :checked="$__f81['checked']" :options="$__f81['options']" /> {{ __( 'role.dashboard.data' ) }}
          </label>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="row check_group">
    <div class="col-md-3">
      <h4>@lang( 'account.account' )</h4>
    </div>
    <div class="col-md-9">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f82 = ['name' => 'permissions[]', 'value' => 'account.access', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f82['name']" :value="$__f82['value']" :checked="$__f82['checked']" :options="$__f82['options']" /> {{ __( 'lang_v1.access_accounts' ) }}
          </label>
        </div>
      </div>
    </div>
  </div>
  <hr>
  @if(in_array('tables', $enabled_modules) && in_array('service_staff', $enabled_modules) )
  <div class="row check_group">
    <div class="col-md-1">
      <h4>@lang( 'restaurant.bookings' )</h4>
    </div>
    <div class="col-md-2">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
        </label>
      </div>
    </div>
    <div class="col-md-9">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f83 = ['name' => 'permissions[]', 'value' => 'crud_all_bookings', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f83['name']" :value="$__f83['value']" :checked="$__f83['checked']" :options="$__f83['options']" /> {{ __( 'restaurant.add_edit_view_all_booking' ) }}
          </label>
        </div>
      </div>
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f84 = ['name' => 'permissions[]', 'value' => 'crud_own_bookings', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f84['name']" :value="$__f84['value']" :checked="$__f84['checked']" :options="$__f84['options']" /> {{ __( 'restaurant.add_edit_view_own_booking' ) }}
          </label>
        </div>
      </div>
    </div>
  </div>
  <hr>
  @endif
  <div class="row">
    <div class="col-md-3">
      <h4>@lang( 'lang_v1.access_selling_price_groups' )</h4>
    </div>
    <div class="col-md-9">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f85 = ['name' => 'permissions[]', 'value' => 'access_default_selling_price', 'checked' => true, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f85['name']" :value="$__f85['value']" :checked="$__f85['checked']" :options="$__f85['options']" /> {{ __('lang_v1.default_selling_price') }}
          </label>
        </div>
      </div>
      @if(count($selling_price_groups) > 0)
      @foreach($selling_price_groups as $selling_price_group)
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f86 = ['name' => 'spg_permissions[]', 'value' => 'selling_price_group.' . $selling_price_group->id, 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f86['name']" :value="$__f86['value']" :checked="$__f86['checked']" :options="$__f86['options']" /> {{ $selling_price_group->name }}
          </label>
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>
  @if(in_array('tables', $enabled_modules))
  <div class="row">
    <div class="col-md-3">
      <h4>@lang( 'restaurant.restaurant' )</h4>
    </div>
    <div class="col-md-9">
      <div class="col-md-12">
        <div class="checkbox">
          <label>
            @php
            $__f87 = ['name' => 'permissions[]', 'value' => 'access_tables', 'checked' => false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f87['name']" :value="$__f87['value']" :checked="$__f87['checked']" :options="$__f87['options']" /> {{ __('lang_v1.access_tables') }}
          </label>
        </div>
      </div>
    </div>
  </div>
  @endif

  @include('role.partials.module_permissions')
  <div class="row">
    <div class="col-md-12">
     <button type="submit" class="btn btn-primary pull-right">@lang( 'messages.save' )</button>
   </div>
 </div>

 <x-form.close />
 @endcomponent
</section>
<!-- /.content -->
@endsection