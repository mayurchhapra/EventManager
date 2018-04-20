@extends('layouts.master')

@section('title','login')

@section('content')
	
	<div class="card">
		<div class="card-header"><h2><b>Login</b></h2> </div>
			<div class="card-body">
				<form action="{{ route('authenticate') }}" method='post'>
					{{ csrf_field() }}

					@if(app('request')->input('error'))
					<div class="alert alert-danger">
						Double check Username and Password...
					</div>
					@endif
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control">  
					</div>
					<div  class='form-group'>
						<label>Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class='form-group'>
						<center><input type="submit" Value="Sign in!" class="btn-lg btn-info"></center>
					</div>
				</form>
			</div>
		</div>

@stop