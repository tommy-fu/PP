<?php

namespace App\Domain\Onboarding;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Onboarding\OnboardingSurveyTitle
 *
 * @property int $id
 * @property string|null $abbr
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurveyTitle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurveyTitle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurveyTitle query()
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurveyTitle whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurveyTitle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurveyTitle whereName($value)
 * @mixin \Eloquent
 */
class OnboardingSurveyTitle extends Model
{
	use \Sushi\Sushi;
	
	protected $rows = [
		[
			'id' => 1,
			'abbr' => 'NY',
			'name' => 'Freelancer/Consultant',
		],
		[
			'id' => 2,
			'abbr' => 'CA',
			'name' => 'Startup founder/developer',
		],
		[
			'id' => 3,
			'abbr' => 'CA',
			'name' => 'Developer at an agency',
		],
		[
			'id' => 4,
			'abbr' => 'CA',
			'name' => 'Enthusiast',
		],
		[
			'id' => 0,
			'abbr' => 'CA',
			'name' => 'Other',
		],
	];
}
