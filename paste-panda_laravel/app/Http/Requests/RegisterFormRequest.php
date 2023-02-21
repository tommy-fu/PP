<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
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
            'email' => 'unique:users,email|required',
            'first_name' => 'required',
	        'last_name' => 'required',
	        'password' => 'required',
	        'password_confirmation' => 'required|same:password',
	        'terms' => 'accepted',
        ];
    }
	
	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'email.unique' => 'The email is already taken.',
			'email.required' => 'You have to enter an email address.',
			'first_name.required' => 'You have to enter a first name.',
			'last_name.required' => 'You have to enter a last name.',
			'password.required' => 'You have to enter a password.',
			'password_confirmation.same' => 'The passwords do not match.',
			'password_confirmation.required' => 'You have to re-enter your password.',
			'terms.accepted' => 'You have to agree to our Terms of Use and our Privacy Policy to create an acccount.',
		];
	}
}
