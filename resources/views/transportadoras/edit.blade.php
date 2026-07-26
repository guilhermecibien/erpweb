@extends('layouts.app')

@section('title', 'Editar Transportadora')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Editar Transportadora</h1>
</section>

<!-- Main content -->
<section class="content">
  @php
  $__f1 = ['options' => ['url' => action('TransportadoraController@update'), 'method' => 'post', 'id' => 'natureza_add_form' ]];
  @endphp
  <x-form.open :options="$__f1['options']" />
  <div class="row">
    <input type="hidden" value="{{$transportadora->id}}" name="id">
    <div class="col-md-12">
      @component('components.widget')
      
      <div class="col-md-5">
        <div class="form-group">
          @php
          $__f2 = ['name' => 'razao_social', 'value' => 'Razão Social' . ':*'];
          @endphp
          <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'razao_social', 'value' => $transportadora->razao_social, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Razão Social' ]];
          @endphp
          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
        </div>
      </div>
      
      <div class="clearfix"></div>


      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f4 = ['name' => 'cnpj_cpf', 'value' => 'CNPJ/CPF' . '*:'];
          @endphp
          <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'cnpj_cpf', 'value' => $transportadora->cnpj_cpf, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'CNPJ/CPF' ]];
          @endphp
          <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
        </div>
      </div>

      <div class="col-md-5">
        <div class="form-group">
          @php
          $__f6 = ['name' => 'logradouro', 'value' => 'Logradouro' . '*:'];
          @endphp
          <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
          @php
          $__f7 = ['name' => 'logradouro', 'value' => $transportadora->logradouro, 'options' => ['class' => 'form-control', 'required', 'placeholder' => 'Logradouro' ]];
          @endphp
          <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="col-md-4 customer_fields">
        <div class="form-group">
          @php
          $__f8 = ['name' => 'cidade_id', 'value' => 'Cidade:*'];
          @endphp
          <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
          @php
          $__f9 = ['name' => 'cidade_id', 'list' => $cities, 'selected' => $transportadora->cidade_id, 'options' => ['class' => 'form-control select2', 'required']];
          @endphp
          <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
        </div>
      </div>
      

      
      @endcomponent
    </div>


  </div>

  @if(!empty($form_partials))
  @foreach($form_partials as $partial)
  {!! $partial !!}
  @endforeach
  @endif
  <div class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary pull-right" id="submit_user_button">@lang( 'messages.save' )</button>
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

    $('form#user_add_form').validate({
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
              }
            }
          }
        },
        password: {
          required: true,
          minlength: 5
        },
        confirm_password: {
          equalTo: "#password"
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
    $('#username').change( function(){
      if($('#show_username').length > 0){
        if($(this).val().trim() != ''){
          $('#show_username').html("{{__('lang_v1.your_username_will_be')}}: <b>" + $(this).val() + "{{$username_ext}}</b>");
        } else {
          $('#show_username').html('');
        }
      }
    });
  </script>
  @endsection
