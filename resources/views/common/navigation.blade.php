<?php
$user      = MemberHelper::checkLogin();
$arrLinks  = array();
$name      = null;
$routeName = Route::currentRouteName();

if (! $user)
{
    $arrLinks = array(
        url('/login') => trans('labels.login')
    );
}
else
{
    $role = $user->getFirstRole();
    $role = ($role) ? $role->slug : '';
    switch ($role)
    {
        case 'admin':
            $name     = $user->name . '(' . trans('labels.admin') . ')';
            $arrLinks = array(
                url('/search') => trans('labels.search'),
                url('/add')    => trans('labels.add'),
                url('/logout') => trans('labels.logout')
            );
            break;
        case 'boss':
            $name     = $user->name;
            $arrLinks = array(
                url('/search') => trans('labels.search'),
                url('/add')    => trans('labels.add'),
                url('/logout') => trans('labels.logout')
            );
            break;
        case 'employ':
            $name     = $user->name;
            $arrLinks = array(
                url('/logout') => trans('labels.logout')
            );
            break;
    }
}
?>
@if (count($arrLinks) && $routeName != 'login')
<ul class="pure-menu-list force-right">
    @if ($name)
    <li class="pure-menu-item"><span class="pure-menu-link">{{ $name }}</span></li>
    @endif
    
    @foreach ($arrLinks as $link => $label)
	<li class="pure-menu-item"><a href="{{ $link }}" class="pure-menu-link">{{ $label }}</a></li>
	@endforeach
</ul>
@endif