<?php

namespace App;

use App\Domain\Sections\Models\HtmlConfig;
use App\Services\HtmlServices;
use App\Services\HtmlToJsonConverter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\SectionFragment
 *
 * @property int $id
 * @property string $name
 * @property string|null $html
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $java_script_module_id
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment query()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment whereHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment whereJavaScriptModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $section_id
 * @property int $fragment_id
 * @property int $trigger
 * @property string|null $identifier
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment whereFragmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFragment whereTrigger($value)
 */
class SectionFragment extends Model
{
	public static function initializeSingleton(){
		app()->singleton('section_fragments', function () {
			return SectionFragment::all();
		});
	}
	
	public static function getSingleton(){
		return app('section_fragments');
	}
	
	public static function findInSingletonById($id){
		return self::getSingleton()->first(function($module) use($id) {
			return $module->id == $id;
		});
	}
	
}
