@extends('app')

@section('title', trans('labels.add_title'))

@section('content')

<section class="contents">
	<h2>{{ trans('labels.member_add') }}</h2>
<div id="testcode">aDasdASDa</div>
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
			// Check fields when .keyup() events
			// var delay = (function(){
			//   	var timer = 0;
			//   		return function(callback, ms){
			//     	clearTimeout (timer);
			//     	timer = setTimeout(callback, ms);
			//   	};
			// })();
			
			// var name = $('input[name="name"]').val();
			// var kana = $('input[name="kana"]').val();
			// var email = $('input[name="email"]').val();
			// var email_conf = $('input[name="email_confirmarion"]').val();
			// var phone = $('input[name="telephone_no"]').val();
			// var birthday = $('input[name="birthday"]').val();

			
			// $('#dlt_name').on('change', function () {

			// 	var timeOut = setTimeout(function () {
			// 		var name = $('#dlt_name').val();

			// 	    $.ajax({
				    	
			// 			url: '{{ url('/add/test') }}',
			// 			type: 'POST',
			// 			data: name,
			// 			success: function(data){
			// 				var getdata = $.parseJSON(JSON.stringify(data));
			// 				alert(getdata.name);
			// 			},
			// 			error: function (){
			// 				console.log('data');
			// 			}
			// 		});	
			// 	}, 2000);

			// });
			var AjaxMember = new $.useAjaxaddMember();
			AjaxMember.checkMemberAftertype();

		});
		$.useAjaxaddMember = function () {
			this.username = '#dlt_name';
			this.userkana = '#dlt_kana';
			this.useremail = '#dlt_email';
			this.useremail_conf = '#dlt_emailconf';
			this.userphone = '#dlt_phone';
			this.userbirthday = '#dlt_birth';
			this.userpass = '#dlt_password';
		}

		$.useAjaxaddMember.prototype.checkMemberAftertype = function () {
			var self = this;

			$(this.username).on('change', function() {
				var timeOut = setTimeout(function() {

					var valueInput = $(self.username).val();
					$.ajax({
						url: '{{ url('/add/test') }}',
						type: 'POST',
						data: valueInput,
					})
					.done(function (data) {
						// console.log(data);
						$('#testcode').html('');
						var JsondecodeData = $.parseJSON(JSON.stringify(data));
						$('#testcode').append(JsondecodeData.name);
					})
					.fail(function () {
						alert('Ajax faile fetch data');
					});
				}, 2000);
			});
		}
	}) (jQuery);
</script>
@endsection