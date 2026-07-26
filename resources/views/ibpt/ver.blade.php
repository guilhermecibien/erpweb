@extends('layouts.app')
@section('title', 'Lista de Naturezas')

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>IBPT</h1>
        <p>Gerencia {{$ibpt->uf}}</p>
    </div>
    <a href="/ibpt" class="sa-header-action">
        <i class="fa fa-arrow-left"></i> Voltar
    </a>
</section>

<section class="content sa-dashboard">

    @can('user.view')
    <div class="sa-page-card">
        <div class="sa-page-card-body">
            <div class="sa-table-wrap">
                <table class="sa-table" id="users_table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Nacional/Federal</th>
                            <th>Importado/Federal</th>
                            <th>Estadual</th>
                            <th>Municipal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($itens as $i)
                        <tr>
                            <td>{{$i->codigo}}</td>
                            <td>{{$i->descricao}}</td>
                            <td>{{$i->nacional_federal}}</td>
                            <td>{{$i->importado_federal}}</td>
                            <td>{{$i->estadual}}</td>
                            <td>{{$i->municipal}}</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="sa-empty-row">Nenhum item cadastrado</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="sa-business-pagination">
                {{$itens->links()}}
            </div>
        </div>
    </div>
    @endcan

    <div class="modal fade user_modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>

</section>
<!-- /.content -->
@stop
@section('javascript')

@endsection
