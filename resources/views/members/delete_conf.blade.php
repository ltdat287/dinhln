@extends('app')

@section('content')

<section class="contents">
	<h2>{{ trans('labels.member_delete_conf') }}</h2>

	<section>
	   @if (! $errors)
	       <p>{{ trans('labels.member_delete_notice') }}</p>
	   @else
	       @include('members.common.member_error', ['errors' => $errors])
	   @endif
	   
	   <form method="post" action="{{ url('member/' . $id . '/delete/comp') }}" >
		<table class="pure-table pure-table-bordered" width="100%">
			<tbody>
				<tr>
					<th>{{ trans('labels.id') }}</th>
					<td>{{{ $id }}}</td>
				</tr>
			
				@include('members.common.member_infor', ['user' => $user])
				
				<tr>
					<td colspan="2" align="right">
						<a class="pure-button pure-button-primary" name="back" type="button" href="{{ url('member/' . $id . '/detail') }}">{{ trans('labels.back') }}</a>
						@if (! count($errors))
						<button class="pure-button button-error" name="submit" type="submit">{{ trans('labels.run') }}</button>
						@endif
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	   
	</section>
</section>

@endsection
