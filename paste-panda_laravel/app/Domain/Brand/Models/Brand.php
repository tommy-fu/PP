<?php

namespace App\Domain\Brand\Models;

use App\Domain\Brand\BrandItem;
use App\Domain\Brand\BrandVariables;
use App\Domain\Brand\Font;
use App\Domain\ColorThemes\ColorSchemeSet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Domain\Brand\Models\Brand.
 *
 * @property int $id
 * @property string $name
 * @property array $variables
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|ColorSchemeSet[] $colorSchemeSets
 * @property-read int|null $color_scheme_sets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Font[] $fonts
 * @property-read int|null $fonts_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-write mixed $elements
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereVariables($value)
 * @mixin \Eloquent
 */
class Brand extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    use HasFactory;

    protected $table = 'brands';

    protected $guarded = ['id'];

    protected $casts = ['variables' => 'json'];

    public function getFontFaceCss()
    {
        return $this->fonts->reduce(function ($carry, $font) {
            return $carry . $font->getFontFace();
        }, '');
    }

    public function getIconCss()
    {
        if (! $this->fresh()->getMedia('icon_set')->first()) {
            return '';
        }

        return '@font-face {' . PHP_EOL .
            '   font-family: "' . 'icons' . '";' . PHP_EOL .
            '   src: url("' . $this->fresh()->getMedia('icon_set')->first()->getFullUrl() . '") format("opentype");' . PHP_EOL .
//			'   font-weight: ' . $this->font_weight . ';' . PHP_EOL .
            '   font-style: normal;' . PHP_EOL .
            '}' . PHP_EOL;
    }

    public function getIconCodes()
    {
        if (! $this->fresh()->getMedia('icon_codes_css')->first()) {
            return '';
        }

        return file_get_contents($this->fresh()->getMedia('icon_codes_css')->first()->getFullUrl());
    }

    public function fonts()
    {
        return $this->belongsToMany(Font::class, 'brand_fonts', 'brand_id', 'font_id');
    }

    public function colorSchemeSets()
    {
        return $this->belongsToMany(ColorSchemeSet::class, 'brand_color_scheme_sets', 'brand_id', 'color_scheme_set_id');
    }

    /**
     * Set the user's first name.
     *
     * @param string $value
     * @return void
     */
    public function setElementsAttribute($value)
    {
        $json = json_decode($this->attributes['variables'], true);

        $json['elements'] = $value;

        $this->attributes['variables'] = json_encode($json);
    }

    public function setVariables($value)
    {
        $this->attributes['variables'] = $value;
    }

    public static function getVariable($variable)
    {
        return app('brand')->variables[$variable];
    }

    public static function makeBrandItem($variable): BrandItem
    {
        return new BrandItem(app('brand')->variables[$variable]);
    }

    public function addBrandToSingleton()
    {
        app()->singleton('brand', function () {
            $this->setVariables(json_encode(array_intersect_key($this->variables, BrandVariables::getBrand2()) + BrandVariables::getBrand2()));

            return $this;
        });
    }

    public static function initialize($overrides)
    {
        app()->singleton('brand_variables', function () use ($overrides) {
            $this->setVariables(json_encode(array_intersect_key($overrides, BrandVariables::getBrand2()) + BrandVariables::getBrand2()));

            return $this;
        });
    }
	
//	public function getVariablesAttribute($variables){
//		return json_encode($this->recursive_array_intersect_key($variables, BrandVariables::getBrand2()) + BrandVariables::getBrand2());
//    }
//
//	public function recursive_array_intersect_key(array $array1, array $array2)
//	{
//		$array1 = array_intersect_key($array1, $array2);
//		foreach ($array1 as $key => &$value) {
//			if (is_array($value) && is_array($array2[$key])) {
//				$value = $this->recursive_array_intersect_key($value, $array2[$key]);
//			}
//		}
//
//		return $array1;
//	}
    
    public static function getVariables($variable){
    	return app('brand_variables')->variables[$variable];
    }
	public static function boot() {
		parent::boot();
		
		// auto-sets values on creation
		static::creating(function ($query) {
			$query->public = true;
		});
		
		}
	}
