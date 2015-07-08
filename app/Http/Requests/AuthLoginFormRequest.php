<?php namespace VirtualProject\Http\Requests;

use VirtualProject\Http\Requests\Request;

class AuthLoginFormRequest extends Request {

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
            'email' => 'required|vpemail|max:255',
		    'password' => 'required|between:8,32'
		];
	}

}
