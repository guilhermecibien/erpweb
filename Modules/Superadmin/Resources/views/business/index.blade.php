@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | Business')

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>@lang( 'superadmin::lang.all_business' )</h1>
        <p>@lang( 'superadmin::lang.manage_business' )</p>
    </div>
    <a href="{{action('\Modules\Superadmin\Http\Controllers\BusinessController@create')}}"
        class="sa-header-action">
        <i class="fa fa-plus"></i> @lang( 'messages.add' )
    </a>
</section>

<section class="content sa-dashboard">

    @can('superadmin')

        <div class="sa-business-grid">
            @foreach ($businesses as $business)
                @php
                    $address = $business->locations->first();
                    $package = !empty($business->subscriptions[0]) ? optional($business->subscriptions[0])->package : null;

                    $address_array = [];
                    $city_landmark = '';
                    if(!empty($address) && !empty($address->city)){
                        $city_landmark = $address->city;
                    }
                    if(!empty($address) && !empty($address->landmark)){
                        $city_landmark .= ', ' . $address->landmark;
                    }
                    if(!empty($city_landmark)){
                        $address_array[] = $city_landmark;
                    }

                    $state_country = '';
                    if(!empty($address) && !empty($address->state)){
                        $state_country = $address->state;
                    }
                    if(!empty($address) && !empty($address->country)){
                        $state_country .= ' (' . $address->country . ')';
                    }
                    if(!empty($state_country)){
                        $address_array[] = $state_country;
                    }
                    if(!empty($address) && !empty($address->zip_code)){
                        $address_array[] = __('business.zip_code') . ': ' .$address->zip_code;
                    }

                    $phone = implode(", ", array_filter([optional($address)->mobile, optional($address)->alternate_number]));
                @endphp

                <div class="sa-business-card">
                    <div class="sa-business-card-header">
                        <div class="sa-business-avatar">
                            @if(!empty($business->logo))
                                <img src="{{ url( 'uploads/business_logos/' . $business->logo ) }}" alt="{{ $business->name }}">
                            @else
                                {{ mb_strtoupper(mb_substr($business->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="sa-business-title">
                            <h4 class="sa-business-name" title="{{ $business->name }}">{{ $business->name }}</h4>
                            @if(!empty($business->cnpj))
                                <p class="sa-business-cnpj">{{ $business->cnpj }}</p>
                            @endif
                        </div>
                        <span class="sa-business-status {{ $business->is_active == 1 ? 'sa-business-status-active' : 'sa-business-status-inactive' }}">
                            {{ $business->is_active == 1 ? 'Ativa' : 'Inativa' }}
                        </span>
                    </div>

                    <div class="sa-business-body">
                        @if($business->owner)
                            <div class="sa-business-row">
                                <i class="fa fa-user-secret"></i>
                                <span>{{ trim($business->owner->first_name . ' ' . $business->owner->last_name) }}</span>
                            </div>
                            <div class="sa-business-row">
                                <i class="fa fa-envelope"></i>
                                <span>{{ $business->owner->email }}</span>
                            </div>
                            @if(!empty($business->owner->contact_no))
                                <div class="sa-business-row">
                                    <i class="fa fa-mobile"></i>
                                    <span>{{ $business->owner->contact_no }}</span>
                                </div>
                            @endif
                        @endif

                        @if(!empty($phone))
                            <div class="sa-business-row">
                                <i class="fa fa-phone"></i>
                                <span>{{ $phone }}</span>
                            </div>
                        @endif

                        @if(!empty($address_array))
                            <div class="sa-business-row">
                                <i class="fa fa-map-marker"></i>
                                <span>{!! strip_tags(implode('<br>', $address_array), '<br>') !!}</span>
                            </div>
                        @endif

                        @if(!empty($package))
                            <div class="sa-business-package">
                                <i class="fa fa-credit-card"></i> {{ $package->name }}
                            </div>
                            <div class="sa-business-remaining">
                                <i class="fas fa-clock"></i>
                                @lang('superadmin::lang.remaining', ['days' => \Carbon::today()->diffInDays($business->subscriptions[0]->end_date)])
                            </div>
                        @endif
                    </div>

                    <div class="sa-business-footer">
                        <a href="{{action('\Modules\Superadmin\Http\Controllers\BusinessController@show', [$business->id])}}"
                            class="sa-btn-pill sa-btn-pill-outline">@lang('superadmin::lang.manage' )</a>

                        <button type="button" class="sa-btn-pill sa-btn-pill-primary btn-modal" data-href="{{action('\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController@create', ['business_id' => $business->id])}}" data-container=".view_modal">
                            @lang('superadmin::lang.add_subscription' )
                        </button>

                        @if($business->is_active == 1)
                            <a href="{{action('\Modules\Superadmin\Http\Controllers\BusinessController@toggleActive', [$business->id, 0])}}"
                                class="sa-btn-pill sa-btn-pill-danger link_confirmation">Desativar</a>
                        @else
                            <a href="{{action('\Modules\Superadmin\Http\Controllers\BusinessController@toggleActive', [$business->id, 1])}}"
                                class="sa-btn-pill sa-btn-pill-success link_confirmation">Ativar</a>
                        @endif

                        @if($business_id != $business->id)
                            <a href="{{action('\Modules\Superadmin\Http\Controllers\BusinessController@destroy', [$business->id])}}"
                                class="sa-btn-pill sa-btn-pill-danger delete_business_confirmation">@lang('messages.delete' )</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="sa-business-pagination">
            {{ $businesses->links() }}
        </div>

    @endcan

    <div class="modal fade brands_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>

</section>

@endsection

@section('javascript')

<script type="text/javascript">
    $(document).on('click', 'a.delete_business_confirmation', function(e){
        e.preventDefault();
        swal({
            title: LANG.sure,
            text: "Depois de excluído, você não poderá recuperar esta empresa!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                window.location.href = $(this).attr('href');
            }
        });
    });
</script>

@endsection
