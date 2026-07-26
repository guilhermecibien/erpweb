@extends('layouts.app')

@section('title', 'Adicionar Carrossel')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Adicionar Carrossel</h1>
</section>

<!-- Main content -->
<section class="content">
  @php
  $__f1 = ['options' => ['url' => action('CarrosselController@store'), 'method' => 'post', 'id' => 'carrossel_add_form', 'files' => true ]];
  @endphp
  <x-form.open :options="$__f1['options']" />
  <div class="row">
    <div class="col-md-12">
      @component('components.widget')
      
      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f2 = ['name' => 'titulo', 'value' => 'Título' . ':'];
          @endphp
          <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'titulo', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Título' ]];
          @endphp
          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          @if($errors->has('titulo'))
          <span class="text-danger">
            {{ $errors->first('titulo') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          @php
          $__f4 = ['name' => 'nome_botao', 'value' => 'Nome botão' . ':'];
          @endphp
          <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'nome_botao', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Nome botão' ]];
          @endphp
          <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
          @if($errors->has('nome_botao'))
          <span class="text-danger">
            {{ $errors->first('nome_botao') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f6 = ['name' => 'link_acao', 'value' => 'Link ação' . ':'];
          @endphp
          <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
          @php
          $__f7 = ['name' => 'link_acao', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Link ação' ]];
          @endphp
          <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
          @if($errors->has('link_acao'))
          <span class="text-danger">
            {{ $errors->first('link_acao') }}
          </span>
          @endif
        </div>
      </div>

      
      <div class="clearfix"></div>


      <div class="col-md-10">
        <div class="form-group">
          @php
          $__f8 = ['name' => 'descricao', 'value' => 'Descrição' . ':'];
          @endphp
          <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
          @php
          $__f9 = ['name' => 'descricao', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Descrição' ]];
          @endphp
          <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
          @if($errors->has('descricao'))
          <span class="text-danger">
            {{ $errors->first('descricao') }}
          </span>
          @endif
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="col-md-4">

        <div class="form-group">
          @php
          $__f10 = ['name' => 'image', 'value' => 'Imagem' . ':*'];
          @endphp
          <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
          @php
          $__f11 = ['name' => 'image', 'options' => ['id' => 'upload_image', 'accept' => 'image/*']];
          @endphp
          <x-form.input type="file" :name="$__f11['name']" :options="$__f11['options']" />
          <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]) <br> @lang('lang_v1.aspect_ratio_should_be_1_1')</p></small>
          @if($errors->has('image'))
          <span class="text-danger">
            {{ $errors->first('image') }}
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-3" style="visibility: hidden">
        <div class="form-group">
          @php
          $__f12 = ['name' => 'cor_fundo', 'value' => 'Cor de fundo' . '*:'];
          @endphp
          <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
          <input class="form-control" type="color" name="cor_fundo">

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

      var img_fileinput_setting = {
        showUpload: false,
        showPreview: true,
        browseLabel: LANG.file_browse_label,
        removeLabel: LANG.remove,
        previewSettings: {
          image: { width: '100%', height: 'auto', 'max-width': '100%', 'max-height': '100%' },
        },
      };
      $('#upload_image').fileinput(img_fileinput_setting);

    });

    
  </script>
  @endsection
