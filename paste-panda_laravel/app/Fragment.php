<?php

namespace App;

use App\Domain\Sections\Models\SectionHtml;
use App\JavaScriptBuilder\JavaScriptBuilder;
use App\Services\BladeCompiler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Fragment
 *
 * @property int $id
 * @property string $name
 * @property string $html
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\JavaScriptEvent $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\JavaScriptModule[] $javaScriptModules
 * @property-read int|null $java_script_modules_count
 * @method static \Illuminate\Database\Eloquent\Builder|Fragment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fragment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fragment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fragment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fragment whereHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fragment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fragment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fragment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Fragment extends Model
{
	use HasFactory;
	
	protected $guarded = ['id'];
	
	public function getHtmlCodeAttribute()
	{
		return new SectionHtml($this, true);
	}
	
	public function js()
	{
		$result = '';
		
		$builder = new JavaScriptBuilder();
		
		if ($this->pivot->trigger === 1) {
			$jsEvent = JavaScriptEvent::make($this->pivot->identifier);
			
//			$jsEvent->addToggleVisibilityCode($this->fragmentIdentifier());

//			$jsEvent->toggleClass($this->pivot->identifier, 'is-active');
			
			$jsEvent->addCode($this->javascript . PHP_EOL);
			
			$builder->addEvent($jsEvent);
			
			$result .= $jsEvent->getCode();
		}
		
//		foreach ($this->javaScriptModules as $module) {
//
//			$config = json_decode($module->parameters, true);
//
//			$config['element'] = $this->fragmentIdentifier();
//
//			$arguments = json_decode($module->pivot->arguments, true);
//
//			$arguments = array_merge_recursive_distinct($config, $arguments);
//
//			$arguments = $this->convertToJsoNString($arguments);
//
//			$jsEvent = JavaScriptEvent::make($arguments['identifier']);
//
//			$jsEvent->addCode(BladeCompiler::compileString($module->code, $arguments) . PHP_EOL);
//
//			$result .= $jsEvent->getCode();
//
//		}
//		return $builder->getCode();
		return $result;
	}
	
	/**
	 * @param array $arguments
	 * @return array
	 */
	private function convertToJsoNString(array $arguments): array
	{
		foreach ($arguments as $key => $value) {
			@json_decode($value);
			if (json_last_error() == JSON_ERROR_NONE) {
				$arguments[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);
			}
		}
		
		return $arguments;
	}
	
	public function fragmentIdentifier() : string
	{
		return 'fragment-' . $this->id;
	}
	
	public function getEventAttribute() : JavaScriptEvent {
		return new JavaScriptEvent($this);
	}
	
	public function javaScriptModules(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
	{
		return $this->belongsToMany(JavaScriptModule::class, 'fragment_java_script_modules')->withPivot('arguments');
	}
	
}
