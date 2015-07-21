<!DOCTYPE html>
<html lang="ja">
<head>
	<meta content="{{ trans('labels.meta_description') }}" name="description">
	<title>@yield('title'){{ trans('labels.main_title') }}</title>
	<link href="{{ ( Route::getCurrentRoute()->getName() == 'login' ) ? url('/login') : url('/') }}" rel="canonical">
	<link rel="stylesheet" href="{{ asset('/css/pure-min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
	<script type="text/javascript" src="{{ asset('/assets/jquery/jquery.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('/assets/jquery.cookie/jquery.cookie.js') }}" ></script>

	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

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
</footer>
<script type="text/javascript" src="{{ asset('/js/getcheckbox.js') }}"></script>
@yield('body.js')
</body>
</html>

