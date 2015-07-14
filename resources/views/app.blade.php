<!DOCTYPE html>
<html lang="ja">
<head>
	<meta content="{{ trans('labels.meta_description') }}" name="description">
	<title>@yield('title'){{ trans('labels.main_title') }}</title>
	<link href="{{ ( Route::getCurrentRoute()->getName() == 'login' ) ? url('/login') : url('/') }}" rel="canonical">
	<link rel="stylesheet" href="{{ asset('/css/pure-min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
	<script type="text/javascript" src="{{ asset('/js/jquery.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('/js/jquery.cookie.js') }}" ></script>

</head>
<body>
<header>
	<nav class="home-menu pure-menu pure-menu-horizontal relative">
		<h1 class="pure-menu-heading"><a href="{{ url('/') }}">{{ trans('labels.menu_heading') }}</a></h1>
		
		@include('common.navigation')
	</nav>
</header>

@yield('content')

<footer>
{{ trans('labels.footer_label') }}

<script>
	$(document).ready(function(){
		$(".checkbox").click(function(){
			alert($("#check").val());
		});
	});
</script>
</footer>

</body>
</html>

