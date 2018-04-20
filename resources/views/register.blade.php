@extends('layouts.master')

@section('title','Register')

@section('content')
<br>
	<div class="card">
		<div class="card-header"><h2><b>User Registration</b></h2> </div>
		<div class="card-body">

			<form action="{{ route('register/save') }}" method='post'>
				 {{ csrf_field() }}
				<div class='form-group'>
					<label>Name:</label>
					<input type="text" name="name" class='form-control'>
				</div>
				<div class='form-group'>
					<label>Email:</label>
					<input type="email" name="email" class="form-control">
				</div>
				<div class='form-group'>
					<label>Contact:</label>
					<input type="number" name="contact" class="form-control">
				</div>
				<div class='form-group'>
					<label>Gender: </label>
					<input type="radio" name="gender" value='male' checked> Male
					<input type="radio" name="gender" value='female'> Female
				</div>
				<div class='form-group'>
					<label>Date of Birth:</label>
					<input type="date" name="date_of_birth" class="form-control">
				</div>
				<div class='form-group'>
					<label>Password:</label>
					<input type="Password" name="password" class="form-control">
				</div>
				<div class='form-group'>
					<label>Confirm Password:</label>
					<input type="Password" class="form-control">
				</div>
				<div class='form-group'>
					<center><input type="submit" Value="Sign Up!" class="btn-lg btn-info"></center>
				</div>
				
			</form>
		</div>
	</div>

@stop