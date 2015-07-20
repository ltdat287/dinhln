@extends('app')

@section('title', trans('labels.add_title'))

@section('content')
<section class="contents">
	<h2>{{ trans('labels.member_add_conf') }}</h2>

	<section>
		<form name="addMemberConfirm" method="post" action="{{ url('add/comp') }}">
		<table class="pure-table pure-table-bordered" width="100%">
			<tbody>
			
				@include('members.common.member_infor', ['user' => $user, 'role' => $role, 'boss' => $boss])
				
				<tr>
					<td colspan="2" align="right">
						<button class="pure-button pure-button-primary" name="back" type="submit">{{ trans('labels.back') }}</button>
						<button class="pure-button button-error" name="submit" type="submit">{{ trans('labels.submit') }}</button>
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	</section>
</section>
@endsection

