<?php

namespace App\Domain\Onboarding\Http\Requests;

use App\Domain\Onboarding\OnboardingSurveyTitle;
use App\Domain\Onboarding\OnboardingSurveyWebsiteType;
use Illuminate\Foundation\Http\FormRequest;

class OnboardingSurveyRequest extends FormRequest
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
	
	    $titleIds = OnboardingSurveyTitle::all()->pluck('id')->toArray();
	    $websiteIds = OnboardingSurveyWebsiteType::all()->pluck('id')->toArray();
	    
    	$data = [
//    	    'title_id' => 'required|digits_between:' . min($titleIds) . ',' . max($titleIds),
    	    'title_id' => 'required|numeric|min:'.min($titleIds) . '|max:'.max($titleIds),
    	    'website_type_id' => 'required|numeric|min:'.min($websiteIds) . '|max:'.max($websiteIds),
	    ];
    	
//    	dd($data);
    	
    	if($this->title_id == 0){
		    $data['custom_title'] = 'required';
	    }
    	
	
	    if($this->website_type_id == 0){
		    $data['custom_website_type'] = 'required';
		    
	    }

	    return $data;
    }
	
	
	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'title_id.required' => 'You have to enter a title.',
			'website_type_id.required' => "You have to enter what kind of websites you're usually building.",
			'custom_title.required' => 'You have to enter a title.',
			'custom_website_type.required' => "You have to enter what kind of websites you're usually building.",
		];
	}
}
