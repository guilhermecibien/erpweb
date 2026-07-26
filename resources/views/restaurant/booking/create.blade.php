<div class="modal fade" id="add_booking_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

		@php
		$__f1 = ['options' => ['url' => action('Restaurant\BookingController@store'), 'method' => 'post', 'id' => 'add_booking_form' ]];
		@endphp
		<x-form.open :options="$__f1['options']" />
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@lang( 'restaurant.add_booking' )</h4>
				</div>

				<div class="modal-body">
					@if(count($business_locations) == 1)
						@php 
							$default_location = current(array_keys($business_locations->toArray())) 
						@endphp
					@else
						@php $default_location = null; @endphp
					@endif
					<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-map-marker"></i>
								</span>
								@php
								$__f2 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => $default_location, 'options' => ['class' => 'form-control', 'placeholder' => __('purchase.business_location'), 'required', 'id' => 'booking_location_id']];
								@endphp
								<x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								@php
								$__f3 = ['name' => 'contact_id', 'list' => $customers, 'selected' => null, 'options' => ['class' => 'form-control', 'id' => 'booking_customer_id', 'placeholder' => __('contact.customer'), 'required']];
								@endphp
								<x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
								<span class="input-group-btn">
									<button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""  @if(!auth()->user()->can('customer.create')) disabled @endif><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
								</span>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								@php
								$__f4 = ['name' => 'correspondent', 'list' => $correspondents, 'selected' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Responsável', 'id' => 'correspondent']];
								@endphp
								<x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div id="restaurant_module_span"></div>
					<div class="clearfix"></div>
					<div class="col-sm-6">
						<div class="form-group">
						@php
						$__f5 = ['name' => 'status', 'value' => __('restaurant.start_time') . ':*'];
						@endphp
						<x-form.label :name="$__f5['name']" :value="$__f5['value']" />
	            			<div class='input-group date' >
	            			<span class="input-group-addon">
	                    		<span class="glyphicon glyphicon-calendar"></span>
	                		</span>
							@php
							$__f6 = ['name' => 'booking_start', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => __( 'restaurant.start_time' ), 'required', 'id' => 'start_time', 'readonly']];
							@endphp
							<x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							@php
							$__f7 = ['name' => 'status', 'value' => 'Hora de finalização' . ':*'];
							@endphp
							<x-form.label :name="$__f7['name']" :value="$__f7['value']" />
	            			<div class='input-group date' >
	            			<span class="input-group-addon">
	                    		<span class="glyphicon glyphicon-calendar"></span>
	                		</span>
							@php
							$__f8 = ['name' => 'booking_end', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Hora de finalização', 'required', 'id' => 'end_time', 'readonly']];
							@endphp
							<x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
						@php
						$__f9 = ['name' => 'booking_note', 'value' => 'Observação' . ':'];
						@endphp
						<x-form.label :name="$__f9['name']" :value="$__f9['value']" />
						@php
						$__f10 = ['name' => 'booking_note', 'value' => null, 'options' => ['class' => 'form-control','placeholder' => 'Observação', 'rows' => 3 ]];
						@endphp
						<x-form.textarea :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
						</div>
					</div>
					<div class="col-sm-12" style="visibility: hidden;">
						<div class="form-group">
						<div class="checkbox">
							@php
							$__f11 = ['name' => 'send_notification', 'value' => 1, 'checked' => false, 'options' => ['class' => 'input-icheck', 'id' => 'send_notification']];
							@endphp
							<x-form.checkbox :name="$__f11['name']" :value="$__f11['value']" :checked="$__f11['checked']" :options="$__f11['options']" /> @lang('restaurant.send_notification_to_customer')
						</div>
					</div>
				</div>
				</div>

				<div class="modal-footer">
				<button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
			</div>

		<x-form.close />

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>