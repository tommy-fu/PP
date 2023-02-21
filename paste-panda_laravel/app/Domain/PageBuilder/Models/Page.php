<?php

namespace App\Domain\PageBuilder\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\PageBuilder\Models\Page
 *
 * @property int $id
 * @property string $name
 * @property int $project_id
 * @property int $page_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domain\PageBuilder\Models\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Domain\Sections\Models\Section[] $sections
 * @property-read int|null $sections_count
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page wherePageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
	public function sections(){
		return $this->belongsToMany(\App\Domain\Sections\Models\Section::class, 'page_sections')
			->withPivot('order_column');
	}
	
	public function project(){
		return $this->belongsTo(Project::class);
	}
}
