<?php

namespace App;

use ScoutElastic\Migratable;

class LookupTagIndexConfigurator extends ElasticIndexConfigurator
{
	use Migratable;
	
	protected $name = 'lookup-tags';
	
	/**
	 * @var array
	 */
	protected $settings = [
		
		'analysis' => [
			'analyzer' => [
				'tag_analyser' => [
					'tokenizer' => 'standard',
					'filter' => [
						'lowercase',
						'my_synonyms'
					]
				]
			],
			'filter' => [
				'my_synonyms' => [
					'type' => 'synonym',
					'lenient' => true,
					'synonyms' => [
						'h1 => heading-1',
						'h2 => heading-2',
						'h3 => heading-3',
						'h4 => heading-4',
						'h5 => heading-5',
						'h6 => heading-6',
						'big => large'
					]
				]
			
			]
		]
	
	];
}
