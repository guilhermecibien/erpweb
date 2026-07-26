@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | Business')

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>{{ $business->name }}</h1>
        <p>@lang( 'superadmin::lang.view_business' )</p>
    </div>
    <a href="{{action('\Modules\Superadmin\Http\Controllers\BusinessController@index')}}" class="sa-header-action">
        <i class="fa fa-arrow-left"></i> Voltar
    </a>
</section>

<section class="content sa-dashboard">

    <div class="sa-page-card">
        <div class="sa-page-card-header">
            <i class="fa fa-briefcase"></i>
            <h3>Dados da empresa</h3>
        </div>
        <div class="sa-page-card-body">
            <div class="sa-info-grid">
                <div class="sa-info-block">
                    <div>
                        <span class="sa-info-item-label"><i class="fa fa-briefcase"></i> @lang('business.business_name')</span>
                        <p class="sa-info-item-value">{{ $business->name }}</p>
                    </div>
                    <div>
                        <span class="sa-info-item-label"><i class="fa fa-toggle-on"></i> Status</span>
                        <span class="sa-badge-pill {{ $business->is_active == 0 ? 'sa-business-status-inactive' : 'sa-business-status-active' }}">
                            {{ $business->is_active == 0 ? 'Inativo' : 'Ativo' }}
                        </span>
                    </div>
                </div>
                <div class="sa-info-block">
                    <div>
                        <span class="sa-info-item-label"><i class="fa fa-user-circle"></i> Proprietário</span>
                        <p class="sa-info-item-value">{{$business->owner->surname}} {{$business->owner->first_name}} {{$business->owner->last_name}}</p>
                    </div>
                    @if(!empty($business->owner->address))
                        <div>
                            <span class="sa-info-item-label"><i class="fa fa-map-marker"></i> @lang('business.address')</span>
                            <p class="sa-info-item-value">{{$business->owner->address}}</p>
                        </div>
                    @endif
                </div>
                @if(!empty($business->logo))
                    <div class="sa-info-block">
                        <img class="img-responsive" style="max-width: 160px; border-radius: 10px;" src="{{ url( 'uploads/business_logos/' . $business->logo ) }}" alt="Business Logo">
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="sa-page-card">
        <div class="sa-page-card-header">
            <i class="fa fa-map-marker"></i>
            <h3>@lang( 'superadmin::lang.business_location' )</h3>
        </div>
        <div class="sa-page-card-body">
            <div class="sa-table-wrap">
                <table class="sa-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>ID da localização</th>
                            <th>Referência</th>
                            <th>Cidade</th>
                            <th>CEP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($business->locations as $location)
                        <tr>
                            <td>{{ $location->name }}</td>
                            <td>{{ $location->location_id }}</td>
                            <td>{{ $location->landmark }}</td>
                            <td>{{ $location->city }}</td>
                            <td>{{ $location->zip_code }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="sa-empty-row">Nenhuma localização cadastrada</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="sa-page-card">
        <div class="sa-page-card-header">
            <i class="fa fa-file"></i>
            <h3>Registros</h3>
        </div>
        @php $registros = $business->getRegistros() @endphp
        <div class="sa-page-card-body">
            <div class="sa-mini-stats-grid">
                <div class="sa-mini-stat">
                    <span class="sa-mini-stat-label">Clientes</span>
                    <span class="sa-mini-stat-value">{{$registros['clientes']}}</span>
                </div>
                <div class="sa-mini-stat">
                    <span class="sa-mini-stat-label">Fornecedores</span>
                    <span class="sa-mini-stat-value">{{$registros['fornecedores']}}</span>
                </div>
                <div class="sa-mini-stat">
                    <span class="sa-mini-stat-label">Vendas</span>
                    <span class="sa-mini-stat-value">{{$registros['vendas']}}</span>
                </div>
                <div class="sa-mini-stat">
                    <span class="sa-mini-stat-label">Vendas em PDV</span>
                    <span class="sa-mini-stat-value">{{$registros['vendas_pdv']}}</span>
                </div>
                <div class="sa-mini-stat">
                    <span class="sa-mini-stat-label">NFe Emitidas</span>
                    <span class="sa-mini-stat-value">{{$registros['nfes']}}</span>
                </div>
                <div class="sa-mini-stat">
                    <span class="sa-mini-stat-label">NFCe Emitidas</span>
                    <span class="sa-mini-stat-value">{{$registros['nfces']}}</span>
                </div>
                <div class="sa-mini-stat">
                    <span class="sa-mini-stat-label">CTe Emitidas</span>
                    <span class="sa-mini-stat-value">{{$registros['ctes']}}</span>
                </div>
                <div class="sa-mini-stat">
                    <span class="sa-mini-stat-label">MDFe Emitidas</span>
                    <span class="sa-mini-stat-value">{{$registros['mdfes']}}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="sa-page-card">
        <div class="sa-page-card-header">
            <i class="fa fa-refresh"></i>
            <h3>@lang( 'superadmin::lang.package_subscription' )</h3>
        </div>
        <div class="sa-page-card-body">
            <div class="sa-table-wrap">
                <table class="sa-table">
                    <thead>
                        <tr>
                            <th>Plano</th>
                            <th>Inicio</th>
                            <th>Fim do teste</th>
                            <th>Fim</th>
                            <th>Pagamento Via</th>
                            <th>ID</th>
                            <th>Criado</th>
                            <th>Usuário</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($business->subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->package_details['name'] }}</td>
                            <td>@if(!empty($subscription->start_date)){{@format_date($subscription->start_date)}}@endif</td>
                            <td>@if(!empty($subscription->trial_end_date)){{@format_date($subscription->trial_end_date)}}@endif</td>
                            <td>@if(!empty($subscription->end_date)){{@format_date($subscription->end_date)}}@endif</td>
                            <td>{{ $subscription->paid_via }}</td>
                            <td>{{ $subscription->payment_transaction_id }}</td>
                            <td>{{ $subscription->created_at }}</td>
                            <td>@if(!empty($subscription->created_user)) {{$subscription->created_user->user_full_name}} @endif</td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="sa-empty-row">Nenhuma assinatura cadastrada</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @can('user.view')
    <div class="sa-page-card">
        <div class="sa-page-card-header">
            <i class="fa fa-users"></i>
            <h3>@lang( 'user.all_users' )</h3>
        </div>
        <div class="sa-page-card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="users_table">
                    <thead>
                        <tr>
                            <th>@lang( 'business.username' )</th>
                            <th>@lang( 'user.name' )</th>
                            <th>@lang( 'user.role' )</th>
                            <th>@lang( 'business.email' )</th>
                            <th>@lang( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @endcan

    @include('superadmin::business.update_password_modal')
</section>
@stop
    @section('javascript')
    <script type="text/javascript">
    //Roles table
    $(document).ready( function(){
        var users_table = $('#users_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/superadmin/users/' + "{{$business->id}}",
            columnDefs: [ {
                "targets": [4],
                "orderable": false,
                "searchable": false
            } ],
            "columns":[
            {"data":"username"},
            {"data":"full_name"},
            {"data":"role"},
            {"data":"email"},
            {"data":"action"}
            ]
        });
        
    });

    $(document).on('click', '.update_user_password', function (e) {
        e.preventDefault();
        $('form#password_update_form, #user_id').val($(this).data('user_id'));
        $('span#user_name').text($(this).data('user_name'));
        $('#update_password_modal').modal('show');
    });

    password_update_form_validator = $('form#password_update_form').validate();

    $('#update_password_modal').on('hidden.bs.modal', function() {
        password_update_form_validator.resetForm();
        $('form#password_update_form')[0].reset();
    });

    $(document).on('submit', 'form#password_update_form', function(e) {
        e.preventDefault();
        $(this)
        .find('button[type="submit"]')
        .attr('disabled', true);
        var data = $(this).serialize();
        $.ajax({
            method: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == true) {
                    $('#update_password_modal').modal('hide');
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
                $('form#password_update_form')
                .find('button[type="submit"]')
                .attr('disabled', false);
            },
        });
    });

</script>      
@endsection
