<?php


namespace App\Repositories;


use App\LookupTagIndexConfigurator;
use App\Services\ElasticService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class TagsRepository implements ITagRepository
{
	public function getAll(): Collection
	{
		$query = [
			'query' => [
				'match_all' => (object)[],
			],
			'size' => 100,
		];
		
		$response = ElasticService::get($query, LookupTagIndexConfigurator::getFullName() . '/_search');
		
		$tags = new Collection();
		
		foreach ($response['hits']['hits'] as $tag) {
			$tags->add(
				[
					'key' => $tag['_source']['value'],
					'value' => $tag['_source']['name'],
				]
			);
		}
		
		return $tags;
	}
	
	public function getByString(string $query): Collection
	{
		$query = [
			'query' => [
				'match_phrase_prefix' => [
					'name' => Request()->tag ?? '',
				]
			]
		];
		
		$response = ElasticService::get($query, LookupTagIndexConfigurator::getFullName() . '/_search');
		
		$tags = new Collection();
		
		foreach ($response['hits']['hits'] as $tag) {
			$tags->add(
				[
					'key' => $tag['_source']['value'],
					'value' => $tag['_source']['name']
				]
			);
		}
		
		return $tags;
	}
}
