<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\JavaScriptModule
 *
 * @property int $id
 * @property string $name
 * @property string $function_name
 * @property string $code
 * @property string $parameters
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\LibraryDependency[] $library_dependencies
 * @property-read int|null $library_dependencies_count
 * @method static \Illuminate\Database\Eloquent\Builder|JavaScriptModule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JavaScriptModule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JavaScriptModule query()
 * @method static \Illuminate\Database\Eloquent\Builder|JavaScriptModule whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JavaScriptModule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JavaScriptModule whereFunctionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JavaScriptModule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JavaScriptModule whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JavaScriptModule whereParameters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JavaScriptModule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JavaScriptModule extends Model
{
    protected $guarded = ['id'];

    //	protected $casts = ['parameters' => 'json'];

    public function library_dependencies()
    {
        return $this->belongsToMany(LibraryDependency::class, 'java_script_module_library_dependencies');
    }

    public static function initializeSingleton()
    {
        app()->singleton('java_script_modules', function () {
            return JavaScriptModule::with('library_dependencies')
                ->get();
        });
    }

    public static function getSingleton()
    {
        return app('java_script_modules');
    }

    public static function findInSingletonById($id)
    {
        return self::getSingleton()->first(function ($module) use ($id) {
            return $module->id == $id;
        });
    }
}
