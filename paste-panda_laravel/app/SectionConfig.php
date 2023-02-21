<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SectionConfig
 *
 * @property int $id
 * @property int $section_id
 * @property string $arguments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SectionConfig newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionConfig newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionConfig query()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionConfig whereArguments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionConfig whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionConfig whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SectionConfig extends Model
{
    //
}
