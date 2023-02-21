<?php

namespace App\Domain\Brand;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Domain\Brand\Font
 *
 * @property int $id
 * @property int $font_family_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $font_weight
 * @property-read \App\Domain\Brand\FontFamily $fontFamily
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Font newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Font newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Font query()
 * @method static \Illuminate\Database\Eloquent\Builder|Font whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Font whereFontFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Font whereFontWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Font whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Font whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Font extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'fonts';
    protected $guarded = ['id'];

    public function getFontFace()
    {
        if (!$this->fresh()->getMedia('font')->first()) {
            return '';
        }

        return '@font-face {' . PHP_EOL .
            '   font-family: "' . $this->fontFamily->name . '";' . PHP_EOL .
            '   src: url("' . $this->fresh()->getMedia('font')->first()->getFullUrl() . '") format("opentype");' . PHP_EOL .
            '   font-weight: ' . $this->font_weight . ';' . PHP_EOL .
            '   font-style: normal;' . PHP_EOL .
            '}' . PHP_EOL;
    }

    public function fontFamily()
    {
        return $this->belongsTo(FontFamily::class);
    }
}
