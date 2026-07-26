<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Detalhes</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<strong>@lang('contact.customer'):</strong> {{ $booking->customer->name }}<br>
						<strong>Grupo de serviço:</strong> {{ $booking->waiter->user_full_name ?? '--' }}<br>
						<strong>Responsável:</strong> {{ $booking->correspondent->user_full_name ?? '--' }}<br>
						@if(!empty($booking->booking_note))
						<strong>@lang('restaurant.customer_note'):</strong> {{ $booking->booking_note }}
						@endif
					</div>
					<div class="col-sm-6">
						<strong>@lang('messages.location'):</strong> {{ $booking->location->name }}<br>
						<strong>@lang('restaurant.table'):</strong> {{ $booking->table->name ?? '--' }}<br>
						<strong>Inicio de reserva:</strong> {{ $booking_start }}<br>
						<strong>Final da reserva:</strong> {{ $booking_end }}
					</div>
				</div>
				<br>
				<hr>
				<div class="row" style="visibility: hidden;">
					<div class="col-sm-12">
						<button type="button" class="btn btn-info btn-modal pull-right" data-href="{{action('NotificationController@getTemplate', ['transaction_id' => $booking->id,'template_for' => 'new_booking'])}}" data-container=".view_modal">@lang('restaurant.send_notification_to_customer')</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-9">
						@php
						$__f1 = ['options' => ['url' => action('Restaurant\BookingController@update', [$booking->id]), 'method' => 'PUT', 'id' => 'edit_booking_form' ]];
						@endphp
						<x-form.open :options="$__f1['options']" />
							<div class="input-group">
				                <!-- /btn-group -->
				                @php
				                $__f2 = ['name' => 'booking_status', 'list' => $booking_statuses, 'selected' => $booking->booking_status, 'options' => ['class' => 'form-control', 'placeholder' => __('restaurant.change_booking_status'), 'required']];
				                @endphp
				                <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
				                <div class="input-group-btn">
				                  <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
				                </div>
				             </div>
						<x-form.close />
					</div>
					<div class="col-sm-3 text-center">
						<button type="button" class="btn btn-danger" id="delete_booking" data-href="{{action('Restaurant\BookingController@destroy', [$booking->id])}}">Remover reserva</button>
					</div>
				</div>
			<br>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
			</div>
		

	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->