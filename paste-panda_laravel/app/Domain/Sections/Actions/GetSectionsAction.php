<?php

namespace App\Domain\Sections\Actions;

use App\CssModule;
use App\SectionFragment;
use App\JavaScriptModule;
use App\Domain\ColorThemes\Colors;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Domain\Sections\Models\Section;
use Faker\Guesser\Name;

class GetSectionsAction
{
	public function execute()
	{
		Auth::user()->brand->addBrandToSingleton();
		
		CssModule::initializeSingleton();
		JavaScriptModule::initializeSingleton();
		SectionFragment::initializeSingleton();
		
		Colors::setScheme(Auth::user()->colorScheme);
		
		
		$searchTags = [];
		$searchQuery = [];
		
		if (Request()->search) {
			foreach (explode(",", Request()->search) as $tag) {
				$searchTags[] = [
					'match_phrase' => [
						'tags.name' => $tag
					]
				];
			}
			$searchQuery = [
				'query' => [
					'bool' => [
						'should' => $searchTags,
//                        'minimum_should_match' => '80%'
					],
				],
			];
		}
		
		if (Request()->category) {
			$searchQuery['post_filter'] = [
				'term' => ['section_category.slug.keyword' => Request()->category]
			];
		}
		
		if (Request()->section_collection) {
			$searchQuery['post_filter'] = [
				'term' => ['sections_collections.keyword' => Request()->section_collection]
			];
		}
		
		$size = 3;
		$searchQuery['from'] = $size * ((int)Request()->page - 1);
		$searchQuery['size'] = $size;
		
		$searchQuery['sort'] = [
			'_score' => [
				'order' => 'desc'
			],
			'last_updated' => [
				'order' => 'desc'
			]
		];
		
		$filter = [];


//		if (request()->prod) {
//			$filter[] = [
//				'term' => [
//					'production_section' => true
//				]
//			];
//		}
//
//		if (request()->draft) {
//			$filter[] = [
//				'term' => [
//					'beta_section' => true
//				]
//			];
//		}
//
//		if (request()->model) {
//			$filter[] = [
//				'term' => [
//					'model' => true
//				]
//			];
//		}

		$prod = ['term' => [
			'production_section' => request()->prod == 1 ? true : false
		]];


		$draft = ['term' => [
            'beta_section' => request()->draft == 1 ? true : false
//			'beta_section' => true
		]];

		$model = ['term' => [
			'model_section' => request()->model == 1 ? true : false
		]];

		array_push($filter, $prod, $draft, $model);
//		array_push($filter, $draft);

		$searchQuery['query']['bool']['must'][]['bool']['should'] = $filter;

		
		$results = Section::searchRaw($searchQuery);
		$sections = new Collection();
		
		foreach ($results['hits']['hits'] as $hit) {
			$section = new Section($hit['_source']);
			$section->id = $hit['_id'];
			$sections->add($section);
		}
		
		$sections->each(function ($section) {
			$section->rendered_html = $section->html_code->getRenderedHtml();
			$section->preview_html = $section->html_code->getRenderedHtml();
			$section->html = $section->html_code->getRenderedHtml();
			$customCss = $section->css ?? '';
			
			foreach ($section->cssModules as $css_module) {
				$customCss .= $css_module->code;
			}
			
			$section->css_code = $customCss;
			
			$section->javascript_code = $section->js->code();
			
			$dependencies = $section->dependencies;
			
			$cssDependencies = $dependencies->filter(function ($dependency) {
				return $dependency->type == 1;
			})->pluck('url');
			
			$cssDependencies->prepend('https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css');
			
			$jsDependencies = $dependencies->filter(function ($dependency) {
				return $dependency->type == 2;
			})->pluck('url');
			
			$section->css_dependencies = $cssDependencies->map(function ($dependency) {
				return '<link rel="stylesheet" href="' . $dependency . '"/>';
			});
			
			$section->js_dependencies = $jsDependencies->map(function ($dependency) {
				return '<script type="text/javascript" src="' . $dependency . '"></script>';
			});
		});
		
		// return $sections;
		
		return new Paginator($sections, $sections->count(), Request()->page);
	}
}
