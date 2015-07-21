@extends('app')

@section('title', trans('labels.add_title'))

@section('content')

<section class="contents">
	<h2>{{ trans('labels.member_add') }}</h2>
<div id="testcode" class="alert alert-danger"></div>
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
			var AjaxMember = new $.useAjaxaddMember();
			// AjaxMember.checkMemberAftertype($.useAjaxaddMember[username]);

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
					// console.log(dataForm);
					
					//Create Ajax send request
					$.ajax({
						url: '{{ url('/add/test') }}',
						type: 'POST',
						data: dataForm,
					})
					.done(function (data) {
						// console.log(data);
						$('#testcode').html('');
						var JsondecodeData = $.parseJSON(JSON.stringify(data));
						// console.log(JsondecodeData);
						$('#testcode').append(JsondecodeData[getNameInput]);
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
						$('#testcode').html('');
						var JsondecodeData = $.parseJSON(JSON.stringify(data));
						$('#testcode').append(JsondecodeData[getNameInput]);
					}).fail(function () {
						alert('Ajax faile fetch data');
					});
				}, 1000);
			});
		};
	}) (jQuery);
</script>
@endsection