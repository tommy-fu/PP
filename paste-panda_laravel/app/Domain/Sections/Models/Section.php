<?php

namespace App\Domain\Sections\Models;

use App\CssModule;
use App\Fragment;
use App\JavaScriptModule;
use App\LibraryDependency;
use App\Models\SectionCollection;
use App\Models\SectionCollectionSection;
use App\SectionConfig;
use App\SectionIndexConfigurator;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStatus\HasStatuses;

/**
 * App\Domain\Sections\Models\Section
 *
 * @property int $id
 * @property string $name
 * @property int|null $section_category_id
 * @property int $requires_pro
 * @property string|null $html
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $blade_fields
 * @property array|null $json
 * @property int $beta_section
 * @property int $production_ready
 * @property int $html_structured
 * @property int $order_column
 * @property int $survey_reward
 * @property int|null $mobile_preview_height
 * @property int|null $tablet_preview_height
 * @property int|null $desktop_preview_height
 * @property int $copy_fixed
 * @property string $javascript
 * @property-read SectionConfig|null $config
 * @property-read mixed $html_code
 * @property-read \App\Domain\Sections\Models\SectionJavaScript $js
 * @property-read string $status
 * @property-read \Illuminate\Database\Eloquent\Collection|JavaScriptModule[] $javaScriptModules
 * @property-read int|null $java_script_modules_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Domain\Sections\Models\SectionCategory|null $section_category
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\ModelStatus\Status[] $statuses
 * @property-read int|null $statuses_count
 * @method static \Illuminate\Database\Eloquent\Builder|Section currentStatus($names)
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Section otherCurrentStatus($names)
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereBetaSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereBladeFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCopyFixed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereDesktopPreviewHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereHtmlStructured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereJavascript($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereMobilePreviewHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereProductionReady($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereRequiresPro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSectionCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSurveyReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereTabletPreviewHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|CssModule[] $cssModules
 * @property-read int|null $css_modules_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Fragment[] $fragments
 * @property-read int|null $fragments_count
 * @property-read mixed $css
 */
class Section extends Model implements HasMedia, Sortable
{
    use InteractsWithMedia;
    use HasStatuses;
    use SortableTrait;
    use Searchable;
	
	protected $indexConfigurator = SectionIndexConfigurator::class;
	
	/**
	 * Get the name of the index associated with the model.
	 *
	 * @return string
	 */
	public function searchableAs()
	{
		return '_doc';
	}
	
	protected $searchRules = [
		//
	];
	
	
	// Here you can specify a mapping for model fields
	protected $mapping = [
		'properties' => [
			'beta_section' => [
				'type' => 'boolean'
			],
			'production_section' => [
				'type' => 'boolean'
			],
			'model_section' => [
				'type' => 'boolean'
			],
			'html' => [
				'type' => 'text',
				'fields' => [
					'keyword' => [
						'type' => 'keyword'
					]
				]
			],
			'id' => [
				'type' => 'long'
			],
			'section_category' => [
				'properties' => [
					'name' => [
						'type' => 'text',
						'fields' => [
							'keyword' => [
								'type' => 'keyword'
							]
						]
					],
					'slug' => [
						'type' => 'text',
						'fields' => [
							'keyword' => [
								'type' => 'keyword'
							]
						]
					]
				]
			],
			'tags' => [
				'properties' => [
					'tagname' => [
						'type' => 'text',
						'fields' => [
							'keyword' => [
								'type' => 'keyword'
							]
						]
					],
					'value' => [
						'type' => 'text',
						'fields' => [
							'keyword' => [
								'type' => 'keyword'
							]
						]
					]
				]
			],
			'last_updated' => [
				'type' => 'date'
			],
			'sections_collections' => [
				'type' => 'text',
				'fields' => [
					'keyword' => [
						'type' => 'keyword'
					]
				]
			]
		]
	];
	
	/**
	 * Get the indexable data array for the model.
	 *
	 * @return array
	 */
	public function toSearchableArray()
	{
		$array = $this->toArray();
		$result = [
			'id' => $array['id'],
			'html' => $array['html'],
			'section_category.name' => $this->section_category ? $this->section_category->name : 'No category',
			//			'tags' =>  $this->tags->pluck('name'),
			'section_category.slug' => $this->section_category ? $this->section_category->slug : 'no-category',
			'last_updated' => $this->updated_at,
			'sections_collections' => $this->collections()->pluck('name')
		];
		if ($this->model_section == 1) {
			$result['model_section'] = true;
			return $result;
		}

		if ($this->beta_section == 1) {
			$result['beta_section'] = true;
		} else {
			$result['production_section'] = true;
		}
		return $result;
	}

	public $sortable = [
		'order_column_name' => 'order_column',
		'sort_when_creating' => true,
	];

    protected $table = 'sections';
    protected $guarded = ['id'];
    protected $dates = ['approved_at'];

    protected $casts = ['json' => 'json', 'html_nodes' => 'json', 'blade_fields' => 'array', 'fields' => 'array'];

    public function getHtmlCodeAttribute()
    {
        return new SectionHtml($this);
    }

    public function getJsAttribute() : SectionJavaScript
    {
        return new SectionJavaScript($this);
    }
	
//	public function getCssAttribute()
//	{
//		return new SectionCss($this);
//	}
	
    public function section_category()
    {
        return $this->belongsTo(SectionCategory::class);
    }

    public function status()
    {
        return $this->statuses()->latest();
    }

    public static function getStatuses()
    {
        return [
            'Needs to be reviewed' => 'Needs to be reviewed',
            'In review' => 'In review',
            'Needs research' => 'Needs research',
            'Needs improvement' => 'Needs improvement',
            'Passed' => 'Passed',
        ];
    }

    public function javaScriptModules()
    {
        return $this->belongsToMany(JavaScriptModule::class, 'section_java_script_modules')->withPivot('arguments');
    }
	
	public function cssModules()
	{
		return $this->belongsToMany(CssModule::class, 'section_css_modules')->withPivot('arguments');
	}
	public function fragments(){
		return $this->belongsToMany(Fragment::class, 'section_fragments')->withPivot(['trigger', 'identifier']);
    }
	
	public function dependencies(){
		return $this->belongsToMany(LibraryDependency::class, 'section_library_dependencies');
	}
	
	public function collections(){
		return $this->belongsToMany(SectionCollection::class, 'section_collection_sections')
			->using(SectionCollectionSection::class);
	}
	
	public function getJavascriptAttribute($attribute){
		return $attribute ?? '';
	}
	
	public function getCssAttribute($attribute){
		return $attribute ?? '';
	}

    public function setPreviewCode()
    {
        $this->rendered_html = $this->html_code->getRenderedHtml();

        $this->preview_html = $this->html_code->getPreviewHtml();

        $this->css_code = $this->css_codes->code();

        $this->javascript_code = $this->js->code();

        $sectionDependencies = new SectionDependencies($this);

        $this->css_dependencies = $sectionDependencies->getCssDependencies();

        $this->js_dependencies = $sectionDependencies->getJavaScriptDependencies();
    }
}
