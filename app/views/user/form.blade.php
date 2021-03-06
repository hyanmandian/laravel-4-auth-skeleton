@if(isset($user))
	{{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT', 'class' => 'ajax-form')) }}
@else
	{{ Form::open(array('route' => 'user.store', 'method' => 'POST', 'class' => 'ajax-form')) }}
@endif
	
	<div class="form-group">
		{{ Form::label('first_name', 'First name') }}
		{{ Form::text('first_name') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('last_name', 'Last name') }}
		{{ Form::text('last_name') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
		<span class="form-message"></span>
	</div>

	<div class="form-group">
		{{ Form::label('password_confirmation', 'Password confirmation') }}
		{{ Form::password('password_confirmation') }}
		<span class="form-message"></span>
	</div>

	<span class="form-status"></span>
	
	{{ Form::submit('Save'); }}

{{ Form::close() }}

