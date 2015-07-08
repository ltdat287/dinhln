<tr>
	<th>{{ trans('labels.name') }}</th>
	<td>{{ $user->name }}</td>
</tr>
<tr>
	<th>{{ trans('labels.kana') }}</th>
	<td>{{ $user->kana }}</td>
</tr>
@if (MemberHelper::getCurrentUserRole() != 'employ' && Route::currentRouteName() == 'edit_comp')
<tr>
	<th>{{ trans('labels.email') }}</th>
	<td>{{ $user->email }}</td>
</tr>
@endif
<tr>
	<th>{{ trans('labels.telephone_no') }}</th>
	<td>{{ $user->telephone_no }}</td>
</tr>
<tr>
	<th>{{ trans('labels.birthday') }}</th>
	<?php 
	   $birthday = new \Carbon($user->birthday);
	?>
	<td>{{ $birthday->format('Y/m/d') }}</td>
</tr>
@if (MemberHelper::getCurrentUserRole() != 'employ')
    <tr>
    	<th>{{ trans('labels.note') }}</th>
    	<td><?php echo nl2br($user->note)?></td>
    </tr>
    @if (MemberHelper::getCurrentUserRole() == 'admin' || ($role && $role->slug == 'employ'))
        <tr>
            <th>{{ trans('labels.role') }}</th>
            <td>{{ $role->name }}</td>
        </tr>
        <tr>
        	<th>{{ trans('labels.boss') }}</th>
        	@if ($boss)
        	<td>{{ $boss->name }}</td>
        	@else
        	<td>{{ trans('labels.no_option') }}</td>
            @endif
        </tr>
    @endif
    
    @if (MemberHelper::getCurrentUserRole() != 'employ' && isset($user->updated_at))
        <tr>
            <th>{{ trans('labels.updated_at') }}</th>
            <td>{{ $user->updated_at }}</td>
        </tr>
    @endif
@endif