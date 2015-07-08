<tr>
	<th {{ $errors->has('name') ? "class=error-cell" : '' }} >{{ trans('labels.name') }}</th>
	<td>
		<input type="text" name="name" value="{{ MemberHelper::getOld('name') }}" class="pure-input-1">
		@if ($errors->has('name'))
			@foreach ($errors->get('name') as $error ) 
			<section class="error-message">{{ $error }}</section>
			@endforeach
		@endif
	</td>
</tr>
<tr>
	<th {{ $errors->has('kana') ? "class=error-cell" : '' }} >{{ trans('labels.kana') }}</th>
	<td>
		<input type="text" name="kana" value="{{ MemberHelper::getOld('kana') }}" class="pure-input-1">
		@if ($errors->has('kana'))
			@foreach ($errors->get('kana') as $error ) 
			<section class="error-message">{{ $error }}</section>
			@endforeach
		@endif
	</td>
</tr>
@if (MemberHelper::getCurrentUserRole() != 'employ')
<tr>
	<th {{ $errors->has('email') ? "class=error-cell" : '' }} >{{ trans('labels.email') }}</th>
	<td>
	   <input type="text" name="email" value="{{ MemberHelper::getOld('email') }}" class="pure-input-1">
		@if ($errors->has('email'))
			@foreach ($errors->get('email') as $error ) 
			<section class="error-message">{{ $error }}</section>
			@endforeach
		@endif
	</td>
</tr>
<tr>
	<th {{ $errors->has('email_confirmation') ? "class=error-cell" : '' }} >{{ trans('labels.email_conf') }}</th>
	<td>
	   <input type="text" name="email_confirmation" value="{{ MemberHelper::getOld('email_confirmation') }}" class="pure-input-1">
		@if ($errors->has('email_confirmation'))
			@foreach ($errors->get('email_confirmation') as $error ) 
			<section class="error-message">{{ $error }}</section>
			@endforeach
		@endif
	</td>
</tr>
@endif
<tr>
	<th {{ $errors->has('telephone_no') ? "class=error-cell" : '' }} >{{ trans('labels.telephone_no') }}</th>
	<td>
		<input type="text" name="telephone_no" value="{{ MemberHelper::getOld('telephone_no') }}" class="pure-input-1">
		@if ($errors->has('telephone_no'))
			@foreach ($errors->get('telephone_no') as $error ) 
			<section class="error-message">{{ $error }}</section>
			@endforeach
		@endif
	</td>
</tr>
<tr>
	<th {{ $errors->has('birthday') ? "class=error-cell" : '' }} >{{ trans('labels.birthday') }}</th>
	<td>
		<input type="text" name="birthday" value="{{ MemberHelper::getOld('birthday') }}" class="pure-input-1">
		@if ($errors->has('birthday'))
			@foreach ($errors->get('birthday') as $error ) 
			<section class="error-message">{{ $error }}</section>
			@endforeach
		@endif
	</td>
</tr>
@if (MemberHelper::getCurrentUserRole() != 'employ')
<tr>
	<th {{ $errors->has('note') ? "class=error-cell" : '' }} >{{ trans('labels.note') }}</th>
	<td>
		<textarea name="note" class="pure-input-1">{{ MemberHelper::getOld('note') }}</textarea>
		@if ($errors->has('note'))
			@foreach ($errors->get('note') as $error ) 
			<section class="error-message">{{ $error }}</section>
			@endforeach
		@endif
	</td>
</tr>
@endif
<tr>
	<th {{ $errors->has('password') ? "class=error-cell" : '' }} >{{ trans('labels.password') }}</th>
	<td>
		<input type="password" name="password" class="pure-input-1">
		@if ($errors->has('password'))
			@foreach ($errors->get('password') as $error ) 
			<section class="error-message">{{ $error }}</section>
			@endforeach
		@endif
	</td>
</tr>
@if (MemberHelper::getCurrentUserRole() == 'admin')
<tr>
	<th>{{ trans('labels.role') }}</th>
	<td>
		<select autocomplete="off" name="use_role" class="pure-input-1">
            @foreach ($roles as $role)
                @if ($user != null)
                <option value="{{ $role->slug }}" {{ ($user->getFirstRole() && $user->getFirstRole()->slug == $role->slug) ? "selected=selected" : '' }} >{{{ $role->name }}}</option>
                @else
                <option value="{{ $role->slug }}" >{{{ $role->name }}}</option>
                @endif
            @endforeach
		</select>
	</td>
</tr>
<tr>
	<th {{ $errors->has('boss_id') ? "class=error-cell" : '' }} >BOSS</th>
	<td>
		<select autocomplete="off" name="boss_id" class="pure-input-1">
			<option value="0">{{ trans('labels.no_option') }}</option>
			@foreach($bosses as $boss)
			<option value="{{{ $boss->id }}}" {{ (MemberHelper::getOld('boss_id') == $boss->id) ? "selected" : '' }}>{{{ $boss->name }}}</option>
			@endforeach
		</select>
		@if ($errors->has('boss_id'))
			@foreach ($errors->get('boss_id') as $error ) 
			<section class="error-message">{{ $error }}</section>
			@endforeach
		@endif
	</td>
</tr>
@endif