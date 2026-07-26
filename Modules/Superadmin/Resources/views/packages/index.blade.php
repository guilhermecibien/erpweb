@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.packages'))

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>@lang( 'superadmin::lang.packages' )</h1>
        <p>Todos os planos</p>
    </div>
    <a href="{{action('\Modules\Superadmin\Http\Controllers\PackagesController@create')}}"
        class="sa-header-action">
        <i class="fa fa-plus"></i> @lang( 'messages.add' )
    </a>
</section>

<section class="content sa-dashboard">
    @include('superadmin::layouts.partials.currency')

    <div class="sa-package-grid">
        @foreach ($packages as $package)
            <div class="sa-package-card">
                <div class="sa-package-card-header">
                    <h4 class="sa-package-name" title="{{$package->name}}">{{$package->name}}</h4>
                    <span class="sa-badge-pill {{ $package->is_active == 1 ? 'sa-badge-green' : 'sa-badge-red' }}">
                        {{ $package->is_active == 1 ? __('superadmin::lang.active') : __('superadmin::lang.inactive') }}
                    </span>
                </div>

                <div class="sa-package-actions">
                    <a href="{{action('\Modules\Superadmin\Http\Controllers\PackagesController@edit', [$package->id])}}"
                        class="sa-btn-pill sa-btn-pill-outline" title="Editar"><i class="fa fa-edit"></i> Editar</a>
                    <a href="{{action('\Modules\Superadmin\Http\Controllers\PackagesController@destroy', [$package->id])}}"
                        class="sa-btn-pill sa-btn-pill-danger link_confirmation" title="Remover"><i class="fa fa-trash"></i> Remover</a>
                </div>

                <div class="sa-package-body">
                    <div class="sa-package-row">
                        <i class="fa fa-map-marker"></i>
                        <span>
                            @if($package->location_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{$package->location_count}}
                            @endif
                            @lang('business.business_locations')
                        </span>
                    </div>
                    <div class="sa-package-row">
                        <i class="fa fa-users"></i>
                        <span>
                            @if($package->user_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{$package->user_count}}
                            @endif
                            @lang('superadmin::lang.users')
                        </span>
                    </div>
                    <div class="sa-package-row">
                        <i class="fa fa-cube"></i>
                        <span>
                            @if($package->product_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{$package->product_count}}
                            @endif
                            @lang('superadmin::lang.products')
                        </span>
                    </div>
                    <div class="sa-package-row">
                        <i class="fa fa-file-text"></i>
                        <span>
                            @if($package->invoice_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{$package->invoice_count}}
                            @endif
                            @lang('superadmin::lang.invoices')
                        </span>
                    </div>
                    @if($package->trial_days != 0)
                        <div class="sa-package-row">
                            <i class="fa fa-clock-o"></i>
                            <span>{{$package->trial_days}} @lang('superadmin::lang.trial_days')</span>
                        </div>
                    @endif

                    @if(!empty($package->custom_permissions))
                        @foreach($package->custom_permissions as $permission => $value)
                            @isset($permission_formatted[$permission])
                                <div class="sa-package-row">
                                    <i class="fa fa-check"></i>
                                    <span>{{$permission_formatted[$permission]}}</span>
                                </div>
                            @endisset
                        @endforeach
                    @endif
                </div>

                <div class="sa-package-price">
                    @if($package->price != 0)
                        <span class="display_currency" data-currency_symbol="true">
                            {{$package->price}}
                        </span>
                        <small>
                            / {{$package->interval_count}} {{__('lang_v1.' . $package->interval)}}
                        </small>
                    @else
                        @lang('superadmin::lang.free_for_duration', ['duration' => $package->interval_count . ' ' . __('lang_v1.' . $package->interval)])
                    @endif
                </div>

                @if(!empty($package->description))
                    <div class="sa-package-footer">{{$package->description}}</div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="sa-business-pagination">
        {{ $packages->links() }}
    </div>

    <div class="modal fade brands_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection
