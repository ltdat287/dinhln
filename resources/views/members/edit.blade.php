@extends('app')

@section('content')

<section class="contents">
	<h2>{{ trans('labels.member_detail') }}</h2>

	<section>
        @include('members.common.member_error', ['errors' => $errors])
        
        <form name="editMember" class="pure-form pure-u-3-4" method="post" action="{{ url('/member/' . $id . '/edit/conf') }}">
		<table class="pure-table pure-table-bordered" width="100%">
			<tbody>
				<tr>
					<th>{{ trans('labels.id') }}</th>
					<td>{{ $id }}</td>
				</tr>
				
				@include('members.common.member_form', ['errors' => $errors])
				
				<tr>
					<td colspan="2" align="right">
						<a class="pure-button pure-button-primary" href="{{ url('member/' . $id . '/detail') }}">{{ trans('labels.back') }}</a>
						<button class="pure-button button-error" name="submit" type="submit">{{ trans('labels.confirm') }}</button>
					</td>
				</tr>
			</tbody>
		</table>
		</form>
        
    </section>
</section>

@endsection
