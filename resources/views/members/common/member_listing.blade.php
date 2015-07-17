<section>
	<table class="pure-table pure-table-bordered">
		<thead>
			<tr>
				<th>{{ trans('labels.id') }}</th>
				<th>{{ trans('labels.name') }}</th>
				<th>{{ trans('labels.email') }}</th>
				<th>{{ trans('labels.telephone_no') }}</th>
				<th>{{ trans('labels.birthday') }}</th>
				<th>{{ trans('labels.updated_at') }}</th>
				<th>{{ trans('labels.role') }}</th>
				@if (MemberHelper::getCurrentUserRole() == 'admin' OR MemberHelper::getCurrentUserRole() == 'boss')
				<th>{{ trans('labels.role') }}</th>
				@endif
			</tr>

		</thead>
		<tbody>
            @foreach ($users as $i => $user)
            <tr {{ (($i % 2) == 0) ? '' : 'class=pure-table-odd' }}>
				<td>{{{ $user->id }}}</td>
				<td><a href="{{ url('/member/' . $user->id . '/detail') }}">{{{ $user->name }}}({{{ $user->kana }}})</a></td>
				<td>{{{ $user->email }}}</td>
				<td>{{{ $user->telephone_no }}}</td>
				<td>{{{ $user->birthday }}}</td>
				<td>{{{ $user->updated_at }}}</td>
				<td>{{{ $user->getFirstRole()->name or '' }}}</td>
				@if (MemberHelper::getCurrentUserRole() == 'admin' OR MemberHelper::getCurrentUserRole() == 'boss')
				<td><div class="checkbox"><label><input type="checkbox" name="check[]" class="checkMembers" value="{{ $user->id }}"/>&nbsp;Select</label></div></td>
				@endif
			</tr>
            @endforeach
		</tbody>
	</table>
</section>