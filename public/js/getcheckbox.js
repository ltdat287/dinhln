(function ($) {

	/**
	 * Constructor
	 * @return {void}
	 */
	$.getCheckbox = function () {
		this.checkboxMemberIds = '.checkMembers';
		this.deletebtn = '#btn_delete_members';
		this.outputVal = '.putValdel';

		this.checkCookieExist();
		this.initEvents();
	};

	/**
	 * Check cookie of values checked at constructor
	 * @return array
	 */
	$.getCheckbox.prototype.checkCookieExist = function () {
		var self = this;

		if (typeof($.cookie('cookieCheck')) == 'undefined') {

			return this.arrCheckedIds = [];
		} else{

			return this.arrCheckedIds = JSON.parse($.cookie('cookieCheck'));
		}
	};

	/**
	 * Save to array values id member has checked and remove cookie exist, add .
	 * @return {cookie} [cookie have value of array]
	 */
	$.getCheckbox.prototype.initEvents = function () {
		var self = this;
		
		/*  */
		$(this.checkboxMemberIds).on('click', function (e) {
			// Get checked ids array.
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

			// Remove cookie.
			$.removeCookie('cookieCheck');

			// Convert array and save to cookie.
			var ArrayJson = JSON.stringify(self.arrCheckedIds);
			$.cookie('cookieCheck',ArrayJson);
		});

		/* Send checked ids cookie to server when click delete button. */
		$(this.deletebtn).on('click', function (e) {
			$(self.outputVal).val($.cookie('cookieCheck'));

			//Remove cookie after send request to server
			$.removeCookie('cookieCheck');
		});

		/* set type checked for user has select */
		$(this.checkboxMemberIds).each(function () {
			var checkedVal = $(this).val();
			if (self.arrCheckedIds.indexOf(checkedVal) >= 0) {
				$(this).attr('checked','checked');
			}
		});
	};

	/**
	 * On dom ready events
	 */
	$(document).ready(function () {
		var check_box = new $.getCheckbox();
	});	

})(jQuery);