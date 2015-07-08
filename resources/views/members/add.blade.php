@extends('app')

@section('title', trans('labels.add_title'))

@section('content')

<section class="contents">
	<h2>{{ trans('labels.member_add') }}</h2>

	<section>
        @include('members.common.member_error', ['errors' => $errors])
        
		<form name="addMember" class="pure-form pure-u-3-4" method="post" action="{{ url('/add/conf') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table class="pure-table pure-table-bordered" width="100%">
			<tbody>
                
                @include('members.common.member_form', ['errors' => $errors])
				
				<tr>
					<td colspan="2" align="right">
						<a class="pure-button pure-button-primary" href="{{ url('/search') }}">{{ trans('labels.to_search') }}</a>
						<button class="pure-button button-error" name="submit" type="submit">{{ trans('labels.confirm') }}</button>
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	</section>
</section>

@endsection