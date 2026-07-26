@inject('request', 'Illuminate\Http\Request')
<!-- Main Header -->
  <header class="main-header no-print">
    <a href="{{route('home')}}" class="logo">
      
      <span class="logo-lg">{{ Session::get('business.name') }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <div class="navbar-left-group">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="hamburger-icon"><span></span><span></span><span></span></span>
          <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Global search (visual only for now) -->
        <form class="header-search-form" action="#" onsubmit="return false;">
          <i class="fa fa-search header-search-icon" aria-hidden="true"></i>
          <input type="text" class="header-search-input" placeholder="@lang('lang_v1.search')" aria-label="@lang('lang_v1.search')">
        </form>
      </div>

      @if(Module::has('Superadmin'))
        @includeIf('superadmin::layouts.partials.active_subscription')
      @endif

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">

        <div class="navbar-toolbar">

          <div class="m-8 pull-left mt-15 hidden-xs env-badge env-badge-{{ auth()->user()->business->ambiente == 2 ? 'staging' : 'live' }}">
            <i class="fa fa-circle env-badge-dot" aria-hidden="true"></i>
            {{auth()->user()->business->ambiente == 2 ? 'Homologação' : 'Produção'}}
          </div>

          @if(Module::has('Essentials'))
            @includeIf('essentials::layouts.partials.header_part')
          @endif

          <button id="btnCalculator" title="@lang('lang_v1.calculator')" type="button" class="btn btn-success btn-flat pull-left m-8 hidden-xs btn-sm mt-10 popover-default" data-toggle="popover" data-trigger="click" data-content='@include("layouts.partials.calculator")' data-html="true" data-placement="bottom">
              <i class="fa fa-calculator" aria-hidden="true"></i>
          </button>

          @if($request->segment(1) == 'pos')
            <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-success btn-flat pull-left m-8 hidden-xs btn-sm mt-10 btn-modal" data-container=".register_details_modal"
            data-href="{{ action('CashRegisterController@getRegisterDetails')}}">
              <i class="fa fa-briefcase" aria-hidden="true"></i>
            </button>
            <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-danger btn-flat pull-left m-8 hidden-xs btn-sm mt-10 btn-modal" data-container=".close_register_modal"
            data-href="{{ action('CashRegisterController@getCloseRegister')}}">
              <i class="fa fa-window-close"></i>
            </button>
          @endif

          @if(in_array('pos_sale', $enabled_modules))
            @can('sell.create')
              <a href="{{action('SellPosController@create')}}" title="PDV" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-flat pull-left m-8 hidden-xs btn-sm mt-10 btn-pos">
                <i class="fa fa-th-large" aria-hidden="true"></i> PDV
              </a>
            @endcan
          @endif

          @can('profit_loss_report.view')
            <button type="button" id="view_todays_profit" title="{{ __('home.todays_profit') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-success btn-flat pull-left m-8 hidden-xs btn-sm mt-10">
              <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
            </button>
          @endcan

          <!-- Help Button -->
          @if(auth()->user()->hasRole('Admin#' . auth()->user()->business_id))
            <button type="button" id="start_tour" title="@lang('lang_v1.application_tour')" data-toggle="tooltip" data-placement="bottom" class="btn btn-success btn-flat pull-left m-8 hidden-xs btn-sm mt-10">
              <i class="fa fa-question-circle" aria-hidden="true"></i>
            </button>
          @endif

          <div class="m-8 pull-left mt-15 hidden-xs navbar-date">
            <i class="fa fa-calendar-alt" aria-hidden="true"></i>
            <strong>{{ @format_date('now') }}</strong>
          </div>

        </div>

        <ul class="nav navbar-nav">
          @include('layouts.partials.header-notifications')
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              @php
                $profile_photo = auth()->user()->media;
              @endphp
              @if(!empty($profile_photo))
                <img src="{{$profile_photo->display_url}}" class="user-image" alt="User Image">
              @else
                <span class="user-image-placeholder"><i class="fa fa-user" aria-hidden="true"></i></span>
              @endif
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span>{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}</span>
              <i class="fa fa-chevron-down user-menu-caret" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-user">
              <li class="user-menu-header">
                <span class="user-menu-avatar">
                  @if(!empty($profile_photo))
                    <img src="{{$profile_photo->display_url}}" alt="User Image">
                  @else
                    <i class="fa fa-user" aria-hidden="true"></i>
                  @endif
                </span>
                <span class="user-menu-info">
                  <strong>{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}</strong>
                  <small>{{ Session::get('business.name') }}</small>
                </span>
              </li>
              <li class="user-menu-divider"></li>
              <li>
                <a href="{{action('UserController@getProfile')}}" class="user-menu-item">
                  <i class="fa fa-user-circle" aria-hidden="true"></i> @lang('lang_v1.profile')
                </a>
              </li>
              <li>
                <a href="{{action('Auth\LoginController@logout')}}" class="user-menu-item user-menu-item-danger">
                  <i class="fa fa-sign-out-alt" aria-hidden="true"></i> @lang('lang_v1.sign_out')
                </a>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>