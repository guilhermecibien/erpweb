@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.communicator'))

@section('content')

<section class="content-header sa-header">
    <div class="sa-header-text">
        <h1>@lang('superadmin::lang.communicator')</h1>
        <p>@lang('superadmin::lang.compose_message')</p>
    </div>
</section>

<section class="content sa-dashboard">

    <div class="sa-page-card">
        <div class="sa-page-card-header">
            <i class="fa fa-edit"></i>
            <h3>@lang('superadmin::lang.compose_message')</h3>
        </div>
        <div class="sa-page-card-body sa-business-form">
            {!! Form::open(['url' => action('\Modules\Superadmin\Http\Controllers\CommunicatorController@send'), 'method' => 'post', 'id' => 'communication_form']) !!}
                <div class="col-md-12 form-group">
                    {!! Form::label('recipients', __('superadmin::lang.recipients').':*') !!}
                    <button type="button" class="sa-btn-pill sa-btn-pill-outline select-all">@lang('lang_v1.select_all')</button>
                    <button type="button" class="sa-btn-pill sa-btn-pill-outline deselect-all">@lang('lang_v1.deselect_all')</button>
                    {!! Form::select('recipients[]', $businesses, null, ['class' => 'form-control select2', 'required', 'multiple', 'id' => 'recipients']); !!}
                </div>
                <div class="col-md-12 form-group">
                    {!! Form::label('subject', __('superadmin::lang.subject').':*') !!}
                    {!! Form::text('subject', null, ['class' => 'form-control', 'required']); !!}
                </div>
                <div class="col-md-12 form-group">
                    {!! Form::label('message', __('superadmin::lang.message').':*') !!}
                    {!! Form::textarea('message', null, ['class' => 'form-control', 'required', 'rows' => 6]); !!}
                </div>

                <div class="col-md-12">
                    <div class="sa-form-actions">
                        <button type="submit" class="sa-btn-pill sa-btn-pill-primary" id="send_message">@lang('superadmin::lang.send')</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="sa-page-card">
        <div class="sa-page-card-header">
            <i class="fa fa-history"></i>
            <h3>@lang('superadmin::lang.message_history')</h3>
        </div>
        <div class="sa-page-card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="message-history">
                    <thead>
                        <tr>
                            <th>@lang('superadmin::lang.subject')</th>
                            <th>@lang('superadmin::lang.message')</th>
                            <th>@lang('lang_v1.date')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')

<script type="text/javascript">
	$(document).ready( function() {
		$('#send_message').click(function(e){
			e.preventDefault();
			if($('form#communication_form').valid()){
				swal({
	              title: LANG.sure,
	              icon: "warning",
	              buttons: true,
	              dangerMode: false,
	            }).then((sure) => {
	            	if(sure){
	            		$('form#communication_form').submit();
	            	} else {
	            		return false;
	            	}
	            });
	        }
		});

		$('#message-history').DataTable({
			dom:'lfrtip',
			processing: true,
			serverSide: true,
			ajax: '{{action("\Modules\Superadmin\Http\Controllers\CommunicatorController@getHistory")}}'
	    });
	});
</script>
@endsection
