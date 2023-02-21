<?php

namespace App\Domain\Brand;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Brand\FontFamily
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Brand\Font[] $fonts
 * @property-read int|null $fonts_count
 * @method static \Illuminate\Database\Eloquent\Builder|FontFamily newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FontFamily newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FontFamily query()
 * @method static \Illuminate\Database\Eloquent\Builder|FontFamily whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FontFamily whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FontFamily whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FontFamily whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FontFamily extends Model
{
    protected $table = 'font_families';

    protected $guarded = ['id'];

    public function fonts()
    {
        return $this->hasMany(Font::class);
    }
}
