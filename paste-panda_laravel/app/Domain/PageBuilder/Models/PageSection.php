<?php

namespace App\Domain\PageBuilder\Models;

use App\Domain\Sections\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Domain\PageBuilder\Models\PageSection
 *
 * @property int $id
 * @property int $page_id
 * @property int $section_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $order_column
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read Section $section
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection query()
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PageSection extends Model implements HasMedia, Sortable
{
	use InteractsWithMedia;
	
	use SortableTrait;
	
	public $sortable = [
		'order_column_name' => 'order_column',
		'sort_when_creating' => true,
	];
	
    protected $fillable = ['fields', 'section_id', 'page_id', 'order_column'];
	
	protected $casts = ['fields' => 'array'];
	
	
	public function section(){
		return $this->belongsTo(Section::class);
    }
}
