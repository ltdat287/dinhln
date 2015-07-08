<?php namespace VirtualProject\Http\Requests;

use VirtualProject\Http\Requests\Request;

class MemberSearchFormRequest extends Request {

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
		return [
			'name'         => 'max:16',
		    'email'        => 'vpemail|max:254',
		    'kana'         => 'max:16',
		    'telephone_no' => 'max:13',
		    'start_date'   => 'date_format:Y-m-d',
		    'end_date'     => 'date_format:Y-m-d',
		    'admin'        => 'in:1',
		    'boss'         => 'in:1',
		    'employ'       => 'in:1'
		];
	}

}
