@extends('layouts.master')

@section('content')

	@if(app('request')->input('save'))
	<div class="alert alert-success">
		Your Event saved Successfully.
	</div>
	@endif

	<div class="card">
		<div class="card-header"><h3>Register Event</h3> </div>
		<div class="card-body">

			<form method="post" action="{{ route('eventSave') }}">
				@csrf
				<div class="form-group">
					<label>Event:</label>
					<select class=" form-control" name='task'>
						<option value='Birthday'>Birthday</option>
						<option value="Reminder">Reminder</option>
						<option value="Meeting">Meeting</option>
					</select>
				</div>

				<div class="form-group">
					<label>Date:</label>
					<input type="date" name="date_of_event" class="form-control">
				</div>

				<div class="form-group">
					<label>Discription:</label>
					<textarea class="form-control" name='desc'></textarea>
				</div>
				<div class="form-group">
					<center><input type="submit" value='Add' class="btn-lg btn-info"></center>
				</div>
				
			</form>
		</div>
			
		</div>
	</div>
@stop