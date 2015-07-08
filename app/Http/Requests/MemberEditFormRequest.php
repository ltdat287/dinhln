<?php namespace VirtualProject\Http\Requests;

use VirtualProject\Http\Requests\Request;
use VirtualProject\Helpers\MemberHelper;

class MemberEditFormRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
	    $valid = [
	        'name' => 'required|min:1|max:16',
	        'kana' => 'required|min:1|max:16',
	        'email' => 'required|vpemail|confirmed|max:255',
	        'email_confirmation' => 'required',
	        'telephone_no' => 'required|vptelephone|min:10|max:13',
	        'birthday' => 'required|date_format:' . VP_TIME_FORMAT . '|vpdate|min:10|max:10',
	        'note' => 'min:1|max:300',
	        'password' => 'required|between:8,32',
	        'use_role' => 'required'
	    ];
	    if (MemberHelper::getCurrentUserRole() == 'employ') {
	        unset($valid['email']);
	        unset($valid['email_confirmation']);
	        unset($valid['note']);
	        unset($valid['use_role']);
	    }
		return $valid;
	}

}
