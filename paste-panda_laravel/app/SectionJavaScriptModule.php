<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SectionJavaScriptModule
 *
 * @property int $id
 * @property int $section_id
 * @property int $java_script_module_id
 * @property array $arguments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SectionJavaScriptModule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionJavaScriptModule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionJavaScriptModule query()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionJavaScriptModule whereArguments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionJavaScriptModule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionJavaScriptModule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionJavaScriptModule whereJavaScriptModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionJavaScriptModule whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionJavaScriptModule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SectionJavaScriptModule extends Model
{
    protected $guarded = ['id'];
    
    protected $casts = ['arguments' => 'array'];
}
