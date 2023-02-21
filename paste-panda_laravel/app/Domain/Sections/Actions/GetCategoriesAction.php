<?php

namespace App\Domain\Sections\Actions;

use Illuminate\Support\Collection;
use App\Domain\Sections\Models\Section;
use App\Domain\Sections\Models\SectionCategory;

class GetCategoriesAction
{
	public function execute()
	{
		$categories = SectionCategory::whereHas('sections', function ($q) {
			$q->where('beta_section', 1);
		})
			->orderBy('name')
			->withCount('sections')
			->having('sections_count', '>', 0)
			->get();

		$sectionsCount = Section::where('beta_section', 1)
			->ordered()
			->count();

		$categories->prepend([
			'name' => 'All sections',
			'sections_count' => $sectionsCount,
			'slug' => '',
		]);
		dd($categories);
		return $categories;
	}

	public function sexecute()
	{
		$query = [
			'size' => 0,
			'aggs' => [
				'categoryname' => [
					'terms' => [
						'field' =>  'section_category.name.keyword',
						'size'  =>  15,
						'min_doc_count' => '0'
					],
					'aggs' => [
						'slug' => [
							'terms' => [
								'field' =>  'section_category.slug.keyword',
								'size'  =>  1,
								'min_doc_count' => '0'
							]
						]
					]
				]
			]
		];
		if (Request()->search) {
			foreach (explode(" ", Request()->search) as $tag) {
				$searchTags[] = [
					'match_phrase' => [
						'tags.name' => $tag
					]
				];
			}
			$query['query'] = [
				'bool' => [
					'should' => $searchTags
					//					'minimum_should_match' => '80%'
				],
			];
		}

		$results = Section::searchRaw($query);
		// dd($results);
		$categories = new Collection();
		foreach ($results['aggregations']['categoryname']['buckets'] as $hit) {
			$category = new SectionCategory($hit);
			$category->name = $hit['key'];
			$category->slug = $hit['slug']['buckets'][0]['key'];
			$category->sections_count = $hit['doc_count'];
			$categories->add($category);
		}
		$sectionsCount = $results['hits']['total']['value'];
		// dd($sectionsCount);

		$categories->prepend([
			'name' => 'All sections',
			'sections_count' => $sectionsCount,
			'slug' => '',
		]);

		return $categories;
	}
}
