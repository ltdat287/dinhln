@extends('app')

@section('content')

<section class="contents">
	<h2>{{ trans('labels.member_edit_conf') }}</h2>

	<section>
		<form name="editConfirmMemeber" method="post" action="{{ url('member/' . $id . '/edit/comp') }}">
		<table class="pure-table pure-table-bordered" width="100%">
			<tbody>
			    <tr>
					<th>{{ trans('labels.id') }}</th>
					<td>{{{ $id }}}</td>
				</tr>
			
				@include('members.common.member_infor', ['user' => $user])
				
				<tr>
					<td colspan="2" align="right">
						<a class="pure-button pure-button-primary" name="back" type="button" href="{{ url('member/' . $id . '/edit') }}">{{ trans('labels.back') }}</a>
						<button class="pure-button button-error" name="submit" type="submit">{{ trans('labels.submit') }}</button>
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	</section>
</section>

@endsection
