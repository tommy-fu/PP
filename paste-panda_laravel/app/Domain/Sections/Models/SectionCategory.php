<?php

namespace App\Domain\Sections\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Domain\Sections\Models\SectionCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $slug
 * @property int $order_column
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Sections\Models\Section[] $beta_sections
 * @property-read int|null $beta_sections_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Sections\Models\Section[] $section
 * @property-read int|null $section_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Sections\Models\Section[] $sections
 * @property-read int|null $sections_count
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCategory ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCategory whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SectionCategory extends Model implements Sortable
{
	use HasSlug;
	use SortableTrait;
	
	public $sortable = [
		'order_column_name' => 'order_column',
		'sort_when_creating' => true,
	];
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'section_categories';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
	
	/**
	 * Get the options for generating the slug.
	 */
	public function getSlugOptions() : SlugOptions
	{
		return SlugOptions::create()
			->generateSlugsFrom('name')
			->saveSlugsTo('slug');
	}
	
	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'slug';
	}

	
	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/
	public function section(){
		return $this->hasMany(Section::class)
			->whereNotNull('html');
	}
	
	
	public function beta_sections(){
		return $this->hasMany(Section::class)
			->whereNotNull('html');
	}
	
	public function sections(){
		return $this->hasMany(Section::class)
			->where('beta_section', 1)
			->whereNotNull('html');
	}
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
