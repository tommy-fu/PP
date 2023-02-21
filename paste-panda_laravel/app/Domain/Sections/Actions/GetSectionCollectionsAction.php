<?php

namespace App\Domain\Sections\Actions;

use App\Models\SectionCollection;
use Illuminate\Support\Collection;
use App\Domain\Sections\Models\Section;

class GetSectionCollectionsAction
{
	public function execute()
	{
//		$sectionCollection = SectionCollection::whereHas('sections', function ($q) {
////			$q->where('beta_section', 0);
//		})
		$sectionCollection = SectionCollection::orderBy('name')
			->withCount('sections')
//			->having('sections_count', '>', 0)
			->get();

		return $sectionCollection;
	}

	public function sexecute()
	{
		$query = [
			'size' => 0,
			'aggs' => [
				'section_collection' => [
					'terms' => [
						'field' =>  'sections_collections.keyword',
						'size'  =>  15,
						'min_doc_count' => '0'
					]
				]
			]
		];

		if (Request()->search) {
			foreach (explode(",", Request()->search) as $tag) {
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
		$section_collections = new Collection();
		foreach ($results['aggregations']['section_collection']['buckets'] as $hit) {
			$section_collection = new SectionCollection($hit);
			$section_collection->name = $hit['key'];
			// $section_collection->slug = $hit['slug']['buckets'][0]['key'];
			$section_collection->sections_count = $hit['doc_count'];
			$section_collections->add($section_collection);
		}
		// dd($section_collections);
		return $section_collections;
	}
}
