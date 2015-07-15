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
		
		// if ($.cookie('valueCheck')) {
		// 		arrayCheck.concat($.cookie('valueCheck'));
		// 	}
		// 	
		
		// Get checked ids from cookie
		var arrayCheck = $.cookie('cookieCheck');

		// Set checked for checkboxes exists ids in cookie.
		if (typeof(arrayCheck) == 'undefined') {
			var arrayCheck = [];
		}
		$(".check").each(function () {
			var checkedVal = $(this).val();
			if (arrayCheck.indexOf(checkedVal) >= 0) {
				$(this).attr('checked', 'checked');
			}
		});

		// Bind event for checked change checboxes.
		$(".check").click(function(){
			console.log(arrayCheck);
			$('.check').each(function() {
				if ($(this).is(':checked')) {
					arrayCheck.push($(this).val());
				}
			});
			$.cookie('cookieCheck',arrayCheck);
			
			//var arrayCheck = [];
			//$('.check:checked').each(function() {
				//var currentVal = $(this).val();
				//if (arrayCheck.indexOf(currentVal) < 0) {
					//arrayCheck.push(currentVal);
				//}
				
			//});
			// $.cookie('valueCheck',arrayCheck);
		});
		// $('a').click(function() {
			
		// });
	});
</script>
</footer>

</body>
</html>

