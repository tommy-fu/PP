<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorSchemeFormRequest extends FormRequest
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
    	$length = strlen(str_replace('#', '', $this->hex));
	
	    if($length != 3 && $length != 6){
		    $this->hex = '';
	    }
	
	    return [
		    'hex' => ['required', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
	    ];
     
    }
    
    public function messages()
    {
	    return [
	    	'hex.required' => 'Please enter a valid hex value.',
	    	'hex.regex' => 'Please enter a valid hex value.',
	    ];
    }
}
