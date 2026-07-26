@extends('layouts.app')

@section('title', __( 'user.edit_user' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'user.edit_user' )</h1>
</section>

<!-- Main content -->
<section class="content">
    @php
    $__f1 = ['options' => ['url' => action('ManageUserController@update', [$user->id]), 'method' => 'PUT', 'id' => 'user_edit_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />
    <div class="row">
        <div class="col-md-12">
        @component('components.widget', ['class' => 'box-primary'])
            <div class="col-md-2">
                <div class="form-group">
                  @php
                  $__f2 = ['name' => 'surname', 'value' => __( 'business.prefix' ) . ':'];
                  @endphp
                  <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
                    @php
                    $__f3 = ['name' => 'surname', 'value' => $user->surname, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]];
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
                    $__f5 = ['name' => 'first_name', 'value' => $user->first_name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]];
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
                    $__f7 = ['name' => 'last_name', 'value' => $user->last_name, 'options' => ['class' => 'form-control', 'placeholder' => 'Sobre nome' ]];
                    @endphp
                    <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                  @php
                  $__f8 = ['name' => 'email', 'value' => __( 'business.email' ) . ':*'];
                  @endphp
                  <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
                    @php
                    $__f9 = ['name' => 'email', 'value' => $user->email, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'business.email' ) ]];
                    @endphp
                    <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                  <div class="checkbox">
                    <br>
                    <label>
                         @php
                         $__f10 = ['name' => 'is_active', 'value' => $user->status, 'checked' => $is_checked_checkbox, 'options' => ['class' => 'input-icheck status']];
                         @endphp
                         <x-form.checkbox :name="$__f10['name']" :value="$__f10['value']" :checked="$__f10['checked']" :options="$__f10['options']" /> {{ __('lang_v1.status_for_user') }}
                    </label>
                    @show_tooltip(__('lang_v1.tooltip_enable_user_active'))
                  </div>
                </div>
            </div>
            
        @endcomponent
        </div>
        <div class="col-md-12">
        @component('components.widget', ['title' => __('lang_v1.roles_and_permissions')])
            <div class="col-md-4">
                <div class="form-group">
                    <div class="checkbox">
                      <label>
                        @php
                        $__f11 = ['name' => 'allow_login', 'value' => 1, 'checked' => !empty($user->allow_login), 'options' => [ 'class' => 'input-icheck', 'id' => 'allow_login']];
                        @endphp
                        <x-form.checkbox :name="$__f11['name']" :value="$__f11['value']" :checked="$__f11['checked']" :options="$__f11['options']" /> {{ __( 'lang_v1.allow_login' ) }}
                      </label>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="user_auth_fields @if(empty($user->allow_login)) hide @endif">
            @if(empty($user->allow_login))
                <div class="col-md-4">
                    <div class="form-group">
                      @php
                      $__f12 = ['name' => 'username', 'value' => __( 'business.username' ) . ':'];
                      @endphp
                      <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
                      @if(!empty($username_ext))
                        <div class="input-group">
                          @php
                          $__f13 = ['name' => 'username', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.username' ) ]];
                          @endphp
                          <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
                          <span class="input-group-addon">{{$username_ext}}</span>
                        </div>
                        <p class="help-block" id="show_username"></p>
                      @else
                          @php
                          $__f14 = ['name' => 'username', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.username' ) ]];
                          @endphp
                          <x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
                      @endif
                      <p class="help-block">@lang('lang_v1.username_help')</p>
                    </div>
                </div>
            @endif
            <div class="col-md-4">
                <div class="form-group">
                  @php
                  $__f15 = ['name' => 'password', 'value' => 'Senha' . ':'];
                  @endphp
                  <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
                    @php
                    $__f16 = ['name' => 'password', 'options' => ['class' => 'form-control', 'placeholder' => 'Senha', 'required' => empty($user->allow_login) ? true : false ], 'value' => ''];
                    @endphp
                    <x-form.input type="password" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
                    <p class="help-block">@lang('user.leave_password_blank')</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  @php
                  $__f17 = ['name' => 'confirm_password', 'value' => __( 'business.confirm_password' ) . ':'];
                  @endphp
                  <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
                    @php
                    $__f18 = ['name' => 'confirm_password', 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.confirm_password' ), 'required' => empty($user->allow_login) ? true : false ], 'value' => ''];
                    @endphp
                    <x-form.input type="password" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
                  
                </div>
            </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6">
                <div class="form-group">
                  @php
                  $__f19 = ['name' => 'role', 'value' => 'Nível de acesso:*'];
                  @endphp
                  <x-form.label :name="$__f19['name']" :value="$__f19['value']" /> @show_tooltip(__('lang_v1.admin_role_location_permission_help'))
                    @php
                    $__f20 = ['name' => 'role', 'list' => $roles, 'selected' => !empty($user->roles->first()->id) ? $user->roles->first()->id : null, 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%;']];
                    @endphp
                    <x-form.select :name="$__f20['name']" :list="$__f20['list']" :selected="$__f20['selected']" :options="$__f20['options']" />
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
                <h4>@lang( 'role.access_locations' ) @show_tooltip(__('tooltip.access_locations_permission'))</h4>
            </div>
            <div class="col-md-9">
                <div class="col-md-12">
                    <div class="checkbox">
                        <label>
                          @php
                          $__f21 = ['name' => 'access_all_locations', 'value' => 'access_all_locations', 'checked' => !is_array($permitted_locations) && $permitted_locations == 'all', 'options' => [ 'class' => 'input-icheck']];
                          @endphp
                          <x-form.checkbox :name="$__f21['name']" :value="$__f21['value']" :checked="$__f21['checked']" :options="$__f21['options']" /> {{ __( 'role.all_locations' ) }} 
                        </label>
                        @show_tooltip(__('tooltip.all_location_permission'))
                    </div>
                  </div>
              @foreach($locations as $location)
                <div class="col-md-12">
                    <div class="checkbox">
                      <label>
                        @php
                        $__f22 = ['name' => 'location_permissions[]', 'value' => 'location.' . $location->id, 'checked' => is_array($permitted_locations) && in_array($location->id, $permitted_locations), 'options' => [ 'class' => 'input-icheck']];
                        @endphp
                        <x-form.checkbox :name="$__f22['name']" :value="$__f22['value']" :checked="$__f22['checked']" :options="$__f22['options']" /> {{ $location->name }}
                      </label>
                    </div>
                </div>
              @endforeach
            </div>
        @endcomponent
        </div>

        <div class="col-md-12">
            @component('components.widget', ['title' => __('sale.sells')])

            <div class="col-md-4">
                <div class="form-group">
                  @php
                  $__f23 = ['name' => 'cmmsn_percent', 'value' => __( 'lang_v1.cmmsn_percent' ) . ':'];
                  @endphp
                  <x-form.label :name="$__f23['name']" :value="$__f23['value']" /> @show_tooltip(__('lang_v1.commsn_percent_help'))
                    @php
                    $__f24 = ['name' => 'cmmsn_percent', 'value' => !empty($user->cmmsn_percent) ? number_format($user->cmmsn_percent, 2, ',', '.') : 0, 'options' => ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.cmmsn_percent' )]];
                    @endphp
                    <x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                  @php
                  $__f25 = ['name' => 'max_sales_discount_percent', 'value' => 'Porcentagem de desconto máximo de vendas' . ':'];
                  @endphp
                  <x-form.label :name="$__f25['name']" :value="$__f25['value']" /> @show_tooltip('Porcentagem máxima de desconto que um usuário pode dar durante a venda. Deixe em branco sem restrições')
                    @php
                    $__f26 = ['name' => 'max_sales_discount_percent', 'value' => !is_null($user->max_sales_discount_percent) ? number_format($user->max_sales_discount_percent, 2, ',', '.') : null, 'options' => ['class' => 'form-control input_number', 'placeholder' => 'Porcentagem de desconto máximo de vendas' ]];
                    @endphp
                    <x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="checkbox">
                    <br/>
                      <label>
                        @php
                        $__f27 = ['name' => 'selected_contacts', 'value' => 1, 'checked' => $user->selected_contacts, 'options' => [ 'class' => 'input-icheck', 'id' => 'selected_contacts']];
                        @endphp
                        <x-form.checkbox :name="$__f27['name']" :value="$__f27['value']" :checked="$__f27['checked']" :options="$__f27['options']" /> {{ __( 'lang_v1.allow_selected_contacts' ) }}
                      </label>
                      @show_tooltip(__('lang_v1.allow_selected_contacts_tooltip'))
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4 selected_contacts_div @if(!$user->selected_contacts) hide @endif">
                <div class="form-group">
                  @php
                  $__f28 = ['name' => 'selected_contacts', 'value' => __('lang_v1.selected_contacts') . ':'];
                  @endphp
                  <x-form.label :name="$__f28['name']" :value="$__f28['value']" />
                    <div class="form-group">
                      @php
                      $__f29 = ['name' => 'selected_contact_ids[]', 'list' => $contacts, 'selected' => $contact_access, 'options' => ['class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;' ]];
                      @endphp
                      <x-form.select :name="$__f29['name']" :list="$__f29['list']" :selected="$__f29['selected']" :options="$__f29['options']" />
                    </div>
                </div>
            </div>
            @endcomponent
        </div>
    </div>
    @include('user.edit_profile_form_part', ['bank_details' => !empty($user->bank_details) ? json_decode($user->bank_details, true) : null])

    @if(!empty($form_partials))
      @foreach($form_partials as $partial)
        {!! $partial !!}
      @endforeach
    @endif
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary pull-right" id="submit_user_button">@lang( 'messages.update' )</button>
        </div>
    </div>
    <x-form.close />
  @stop
@section('javascript')
<script type="text/javascript">
  $(document).ready(function(){
    $('#selected_contacts').on('ifChecked', function(event){
      $('div.selected_contacts_div').removeClass('hide');
    });
    $('#selected_contacts').on('ifUnchecked', function(event){
      $('div.selected_contacts_div').addClass('hide');
    });
    $('#allow_login').on('ifChecked', function(event){
      $('div.user_auth_fields').removeClass('hide');
    });
    $('#allow_login').on('ifUnchecked', function(event){
      $('div.user_auth_fields').addClass('hide');
    });
  });

  $('form#user_edit_form').validate({
                rules: {
                    first_name: {
                        required: true,
                    },
                    email: {
                        email: true,
                        remote: {
                            url: "/business/register/check-email",
                            type: "post",
                            data: {
                                email: function() {
                                    return $( "#email" ).val();
                                },
                                user_id: {{$user->id}}
                            }
                        }
                    },
                    password: {
                        minlength: 5
                    },
                    confirm_password: {
                        equalTo: "#password",
                    },
                    username: {
                        minlength: 5,
                        remote: {
                            url: "/business/register/check-username",
                            type: "post",
                            data: {
                                username: function() {
                                    return $( "#username" ).val();
                                },
                                @if(!empty($username_ext))
                                  username_ext: "{{$username_ext}}"
                                @endif
                            }
                        }
                    }
                },
                messages: {
                    password: {
                        minlength: 'Password should be minimum 5 characters',
                    },
                    confirm_password: {
                        equalTo: 'Should be same as password'
                    },
                    username: {
                        remote: 'Invalid username or User already exist'
                    },
                    email: {
                        remote: '{{ __("validation.unique", ["attribute" => __("business.email")]) }}'
                    }
                }
            });
</script>
@endsection