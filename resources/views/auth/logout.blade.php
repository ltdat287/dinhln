@extends('app')

@section('title', trans('labels.logout_title'))

@section('content')

<section class="contents">
	<h2>{{ trans('labels.logout') }}</h2>

	<section>
		<p>
			{{ trans('labels.logout_message') }}
		</p>
	</section>
</section>

@endsection
