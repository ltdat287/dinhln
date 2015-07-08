@extends('app')

@section('title', trans('labels.error_title'))

@section('content')

<section class="contents">
	<h2>{{ trans('labels.error_title') }}</h2>

	<sction class="error-box">
    	<h3>System error</h3>
    	<ul>
    	@foreach ($errors as $error)
        	<?php 
            // Write error to log.
            Log::error($error);
            ?>
    		<li>{{ trans('labels.error_prefix') }}{{ $error }}</li>
    	@endforeach
    	</ul>
</section>
</section>

@endsection
