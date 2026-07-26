@extends('layouts.app')
@section('title', 'Lista de Veiculos')

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>Veículos</h1>
        <p>Gerencia veículos</p>
    </div>
    @can('user.create')
        <a href="/veiculos/new" class="sa-header-action">
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
                                <th>Placa</th>
                                <th>UF</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Cor</th>
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
                    ajax: '/veiculos',
                    columnDefs: [ {
                        "targets": [4],
                        "orderable": false,
                        "searchable": false
                    } ],
                    "columns":[
                        {"data":"placa"},
                        {"data":"uf"},
                        {"data":"marca"},
                        {"data":"modelo"},
                        {"data":"cor"},
                        {"data":"action"}
                    ]
                });
        $(document).on('click', 'button.delete_user_button', function(){
            swal({
              title: LANG.sure,
              text: LANG.confirm_delete_user,
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();
                    $.ajax({
                        method: "DELETE",
                        url: href,
                        dataType: "json",
                        data: data,
                        success: function(result){
                            if(result.success == true){
                                toastr.success(result.msg);
                                users_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
             });
        });
    });
</script>
@endsection
