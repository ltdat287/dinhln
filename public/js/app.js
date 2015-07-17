(function ($) {

	//Create Object GetCheckbox
	$.getCheckbox = function () {
		this.checkboxMemberIds = '.checkMembers';
		// this.typecheck	= 'checked';
		this.deletebtn = '#btn_delete_members';
		this.outputVal = '.putValdel';

		this.checkCookieExist();
	};

	$.getCheckbox.prototype.checkCookieExist = function () {
		var self = this;

		if (typeof($.cookie('cookieCheck')) == 'undefined') {

			return this.arrCheckedIds = [];
		} else{

			return this.arrCheckedIds = JSON.parse($.cookie('cookieCheck'));
		}
	};

	$.getCheckbox.prototype.clickEvent = function () {
		var self = this;
		
		$(this.checkboxMemberIds).on('click', function (e) {
			$(self.checkboxMemberIds).each(function () {
				var value = $(this).val();
				if ($(this).is(':checked')) {
					if (self.arrCheckedIds.indexOf(value) < 0) {
						self.arrCheckedIds.push(value);
					}
				} else{
					if (self.arrCheckedIds.indexOf(value) >= 0) {
						self.arrCheckedIds.splice(self.arrCheckedIds.indexOf(value),1);
					}
				}
			});
			$.removeCookie('cookieCheck');
			var ArrayJson = JSON.stringify(self.arrCheckedIds);

			return $.cookie('cookieCheck',ArrayJson)
		});
	};

	$.getCheckbox.prototype.clickSend = function () {
		var self = this;

		$(self.deletebtn).on('click', function (e) {
			$(self.outputVal).val($.cookie('cookieCheck'));
			$.removeCookie('cookieCheck');
		});
	};

	$.getCheckbox.prototype.setChecked = function () {
		var self = this;

		$(self.checkboxMemberIds).each(function () {
			var checkedVal = $(this).val();
			if (self.arrCheckedIds.indexOf(checkedVal) >= 0) {
				$(this).attr('checked','checked');
			}
		});
	};

	$(document).ready(function () {
		var check_box = new $.getCheckbox();

		check_box.setChecked();
		check_box.clickEvent();
		check_box.clickSend();
	});	


})(jQuery);