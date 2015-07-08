@extends('app')

@section('content')

<section class="contents">
	<h2>{{ trans('labels.search') }}</h2>

	<section>
        @include('members.common.member_error', ['errors' => $errors])
        
		<form name="search" class="pure-form" method="get" action="{{ url('/search') }}">
		<table class="pure-table pure-table-bordered">
			<tbody>
				<tr>
					<td>{{ trans('labels.name') }}</td>
					<td><input type="text" name="name" value="{{ Input::old('name') }}"></td>
					<td>{{ trans('labels.email') }}</td>
					<td><input type="text" name="email" value="{{ Input::old('email') }}"></td>
				</tr>
				<tr>
					<td>{{ trans('labels.kana') }}</td>
					<td><input type="text" name="kana" value="{{ Input::old('kana') }}"></td>
					<td>{{ trans('labels.telephone_no') }}</td>
					<td><input type="text" name="telephone_no" value="{{ Input::old('telephone_no') }}"></td>
				</tr>
				<tr>
					<td>{{ trans('labels.birthday') }}</td>
					<td colspan="3">
						<input type="text" name="start_date" value="{{ Input::old('start_date') }}" placeholder="{{ trans('labels.start_date') }}">
						&nbsp;～&nbsp;
						<input type="text" name="end_date" value="{{ Input::old('end_date') }}" placeholder="{{ trans('labels.end_date') }}">
					</td>
				</tr>
				@if (MemberHelper::getCurrentUserRole() == 'admin')
				<tr>
					<td>{{ trans('labels.role') }}</td>
					<td colspan="3" align="center">
						<ul class="pure-menu-list pure-menu-horizontal">
                            @foreach ($roles as $role)
                            <li class="pure-menu-item pure-u-1-6">
                                <label for="{{ $role->slug }}"><input {{ (Input::has($role->slug) && Input::has($role->slug) == '1') ? 'checked=checked' : '' }} type="checkbox" id="{{ $role->id }}" name="{{ $role->slug }}" value="1">{{ $role->name }}</label>
                            </li>
                            @endforeach
						</ul>
					</td>
				</tr>
				@endif
				<tr>
					<td colspan="4" align="right">
						<button class="pure-button pure-button-primary" type="submit">{{ trans('labels.search') }}</button>
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	</section>
	
	@if (count($users))
	
    	@include('members.common.member_paginate', ['users' => $users])
    	
    	@include('members.common.member_listing', ['users' => $users])
    
    	@include('members.common.member_paginate', ['users' => $users])
	
	@endif
</section>

<section>
    @if (! count($users))
        <p class="error-box">{{ trans('labels.no_result_search') }}</p>
    @endif
</section>

@endsection
