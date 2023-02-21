<?php

namespace App\Domain\ColorThemes;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * App\Domain\ColorThemes\ColorScheme.
 *
 * @property int $id
 * @property string $name
 * @property array $colors
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $color_scheme_set_id
 * @property int $order_column
 * @property-read \App\Domain\ColorThemes\ColorSchemeSet|null $colorSchemeSet
 * @property-read mixed $is_first_in_order
 * @method static \Illuminate\Database\Eloquent\Builder|ColorScheme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorScheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorScheme ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|ColorScheme query()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorScheme whereColorSchemeSetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorScheme whereColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorScheme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorScheme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorScheme whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorScheme whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorScheme whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ColorScheme extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => false,
    ];

    protected $guarded = ['id'];

    protected $fillable = ['name', 'colors', 'order_column'];

    protected $casts = ['colors' => 'array'];

    public function colorSchemeSet()
    {
        return $this->belongsTo(ColorSchemeSet::class);
    }

    public function setColorsAttribute($colors)
    {
        $this->attributes['colors'] = json_encode($colors);
    }

    public function setColors($colors)
    {
        $this->attributes['colors'] = json_encode($colors);
    }

    public function getCssPrefix()
    {
        $cNamePrefix = null;

        if ($this->order_column != 0) {
            $cNamePrefix = 'scheme-' . ($this->order_column + 1);
        }

        return $cNamePrefix;
    }

    public function getIsFirstInOrderAttribute()
    {
        return $this->order_column == 0;
    }
}
