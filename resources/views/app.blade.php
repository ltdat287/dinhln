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
		if (typeof($.cookie('cookieCheck')) == 'undefined') {
			var arrayCheck = [];
		} else {
			var arrayCheck = JSON.parse($.cookie('cookieCheck'));
			
			$('.check').each(function() {
				var checkedVal = $(this).val();
				if (arrayCheck.indexOf(checkedVal) >= 0) {
					$(this).attr('checked','checked');
				}
			});
		}

		//set value for array when click
		$('.check').click(function() {
			$('.check').each(function() {
				// 
				if ($(this).is(':checked')) {
					if (arrayCheck.indexOf($(this).val()) < 0) {
						arrayCheck.push($(this).val());
					}
				} else {
					if (arrayCheck.indexOf($(this).val()) >= 0) {
						arrayCheck.splice(arrayCheck.indexOf($(this).val()), 1);
					}
				}
			});
			$.removeCookie('cookieCheck');
			var JsonArray = JSON.stringify(arrayCheck);
			$.cookie('cookieCheck',JsonArray);
		});

		//send value from cookie to input hindden and send request to server
		$('#deletecheck').click(function() {
			//var Json2Array = JSON.parse($.cookie('cookieCheck'));
			$('.putValdel').val($.cookie('cookieCheck'));
			$.removeCookie('cookieCheck');
		});
	});

</script>
</footer>

</body>
</html>

