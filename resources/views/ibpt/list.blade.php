@extends('layouts.app')
@section('title', 'IBPT')

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>IBPT</h1>
        <p>Gerencia tabelas</p>
    </div>
    @can('user.create')
    <a href="/ibpt/new" class="sa-header-action">
        <i class="fa fa-plus"></i> @lang( 'messages.add' )
    </a>
    @endcan
</section>

<section class="content sa-dashboard">

    @can('user.view')
    <div class="sa-page-card">
        <div class="sa-page-card-body">
            <div class="sa-table-wrap">
                <table class="sa-table">
                    <thead>
                        <tr>
                            <th>UF</th>
                            <th>Versão</th>
                            <th>Atualizado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tabelas as $i)
                        <tr>
                            <td><strong>{{$i->uf}}</strong></td>
                            <td>{{$i->versao}}</td>
                            <td>{{ \Carbon\Carbon::parse($i->updated_at)->format('d/m/Y H:i:s')}}</td>
                            <td>
                                <div class="sa-table-actions">
                                    <a href="/ibpt/list/{{$i->id}}" class="sa-btn-pill sa-btn-pill-outline" title="Ver itens">
                                        <i class="fa fa-list"></i>
                                    </a>
                                    <a href="/ibpt/edit/{{$i->id}}" class="sa-btn-pill sa-btn-pill-outline" title="Editar">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#!" class="sa-btn-pill sa-btn-pill-danger" title="Remover"
                                        onclick='swal("Atenção!", "Deseja remover este registro?", "warning").then((sim) => {if(sim){ location.href="/ibpt/delete/{{ $i->id }}" }else{return false} })'>
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="sa-empty-row">Nenhuma tabela cadastrada</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endcan

</section>
<!-- /.content -->
@stop
@section('javascript')

@endsection
