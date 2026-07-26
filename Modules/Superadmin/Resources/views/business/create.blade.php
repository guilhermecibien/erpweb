@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | Business')

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>Adicionar nova empresa</h1>
        <p>@lang( 'superadmin::lang.add_business_help' )</p>
    </div>
    <a href="{{action('\Modules\Superadmin\Http\Controllers\BusinessController@index')}}" class="sa-header-action">
        <i class="fa fa-arrow-left"></i> Voltar
    </a>
</section>

<section class="content sa-dashboard">

    <div class="sa-page-card">
        <div class="sa-page-card-body sa-business-form">
            {!! Form::open(['url' => action('\Modules\Superadmin\Http\Controllers\BusinessController@store'), 'method' => 'post', 'id' => 'business_register_form','files' => true ]) !!}
                @include('business.partials.register_form')

                <div class="sa-form-actions">
                    {!! Form::submit('Salvar', ['class' => 'sa-btn-pill sa-btn-pill-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="modal fade brands_modal" tabindex="-1" role="dialog"
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
@endsection


@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.select2_register').select2();
            $("form#business_register_form").validate({
                errorPlacement: function(error, element) {
                    if(element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    name: "required",
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
                        required: true,
                        minlength: 4,
                        remote: {
                            url: "/business/register/check-username",
                            type: "post",
                            data: {
                                username: function() {
                                    return $( "#username" ).val();
                                }
                            }
                        }
                    }
                },
                messages: {
                    name: LANG.specify_business_name,
                    password: {
                        minlength: LANG.password_min_length,
                    },
                    confirm_password: {
                        equalTo: LANG.password_mismatch
                    },
                    username: {
                        remote: LANG.invalid_username
                    },
                    email: {
                        remote: '{{ __("validation.unique", ["attribute" => __("business.email")]) }}'
                    }
                }
            });

            $("#business_logo").fileinput({'showUpload':false, 'showPreview':false, 'browseLabel': LANG.file_browse_label, 'removeLabel': LANG.remove});
        });
    </script>
@endsection