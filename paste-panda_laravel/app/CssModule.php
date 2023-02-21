<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CssModule
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $parameters
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CssModule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CssModule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CssModule query()
 * @method static \Illuminate\Database\Eloquent\Builder|CssModule whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CssModule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CssModule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CssModule whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CssModule whereParameters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CssModule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CssModule extends Model
{
    //
	
	public static function initializeSingleton(){
		app()->singleton('css_modules', function () {
			return CssModule::all();
		});
	}
	
	public static function getSingleton(){
		return app('css_modules');
	}
	
	public static function findInSingletonById($id){
		return self::getSingleton()->first(function($module) use($id) {
			return $module->id == $id;
		});
	}
}
