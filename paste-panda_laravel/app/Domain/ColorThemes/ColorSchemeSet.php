<?php

namespace App\Domain\ColorThemes;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\ColorThemes\ColorSchemeSet
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\ColorThemes\ColorScheme[] $colorSchemes
 * @property-read int|null $color_schemes_count
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSchemeSet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSchemeSet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSchemeSet query()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSchemeSet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSchemeSet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSchemeSet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSchemeSet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorSchemeSet whereUserId($value)
 * @mixin \Eloquent
 * @property-read mixed $generated_theme
 */
class ColorSchemeSet extends Model
{
	protected $fillable = [
		'name', 'user_id'
	];
	
	public function colorSchemes(){
		return $this->hasMany(\App\Domain\ColorThemes\ColorScheme::class);
	}
	
	public function getGeneratedThemeAttribute(){
		$this->hex = $this->name;
		
		foreach ($this->colorSchemes as $colorScheme) {
			$colorScheme->colors = [
				'bg' => $colorScheme->colors['background'],
			];
		}
		
		return $this;
	}
	
	// this is a recommended way to declare event handlers
	public static function boot() {
		parent::boot();
		
		// auto-sets values on creation
		static::creating(function ($query) {
			$query->public = true;
		});
		
		// before delete() method call this
		static::deleting(function($colorSchemeSet) {
			$colorSchemeSet->colorSchemes()->delete();
		});
	}
	
}
