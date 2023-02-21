<?php

namespace App\Domain\Onboarding;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Onboarding\OnboardingSurveyWebsiteType
 *
 * @property int $id
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurveyWebsiteType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurveyWebsiteType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurveyWebsiteType query()
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurveyWebsiteType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurveyWebsiteType whereName($value)
 * @mixin \Eloquent
 */
class OnboardingSurveyWebsiteType extends Model
{
	use \Sushi\Sushi;
	
	protected $rows = [
		[
			'id' => 1,
			'name' => 'SaaS pages',
		],
		[
			'id' => 2,
			'name' => 'Landing/marketing pages',
		],
		[
			'id' => 3,
			'name' => 'Smaller business pages',
		],
		[
			'id' => 4,
			'name' => 'eCommerce pages',
		],
		[
			'id' => 5,
			'name' => 'Dashboards and/or web applications',
		],
		[
			'id' => 0,
			'name' => 'Other',
		],
	];
}
