@extends('app')

@section('content')

<section class="contents">
	<h2>{{ trans('labels.member_detail') }}</h2>
	
	<section>
		<table name="memberDetail" class="pure-table pure-table-bordered" width="100%">
			<tbody>
				<tr>
					<th>{{ trans('labels.id') }}</th>
					<td>{{{ $id }}}</td>
				</tr>
				
				@include('members.common.member_infor', ['user' => $user, 'role' => $role, 'boss' => $boss])
				
				<tr>
					<td colspan="2" align="right">
					    @if (MemberHelper::getCurrentUserRole() != 'employ')
						<a class="pure-button pure-button-primary" href="{{ url('/search') }}">{{ trans('labels.to_search') }}</a>
						@endif
						@if (MemberHelper::showEditButton($id))
						<a class="pure-button button-secondary" href="{{ url('/member/' . $user->id . '/edit') }}">{{ trans('labels.edit') }}</a>
						@endif
						@if (MemberHelper::getCurrentUserRole() != 'employ')
						<a class="pure-button button-error" href="{{ url('/member/' . $user->id . '/delete/conf') }}">{{ trans('labels.delete') }}</a>
						@endif
					</td>
				</tr>
			</tbody>
		</table>
	</section>
</section>

@endsection
