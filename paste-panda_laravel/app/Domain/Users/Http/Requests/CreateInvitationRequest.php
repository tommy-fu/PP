<?php

namespace App\Domain\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvitationRequest extends FormRequest
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
		    'email' => 'required|email|unique:user_invitations,email',
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
			'email.required' => 'You have to enter an email address.',
			'email.exists' => 'The email already exists.',
//			'website_type_id.required' => "You have to enter what kind of websites you're usually building.",
//			'custom_title.required' => 'You have to enter a title.',
//			'custom_website_type.required' => "You have to enter what kind of websites you're usually building.",
		];
	}
}
