@extends('app')

@section('title', trans('labels.add_title'))

@section('content')

<section class="contents">
	<h2>{{ trans('labels.member_add') }}</h2>
<div id="testcode"></div>
	<section>
        @include('members.common.member_error', ['errors' => $errors])
        
		<form name="addMember" class="pure-form pure-u-3-4" method="post" action="{{ url('/add/conf') }}">
		<meta name="_token" content="{!! csrf_token() !!}"/>
		<table class="pure-table pure-table-bordered" width="100%">
			<tbody>
                
                @include('members.common.member_form', ['errors' => $errors])
				
				<tr>
					<td colspan="2" align="right">
						<a class="pure-button pure-button-primary" href="{{ url('/search') }}">{{ trans('labels.to_search') }}</a>
						<button class="pure-button button-error" name="submit" type="submit">{{ trans('labels.confirm') }}</button>
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	</section>
</section>

@endsection

@section('body.js')
<script type="text/javascript">
	(function ($) {
		$(document).ready(function() {

			$.ajaxSetup({
			   	headers: { 'X-CSRF-Token' : $('meta[name="_token"]').attr('content') }
			});
			//Check fields when .keyup() events
			// var delay = (function(){
			//   	var timer = 0;
			//   		return function(callback, ms){
			//     	clearTimeout (timer);
			//     	timer = setTimeout(callback, ms);
			//   	};
			// })();
			
			var name = $('input[name="name"]').val();
			var kana = $('input[name="kana"]').val();
			var email = $('input[name="email"]').val();
			var email_conf = $('input[name="email_confirmarion"]').val();
			var phone = $('input[name="telephone_no"]').val();
			var birthday = $('input[name="birthday"]').val();

			var formData = {
				var name = $('input[name="name"]').val();
				var kana = $('input[name="kana"]').val();
				var email = $('input[name="email"]').val();
				var email_conf = $('input[name="email_confirmarion"]').val();
				var phone = $('input[name="telephone_no"]').val();
				var birthday = $('input[name="birthday"]').val();
			};
			$('#name').on('change', function () {

				var timeOut = setTimeout(function () {
					var name = $('#name').val();

				    $.ajax({
				    	
						url: '{{ url('/add/test') }}',
						type: 'POST',
						data: name,
						success: function(data){
							var getdata = $.parseJSON(JSON.stringify(data));
							alert(getdata.name);
						},
						error: function (){
							console.log('data');
						}
					});	
				}, 2000);

			$(name).on('change', function() {
				var name = $(this.name).val();
				$.ajax ({
					url: '{{ url('/add/test') }}',
					type: 'POST',
					data: name,
					success: function() {

					}
				})
			});

			//
			$.useAjaxaddMember = function () {
				this.username = 'input[name="name"]';
				this.userkana = 'input[name="kana"]';
				this.useremail = 'input[name="email"]';
				this.useremail_conf = 'input[name="email_confirmarion"]';
				this.userphone = 'input[name="telephone_no"]';
				this.userbirthday = 'input[name="birthday"]';
			}

			});


			

			// $('').keydown(function() {
			// 	setTimeout(alert('test code'),10000);

			// });
		});
	}) (jQuery);
</script>
@endsection