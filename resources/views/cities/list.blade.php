@extends('layouts.app')
@section('title', 'Lista de Cidades')

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>Cidades</h1>
        <p>Gerencia cidades</p>
    </div>
    @can('user.create')
        <a href="/cities/new" class="sa-header-action">
            <i class="fa fa-plus"></i> @lang( 'messages.add' )
        </a>
    @endcan
</section>

<section class="content sa-dashboard">

    @can('user.view')
        <div class="sa-page-card">
            <div class="sa-page-card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="users_table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Código</th>
                                <th>UF</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endcan

</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
    $(document).ready( function(){
        var users_table = $('#users_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/cities',
                    columnDefs: [ {
                        "targets": [3],
                        "orderable": false,
                        "searchable": false
                    } ],
                    "columns":[
                        {"data":"nome"},
                        {"data":"codigo"},
                        {"data":"uf"},
                        {"data":"action"}
                    ]
                });
    });
</script>
@endsection
