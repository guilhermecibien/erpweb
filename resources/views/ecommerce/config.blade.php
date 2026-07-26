@extends('layouts.app')

@section('title', 'Configuração de Ecommerce')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Configuração de Ecommerce</h1>
</section>

<!-- Main content -->
<section class="content">
  @php
  $__f1 = ['options' => ['url' => action('EcommerceController@save'), 'method' => 'post', 'id' => 'config_form', 'files' => true ]];
  @endphp
  <x-form.open :options="$__f1['options']" />
  <div class="row">
    <div class="col-md-12">
      @component('components.widget', ['class' => 'box-primary'])
      
      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f2 = ['name' => 'nome', 'value' => 'Nome' . ':*'];
          @endphp
          <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'nome', 'value' => $config != null ? $config->nome : old('nome'), 'options' => ['class' => 'form-control', 'placeholder' => 'Nome' ]];
          @endphp
          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          @if($errors->has('nome'))
          <span class="text-danger">
            {{ $errors->first('nome') }}
          </span>
          @endif
          <span></span>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f4 = ['name' => 'email', 'value' => 'Email' . ':*'];
          @endphp
          <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'email', 'value' => $config != null ? $config->email : old('email'), 'options' => ['class' => 'form-control', 'placeholder' => 'Email' ]];
          @endphp
          <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
          @if($errors->has('email'))
          <span class="text-danger">
            {{ $errors->first('email') }}
          </span>
          @endif
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f6 = ['name' => 'telefone', 'value' => 'Telefone' . ':*'];
          @endphp
          <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
          @php
          $__f7 = ['name' => 'telefone', 'value' => $config != null ? $config->telefone : old('telefone'), 'options' => ['class' => 'form-control', 'placeholder' => 'Telefone', 'data-mask="00 00000-0000"', 'data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
          @if($errors->has('telefone'))
          <span class="text-danger">
            {{ $errors->first('telefone') }}
          </span>
          @endif
        </div>
      </div>

      
      <div class="clearfix"></div>

      <div class="col-md-5">
        <div class="form-group">
          @php
          $__f8 = ['name' => 'rua', 'value' => 'Rua' . ':*'];
          @endphp
          <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
          @php
          $__f9 = ['name' => 'rua', 'value' => $config != null ? $config->rua : old('rua'), 'options' => ['class' => 'form-control', 'placeholder' => 'Rua' ]];
          @endphp
          <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
          @if($errors->has('rua'))
          <span class="text-danger">
            {{ $errors->first('rua') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f10 = ['name' => 'numero', 'value' => 'Nº' . ':*'];
          @endphp
          <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
          @php
          $__f11 = ['name' => 'numero', 'value' => $config != null ? $config->numero : old('numero'), 'options' => ['class' => 'form-control', 'placeholder' => 'Nº' ]];
          @endphp
          <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
          @if($errors->has('numero'))
          <span class="text-danger">
            {{ $errors->first('numero') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f12 = ['name' => 'bairro', 'value' => 'Bairro' . ':*'];
          @endphp
          <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
          @php
          $__f13 = ['name' => 'bairro', 'value' => $config != null ? $config->bairro : old('bairro'), 'options' => ['class' => 'form-control', 'placeholder' => 'Bairro' ]];
          @endphp
          <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
          @if($errors->has('bairro'))
          <span class="text-danger">
            {{ $errors->first('bairro') }}
          </span>
          @endif
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f14 = ['name' => 'cidade', 'value' => 'Cidade' . ':*'];
          @endphp
          <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
          @php
          $__f15 = ['name' => 'cidade', 'value' => $config != null ? $config->cidade : old('cidade'), 'options' => ['class' => 'form-control', 'placeholder' => 'Cidade' ]];
          @endphp
          <x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
          @if($errors->has('cidade'))
          <span class="text-danger">
            {{ $errors->first('cidade') }}
          </span>
          @endif
        </div>
      </div>


      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f16 = ['name' => 'cep', 'value' => 'CEP' . ':*'];
          @endphp
          <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
          @php
          $__f17 = ['name' => 'cep', 'value' => $config != null ? $config->cep : old('cep'), 'options' => ['class' => 'form-control', 'placeholder' => 'CEP', 'data-mask="00000-000"', 'data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
          @if($errors->has('cep'))
          <span class="text-danger">
            {{ $errors->first('cep') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f18 = ['name' => 'latitude', 'value' => 'Latitude' . ':*'];
          @endphp
          <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
          @php
          $__f19 = ['name' => 'latitude', 'value' => $config != null ? $config->latitude : old('latitude'), 'options' => ['class' => 'form-control', 'placeholder' => 'Latitude' ]];
          @endphp
          <x-form.input type="text" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
          @if($errors->has('latitude'))
          <span class="text-danger">
            {{ $errors->first('latitude') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f20 = ['name' => 'longitude', 'value' => 'Longitude' . ':*'];
          @endphp
          <x-form.label :name="$__f20['name']" :value="$__f20['value']" />
          @php
          $__f21 = ['name' => 'longitude', 'value' => $config != null ? $config->longitude : old('longitude'), 'options' => ['class' => 'form-control', 'placeholder' => 'Longitude' ]];
          @endphp
          <x-form.input type="text" :name="$__f21['name']" :value="$__f21['value']" :options="$__f21['options']" />
          @if($errors->has('longitude'))
          <span class="text-danger">
            {{ $errors->first('longitude') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f22 = ['name' => 'frete_gratis_valor', 'value' => 'Frete gratis a partir de' . ':*'];
          @endphp
          <x-form.label :name="$__f22['name']" :value="$__f22['value']" />
          @php
          $__f23 = ['name' => 'frete_gratis_valor', 'value' => $config != null ? $config->frete_gratis_valor : old('frete_gratis_valor'), 'options' => ['class' => 'form-control', 'placeholder' => 'Frete gratis a partir de', 'data-mask="0000000,00"', 'data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f23['name']" :value="$__f23['value']" :options="$__f23['options']" />
          @if($errors->has('frete_gratis_valor'))
          <span class="text-danger">
            {{ $errors->first('frete_gratis_valor') }}
          </span>
          @endif
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f24 = ['name' => 'link_facebook', 'value' => 'Link facebook' . ':*'];
          @endphp
          <x-form.label :name="$__f24['name']" :value="$__f24['value']" />
          @php
          $__f25 = ['name' => 'link_facebook', 'value' => $config != null ? $config->link_facebook : old('link_facebook'), 'options' => ['class' => 'form-control', 'placeholder' => 'Link facebook' ]];
          @endphp
          <x-form.input type="text" :name="$__f25['name']" :value="$__f25['value']" :options="$__f25['options']" />
          @if($errors->has('link_facebook'))
          <span class="text-danger">
            {{ $errors->first('link_facebook') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f26 = ['name' => 'link_twiter', 'value' => 'Link twiter' . ':*'];
          @endphp
          <x-form.label :name="$__f26['name']" :value="$__f26['value']" />
          @php
          $__f27 = ['name' => 'link_twiter', 'value' => $config != null ? $config->link_twiter : old('link_twiter'), 'options' => ['class' => 'form-control', 'placeholder' => 'Link twiter' ]];
          @endphp
          <x-form.input type="text" :name="$__f27['name']" :value="$__f27['value']" :options="$__f27['options']" />
          @if($errors->has('link_twiter'))
          <span class="text-danger">
            {{ $errors->first('link_twiter') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f28 = ['name' => 'link_instagram', 'value' => 'Link instagram' . ':*'];
          @endphp
          <x-form.label :name="$__f28['name']" :value="$__f28['value']" />
          @php
          $__f29 = ['name' => 'link_instagram', 'value' => $config != null ? $config->link_instagram : old('link_instagram'), 'options' => ['class' => 'form-control', 'placeholder' => 'Link instagram' ]];
          @endphp
          <x-form.input type="text" :name="$__f29['name']" :value="$__f29['value']" :options="$__f29['options']" />
          @if($errors->has('link_instagram'))
          <span class="text-danger">
            {{ $errors->first('link_instagram') }}
          </span>
          @endif
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-6">
        <div class="form-group">
          @php
          $__f30 = ['name' => 'mercadopago_public_key', 'value' => 'Mercado pago public key' . ':*'];
          @endphp
          <x-form.label :name="$__f30['name']" :value="$__f30['value']" />
          @php
          $__f31 = ['name' => 'mercadopago_public_key', 'value' => $config != null ? $config->mercadopago_public_key : old('mercadopago_public_key'), 'options' => ['class' => 'form-control', 'placeholder' => 'Mercado pago public key' ]];
          @endphp
          <x-form.input type="text" :name="$__f31['name']" :value="$__f31['value']" :options="$__f31['options']" />
          @if($errors->has('mercadopago_public_key'))
          <span class="text-danger">
            {{ $errors->first('mercadopago_public_key') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          @php
          $__f32 = ['name' => 'mercadopago_access_token', 'value' => 'Mercado pago access token' . ':*'];
          @endphp
          <x-form.label :name="$__f32['name']" :value="$__f32['value']" />
          @php
          $__f33 = ['name' => 'mercadopago_access_token', 'value' => $config != null ? $config->mercadopago_access_token : old('mercadopago_access_token'), 'options' => ['class' => 'form-control', 'placeholder' => 'Mercado pago access token' ]];
          @endphp
          <x-form.input type="text" :name="$__f33['name']" :value="$__f33['value']" :options="$__f33['options']" />
          @if($errors->has('mercadopago_access_token'))
          <span class="text-danger">
            {{ $errors->first('mercadopago_access_token') }}
          </span>
          @endif
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-10">
        <div class="form-group">
          @php
          $__f34 = ['name' => 'funcionamento', 'value' => 'Descreva o funcionamento' . ':*'];
          @endphp
          <x-form.label :name="$__f34['name']" :value="$__f34['value']" />
          @php
          $__f35 = ['name' => 'funcionamento', 'value' => $config != null ? $config->funcionamento : old('funcionamento'), 'options' => ['class' => 'form-control', 'placeholder' => 'Descreva o funcionamento' ]];
          @endphp
          <x-form.input type="text" :name="$__f35['name']" :value="$__f35['value']" :options="$__f35['options']" />
          @if($errors->has('funcionamento'))
          <span class="text-danger">
            {{ $errors->first('funcionamento') }}
          </span>
          @endif
        </div>
      </div>

      <div class="clearfix"></div>
      <div class="col-md-12">
        <div class="form-group">
          @php
          $__f36 = ['name' => 'politica_privacidade', 'value' => 'Politica de privacidade'];
          @endphp
          <x-form.label :name="$__f36['name']" :value="$__f36['value']" />
          @php
          $__f37 = ['name' => 'politica_privacidade', 'value' => $config != null ? $config->politica_privacidade : old('politica_privacidade'), 'options' => ['class' => 'form-control', 'rows' => 3, 'id' => 'politica_privacidade']];
          @endphp
          <x-form.textarea :name="$__f37['name']" :value="$__f37['value']" :options="$__f37['options']" />
        </div>
      </div>

      <div class="col-sm-12">
        <div class="form-group">
          @php
          $__f38 = ['name' => 'mensagem_agradecimento', 'value' => 'Mensagem de agradecimento' . ':'];
          @endphp
          <x-form.label :name="$__f38['name']" :value="$__f38['value']" />
          @php
          $__f39 = ['name' => 'mensagem_agradecimento', 'value' => $config != null ? $config->mensagem_agradecimento : old('mensagem_agradecimento'), 'options' => ['class' => 'form-control', 'id' => 'mensagem_agradecimento']];
          @endphp
          <x-form.textarea :name="$__f39['name']" :value="$__f39['value']" :options="$__f39['options']" />
        </div>
        @if($errors->has('mensagem_agradecimento'))
        <span class="text-danger">
          {{ $errors->first('mensagem_agradecimento') }}
        </span>
        @endif
      </div>

      <div class="clearfix"></div>

      <div class="col-md-5">
        <div class="form-group">
          @php
          $__f40 = ['name' => 'token', 'value' => 'Api token' . ':*'];
          @endphp
          <x-form.label :name="$__f40['name']" :value="$__f40['value']" />
          <div class="input-group">

            @php
            $__f41 = ['name' => 'token', 'value' => $config != null ? $config->token : old('token'), 'options' => ['class' => 'form-control', 'placeholder' => 'Api Token', 'id' => 'token', 'readonly' ]];
            @endphp
            <x-form.input type="text" :name="$__f41['name']" :value="$__f41['value']" :options="$__f41['options']" />
            <span class="input-group-btn">
              <button type="button" id="btn_token" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""><i class="fa fa-code text-danger fa-lg"></i></button>
            </span>
            
          </div>
          @if($errors->has('token'))
          <span class="text-danger">
            {{ $errors->first('token') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f42 = ['name' => 'cor_fundo', 'value' => 'Cor de destaque' . '*:'];
          @endphp
          <x-form.label :name="$__f42['name']" :value="$__f42['value']" />
          <input class="form-control" value="{{$config != null ? $config->cor_fundo : old('cor_fundo')}}" type="color" name="cor_fundo">

        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f43 = ['name' => 'cor_btn', 'value' => 'Cor Botão' . '*:'];
          @endphp
          <x-form.label :name="$__f43['name']" :value="$__f43['value']" />
          <input class="form-control" value="{{$config != null ? $config->cor_btn : old('cor_btn')}}" type="color" name="cor_btn">

        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          @php
          $__f44 = ['name' => 'timer_carrossel', 'value' => 'Tempo carrossel segundos' . ':*'];
          @endphp
          <x-form.label :name="$__f44['name']" :value="$__f44['value']" />
          @php
          $__f45 = ['name' => 'timer_carrossel', 'value' => $config != null ? $config->timer_carrossel : old('timer_carrossel'), 'options' => ['class' => 'form-control', 'placeholder' => 'Tempo carrossel segundos', 'data-mask="000"', 'data-mask-reverse="true"' ]];
          @endphp
          <x-form.input type="text" :name="$__f45['name']" :value="$__f45['value']" :options="$__f45['options']" />
          @if($errors->has('timer_carrossel'))
          <span class="text-danger">
            {{ $errors->first('timer_carrossel') }}
          </span>
          @endif
        </div>
      </div>

      <div class="clearfix"></div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="logo">Logo:</label>
          <input name="logo" type="file" id="logo" accept="image/*">
          <p class="help-block"><i>A logo anterior (se existir) será substituída</i></p>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label for="img_contato">Imagem tela contato:</label>
          <input name="img_contato" type="file" id="img_contato" accept="image/*">
          <p class="help-block"><i>A imagem anterior (se existir) será substituída</i></p>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label for="fav_icon">Favicon:</label>
          <input name="fav_icon" type="file" id="fav_icon" accept="image/*">
          <p class="help-block"><i>A imagem anterior (se existir) será substituída</i></p>
        </div>
      </div>

      <input type="hidden" value="@if(isset($config)){{$config->img_contato}}@else '' @endif" id="img_contato_aux">
      <input type="hidden" value="@if(isset($config)){{$config->logo}}@else '' @endif" id="logo_aux">
      <input type="hidden" value="@if(isset($config)){{$config->fav_icon}}@else '' @endif" id="fav_aux">

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
      <button type="submit" class="btn btn-primary pull-right" id="submit_button">@lang( 'messages.save' )</button>
    </div>
  </div>
  <x-form.close />
  @stop

  @section('javascript')
  <script type="text/javascript">

    $(document).on('click', '#submit_button', function(e) {
      e.preventDefault();

      $('form#config_form').validate()
      if ($('form#config_form').valid()) {
        $('form#config_form').submit();
      }
    })

    $('#btn_token').click(() => {
      let token = generate_token(25);

      swal({
        title: LANG.sure,
        text: "Esse token é o responsavel pela comunicação com o ecommerce, tenha atenção!!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((confirmed) => {
        if (confirmed) {
          $('#token').val(token)
        }
      });

    })

    function generate_token(length){

      var a = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890".split("");
      var b = [];  
      for (var i=0; i<length; i++) {
        var j = (Math.random() * (a.length-1)).toFixed(0);
        b[i] = a[j];
      }
      return b.join("");
    }

    setTimeout(() => {
      let img = $('#logo_aux').val();

      var img_fileinput_setting = {
        showUpload: false,
        showPreview: true,
        browseLabel: LANG.file_browse_label,
        removeLabel: LANG.remove,
        previewSettings: {
          image: { width: '150px', height: '150px', 'max-width': '100%', 'max-height': '100%' },
        },
      };
      if(img){
        img_fileinput_setting.initialPreview = '/uploads/ecommerce_logos/'+img
        img_fileinput_setting.initialPreviewAsData = true

      }
      $('#logo').fileinput(img_fileinput_setting);

      let img2 = $('#img_contato_aux').val();
      var img_fileinput_setting2 = {
        showUpload: false,
        showPreview: true,
        browseLabel: LANG.file_browse_label,
        removeLabel: LANG.remove,

        previewSettings: {
          image: { width: '150px', height: '150px', 'max-width': '100%', 'max-height': '100%' },
        },
      };

      if(img2){
        img_fileinput_setting2.initialPreview = '/uploads/ecommerce_contatos/'+img2
        img_fileinput_setting2.initialPreviewAsData = true

      }

      $('#img_contato').fileinput(img_fileinput_setting2);

      let img3 = $('#fav_aux').val();
      var img_fileinput_setting3 = {
        showUpload: false,
        showPreview: true,
        browseLabel: LANG.file_browse_label,
        removeLabel: LANG.remove,

        previewSettings: {
          image: { width: '150px', height: '150px', 'max-width': '100%', 'max-height': '100%' },
        },
      };

      if(img3){
        img_fileinput_setting3.initialPreview = '/uploads/ecommerce_fav/'+img3
        img_fileinput_setting3.initialPreviewAsData = true

      }

      $('#fav_icon').fileinput(img_fileinput_setting3);
    }, 500);

    if ($('textarea#mensagem_agradecimento').length > 0) {
      tinymce.init({
        selector: 'textarea#mensagem_agradecimento',
        height:350
      });
    }

  </script>
  @endsection

