@extends('app')

@section('content')

<section class="contents">
	<h2>{{ $label }}</h2>

	<section>
		<p>
			{!! $message !!}
		</p>
		<div>
			<a class="pure-button pure-button-primary" href="{{ url('/search') }}">{{ trans( 'labels.to_search' ) }}</a>
		</div>
	</section>
</section>


@endsection
