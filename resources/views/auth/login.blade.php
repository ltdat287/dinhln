@extends('app')

@section('title', trans('labels.login_title'))

@section('content')

<section class="contents">
	<h2>{{ trans('labels.login_title') }}</h2>

	<section>
	   
	   @include('members.common.member_error', ['errors' => $errors])
	
		<form name="login" class="pure-form" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<fieldset class="pure-group">
				<input type="text" name="email" class="pure-input-1-4 required"
					placeholder="{{ trans('labels.email_placeholder') }}">
					@if ($errors->has('email'))
            			@foreach ($errors->get('email') as $error ) 
            			<section class="error-message">{{ $error }}</section>
            			@endforeach
            		@endif
				<input
					type="password" name="password" class="pure-input-1-4 required"
					placeholder="{{ trans('labels.password_placeholder') }}">
					@if ($errors->has('password'))
            			@foreach ($errors->get('password') as $error ) 
            			<section class="error-message">{{ $error }}</section>
            			@endforeach
            		@endif
			</fieldset>
			<button type="submit"
				class="pure-button pure-input-1-4 pure-button-primary">{{
				trans('labels.submit_button') }}</button>
		</form>
	</section>
</section>

@endsection
