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

			// function showValues(dlt_parameter) {
				var valName = $("form[name='addMember']").serializeArray();
				// var Jsonencode = JSON.stringify(valName);
				// $.useAjaxaddmember.username = 
				var data = {};
				$(valName).each(function(index,obj) {
					data[obj.name] = obj.value;
				});
				// console.log(data);
			// }

			var AjaxMember = new $.useAjaxaddMember();
			// AjaxMember.username = data.name;
			// AjaxMember.userkana = data.kana;
			// AjaxMember.useremail = data.email;
			// AjaxMember.useremail_conf = data.email_confirmation;
			// AjaxMember.userphone = data.telephone_no
			// AjaxMember.userbirthday = data.birthday;
			// AjaxMember.userpass = data.password;

		});

		/**
		 * Add new object with properties constructor
		 * @return {[type]} [description]
		 */
		$.useAjaxaddMember = function () {
			this.username = '#dlt_name';
			this.userkana = '#dlt_kana';
			this.useremail = '#dlt_email';
			this.useremail_conf = '#dlt_emailconf';
			this.userphone = '#dlt_phone';
			this.userbirthday = '#dlt_birth';
			this.userpass = '#dlt_password';

			this.checkMemberAftertype(this.username);
			this.checkMemberAftertype(this.userkana);
			this.checkMemberAftertype(this.useremail);
			this.checkMemberAftertype(this.useremail_conf);
			this.checkMemberAftertype(this.userphone);
			// this.checkMemberAftertype(this.userbirthday);
			this.checkMemberAftertype(this.userpass);

			this.checkExistMember(this.username);
			this.checkExistMember(this.useremail);
		}

		/**
		 * Add function check fields when user input
		 * @param  {[type]} dlt_parameter [custom dlt_parameter use insert fields input ]
		 */
		$.useAjaxaddMember.prototype.checkMemberAftertype = function (dlt_parameter) {
			// var self = this;

			$(dlt_parameter).on('change', function() {
				var timeOut = setTimeout(function() {

					var valueInput = $(dlt_parameter).val();
					var getNameInput = $(dlt_parameter).attr("name");
					// Create Object for Ajax data
					var dataForm = {};
					dataForm[getNameInput] = valueInput;
					
					//Create Ajax send request
					$.ajax({
						url: '{{ url('/add/test') }}',
						type: 'POST',
						data: dataForm,
					})
					.done(function (data) {
						$('#testcode').html('');
						var JsondecodeData = $.parseJSON(JSON.stringify(data));
						var displayHtmlresult = '<div class="alert alert-danger">'+JsondecodeData[getNameInput]+'</div>';
						$('#testcode').append(displayHtmlresult);
					})
					.fail(function () {
						alert('Ajax faile fetch data');
					});
				}, 500);
			});
		};

		$.useAjaxaddMember.prototype.checkExistMember = function (dlt_parameter) {
			$(dlt_parameter).on('change', function() {
				var timeOut = setTimeout(function() {
					var valueInput = $(dlt_parameter).val();
					var getNameInput = $(dlt_parameter).attr("name");
					var dataForm = {};
					dataForm[getNameInput] = valueInput;

					$.ajax({
						url: '{{ url('/Ajax/memberexist') }}',
						type: 'POST',
						data: dataForm,
					}).done(function (data) {
						var JsondecodeData = $.parseJSON(JSON.stringify(data));
						var displayHtmlresult = '<div class="alert alert-danger">'+JsondecodeData[getNameInput]+'</div>';
						$('#testcode').append(displayHtmlresult);
					}).fail(function () {
						alert('Ajax faile fetch data');
					});
				}, 1000);
			});
		};
	}) (jQuery);
</script>
@endsection