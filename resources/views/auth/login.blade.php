@extends('layouts.auth2')
@section('title', __('lang_v1.login'))

@section('content')
    <style type="text/css">
        .eq-height-row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            min-height: 100vh;
        }

        .eq-height-col {
            float: none;
        }

        .left-col {
            background: #16232f !important;
            background-image:
                radial-gradient(rgba(255, 255, 255, 0.045) 1px, transparent 1px) !important;
            background-size: 22px 22px !important;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .left-col-content {
            width: 100%;
            padding: 0 60px;
            text-align: left;
        }

        .left-col-content > div {
            margin-top: 0 !important;
        }

        .left-col-content a {
            color: #f4f6f8;
            font-size: 26px;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: .2px;
        }

        .left-col-content small {
            display: block;
            margin-top: 10px;
            color: #93a2b1;
            font-size: 14px;
        }

        .left-col-content .tagline {
            margin-top: 40px;
            max-width: 320px;
            color: #7c8b9a;
            font-size: 14.5px;
            line-height: 1.6;
        }

        .right-col {
            background: #fff;
        }

        .right-col-content {
            min-height: calc(100vh - 56px);
            width: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: 24px 20px;
        }

        .login-form {
            max-width: 340px;
            width: 100%;
        }

        .login-form .form-header {
            font-size: 24px;
            font-weight: 600;
            color: #222d37;
            margin: 0 0 6px;
        }

        .login-form .form-subheader {
            font-size: 14px;
            color: #8a97a3;
            margin: 0 0 28px;
        }

        .login-form label {
            font-size: 13px;
            font-weight: 500;
            color: #4a5560;
            margin-bottom: 6px;
        }

        .login-form .form-control {
            height: 42px;
            border: 1px solid #d8dee3;
            border-radius: 5px;
            box-shadow: none;
            font-size: 14.5px;
            padding: 8px 12px;
            transition: border-color .15s ease;
        }

        .login-form .form-control:focus {
            border-color: #337ab7;
            box-shadow: 0 0 0 3px rgba(51, 122, 183, .12);
        }

        .login-form .form-group {
            margin-bottom: 18px;
        }

        .login-form .help-block {
            font-size: 12.5px;
            margin-top: 5px;
        }

        .login-form .checkbox.icheck label {
            font-weight: 400;
            font-size: 13.5px;
            color: #5a6774;
        }

        .login-form .btn-login {
            width: 100%;
            height: 42px;
            background: #337ab7;
            border-color: #337ab7;
            color: #fff;
            border-radius: 5px;
            font-size: 14.5px;
            font-weight: 500;
            letter-spacing: .2px;
        }

        .login-form .btn-login:hover,
        .login-form .btn-login:focus {
            background: #2c6aa0;
            border-color: #2c6aa0;
            color: #fff;
        }

        .login-form .forgot-link {
            display: block;
            text-align: center;
            margin-top: 16px;
            font-size: 13.5px;
            color: #8a97a3;
        }

        .login-form .forgot-link:hover {
            color: #337ab7;
        }

        .login-form .register-link {
            text-align: center;
            margin: 28px 0 0;
            padding-top: 20px;
            border-top: 1px solid #eef0f2;
            font-size: 13.5px;
            color: #8a97a3;
        }

        .login-form .register-link a {
            color: #337ab7;
            font-weight: 500;
            text-decoration: none;
            margin-left: 4px;
        }

        .login-form .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 991px) {
            .right-col-content {
                padding: 20px 24px;
            }
        }
    </style>
    <div class="col-md-12 col-xs-12 right-col-content">
        <div class="login-form">
        <p class="form-header">@lang('lang_v1.login')</p>
        <p class="form-subheader">Acesse sua conta para continuar</p>
        <form method="POST" action="{{ route('login') }}" id="login-form">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                @php
                    $username = old('username');
                    $password = null;
                    if(config('app.env') == 'demo'){
                        $username = 'admin';
                        $password = '123456';

                        $demo_types = array(
                            'all_in_one' => 'admin',
                            'super_market' => 'admin',
                            'pharmacy' => 'admin-pharmacy',
                            'electronics' => 'admin-electronics',
                            'services' => 'admin-services',
                            'restaurant' => 'admin-restaurant',
                            'superadmin' => 'superadmin',
                            'woocommerce' => 'woocommerce_user',
                            'essentials' => 'admin-essentials',
                            'manufacturing' => 'manufacturer-demo',
                        );

                        if( !empty($_GET['demo_type']) && array_key_exists($_GET['demo_type'], $demo_types) ){
                            $username = $demo_types[$_GET['demo_type']];
                        }
                    }
                @endphp
                <label for="username">@lang('lang_v1.username')</label>
                <input id="username" type="text" class="form-control" name="username" @isset($CookieUserName)) value="{{$CookieUserName}}" @endif required autofocus>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">@lang('lang_v1.password')</label>
                <input id="password" type="password" class="form-control" name="password" @isset($Cookiepass)) value="{{$Cookiepass}}" @endif required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember" @isset($Cookieremember) @if($Cookieremember == true) checked @endif @endif> @lang('lang_v1.remember_me')
                    </label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-flat btn-login">@lang('lang_v1.login')</button>
                @if(config('app.env') != 'demo')
                <a href="{{ route('password.request') }}" class="forgot-link">
                    @lang('lang_v1.forgot_your_password')
                </a>
            @endif
            </div>
        </form>
        @if(config('constants.allow_registration') && config('app.env') != 'demo')
        <p class="register-link">
            <span class="text-muted">Ainda não é registrado?</span>
            <a href="{{ route('business.getRegister') }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif">{{ __('business.register_now') }}</a>
        </p>
        @endif
        </div>
    </div>
    @if(config('app.env') == 'demo')
    <div class="col-md-12 col-xs-12" style="padding-bottom: 30px;">
        @component('components.widget', ['class' => 'box-primary', 'header' => '<h4 class="text-center">Demo Shops <small><i> Demos are for example purpose only, this application <u>can be used in many other similar businesses.</u></i></small></h4>'])

            <a href="?demo_type=all_in_one" class="btn btn-app bg-olive demo-login" data-toggle="tooltip" title="Showcases all feature available in the application." data-admin="{{$demo_types['all_in_one']}}"> <i class="fas fa-star"></i> All In One</a>

            <a href="?demo_type=pharmacy" class="btn bg-maroon btn-app demo-login" data-toggle="tooltip" title="Shops with products having expiry dates." data-admin="{{$demo_types['pharmacy']}}"><i class="fas fa-medkit"></i>Pharmacy</a>

            <a href="?demo_type=services" class="btn bg-orange btn-app demo-login" data-toggle="tooltip" title="For all service providers like Web Development, Restaurants, Repairing, Plumber, Salons, Beauty Parlors etc." data-admin="{{$demo_types['services']}}"><i class="fas fa-wrench"></i>Multi-Service Center</a>

            <a href="?demo_type=electronics" class="btn bg-purple btn-app demo-login" data-toggle="tooltip" title="Products having IMEI or Serial number code."  data-admin="{{$demo_types['electronics']}}" ><i class="fas fa-laptop"></i>Electronics & Mobile Shop</a>

            <a href="?demo_type=super_market" class="btn bg-navy btn-app demo-login" data-toggle="tooltip" title="Super market & Similar kind of shops." data-admin="{{$demo_types['super_market']}}" ><i class="fas fa-shopping-cart"></i> Super Market</a>

            <a href="?demo_type=restaurant" class="btn bg-red btn-app demo-login" data-toggle="tooltip" title="Restaurants, Salons and other similar kind of shops." data-admin="{{$demo_types['restaurant']}}"><i class="fas fa-utensils"></i> Restaurant</a>
            <hr>

            <i class="icon fas fa-plug"></i> Premium optional modules:<br><br>

            <a href="?demo_type=superadmin" class="btn bg-red-active btn-app demo-login" data-toggle="tooltip" title="SaaS & Superadmin extension Demo" data-admin="{{$demo_types['superadmin']}}"><i class="fas fa-university"></i> SaaS / Superadmin</a>

            <a href="?demo_type=woocommerce" class="btn bg-woocommerce btn-app demo-login" data-toggle="tooltip" title="WooCommerce demo user - Open web shop in minutes!!" style="color:white !important" data-admin="{{$demo_types['woocommerce']}}"> <i class="fab fa-wordpress"></i> WooCommerce</a>

            <a href="?demo_type=essentials" class="btn bg-navy btn-app demo-login" data-toggle="tooltip" title="Essentials & HRM (human resource management) Module Demo" style="color:white !important" data-admin="{{$demo_types['essentials']}}">
                    <i class="fas fa-check-circle"></i>
                    Essentials & HRM</a>
                    
            <a href="?demo_type=manufacturing" class="btn bg-orange btn-app demo-login" data-toggle="tooltip" title="Manufacturing module demo" style="color:white !important" data-admin="{{$demo_types['manufacturing']}}">
                    <i class="fas fa-industry"></i>
                    Manufacturing Module</a>

            <a href="?demo_type=superadmin" class="btn bg-maroon btn-app demo-login" data-toggle="tooltip" title="Project module demo" style="color:white !important" data-admin="{{$demo_types['superadmin']}}">
                    <i class="fas fa-project-diagram"></i>
                    Project Module</a>
        @endcomponent   
    </div>
    @endif 
@stop
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "{{ route('login') }}?lang=" + $(this).val();
        });

        $('a.demo-login').click( function (e) {
           e.preventDefault();
           $('#username').val($(this).data('admin'));
           $('#password').val("{{$password}}");
           $('form#login-form').submit();
        });
    })
</script>
@endsection
