<?php

namespace App\Domain\Brand;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Brand\BrandFonts
 *
 * @property int $id
 * @property int|null $brand_id
 * @property int|null $font_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BrandFonts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BrandFonts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BrandFonts query()
 * @method static \Illuminate\Database\Eloquent\Builder|BrandFonts whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BrandFonts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BrandFonts whereFontId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BrandFonts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BrandFonts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BrandFonts extends Model
{
    //
}
