<?php

namespace App;

use App\Domain\Brand\BrandVariables;
use App\Domain\ColorThemes\Elements\Base\Badge;
use App\Domain\ColorThemes\Elements\Base\Colorable;
use App\Domain\ColorThemes\Elements\Base\Input;
use App\Domain\ColorThemes\Elements\Base\Link;
use App\Domain\ColorThemes\Elements\Base\SolidButton;
use App\Domain\ColorThemes\Elements\Base\TextBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\SchemeColorFormula
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property array $colors
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SchemeColorFormula newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchemeColorFormula newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchemeColorFormula query()
 * @method static \Illuminate\Database\Eloquent\Builder|SchemeColorFormula whereColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchemeColorFormula whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchemeColorFormula whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchemeColorFormula whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchemeColorFormula whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchemeColorFormula whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SchemeColorFormula extends Model
{
	use HasFactory;
	
	protected $fillable = ['name', 'colors', 'type'];
	
	protected $casts = ['colors' => 'array'];
	
	const STANDARD_TYPE = 0;
	const CARD_TYPE = 1;
	
	/**
	 * @return array
	 */
	public static function generateColorVariables($excludedClasses = []): array
	{
		$variables = BrandVariables::$styleVariables;
		
		$foo = collect($variables)
			->filter(function ($variable) use($excludedClasses){
				return !in_array($variable, $excludedClasses);
			})
			->filter(function ($variable) {
				return is_subclass_of($variable, Colorable::class);
			})
			->flatMap(function ($variable) {
				return $variable::getFormulaKeys();
			});
		
		$res = [];
		
		foreach ($foo as $key) {
			$res[$key] = [
				'fixed_value' => null,
				'fixed_hex' => null,
				'fixed_hue' => null,
				'fixed_saturation' => null,
				'fixed_brightness' => null,
				'altered_saturation' => null,
				'altered_brightness' => null,
				'opacity' => null,
				'fallback_variable' => null,
			];
		}
		
		return $res;
	}
	
	static function getBase()
	{
		return [
			'fixed_value' => null,
			'fixed_hex' => null,
			'fixed_hue' => null,
			'fixed_saturation' => null,
			'fixed_brightness' => null,
			'altered_saturation' => null,
			'altered_brightness' => null,
			'opacity' => null,
			'fallback_variable' => null,
		];
	}
}
