<?php

namespace App\Models;

use App\LookupTagIndexConfigurator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

class LookupTag extends Model
{
	use HasFactory;
	use Searchable;

	public function searchableAs()
	{
		return '_doc';
	}

	protected $indexConfigurator = LookupTagIndexConfigurator::class;
	
	protected $mapping = [
		'properties' => [
			'name' => [
				'type' => 'search_as_you_type',
				'doc_values' => false,
				'max_shingle_size' => 3,
				"analyzer" => "tag_analyser"
			
			],
			'value' => [
				'type' => 'text',
				'fields' => [
					'keyword' => [
						'type' => 'keyword',
						'ignore_above' => 256
					]
				]
			]
		]
	];
}
