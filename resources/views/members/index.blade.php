@extends('app')

@section('content')

<section class="contents">
	<h2>{{ trans('labels.member_index') }}</h2>

	@include('members.common.member_paginate', ['users' => $users])
	
	@include('members.common.member_listing', ['users' => $users])

	@include('members.common.member_paginate', ['users' => $users])
	
</section>

@endsection
