<?php

namespace App\Nova;

use Spatie\TagsField\Tags;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use App\Nova\Lenses\BetaSections;
use App\Domain\ColorThemes\Colors;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Metrixinfo\Nova\Fields\Iframe\Iframe;
use App\Nova\Lenses\CopyFixedForBetaSections;
use App\Nova\Lenses\CopyNotFixedForBetaSections;

class Section extends Resource
{
	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = \App\Domain\Sections\Models\Section::class;

	/**
	 * The single value that should be used to represent the resource when being displayed.
	 *
	 * @var string
	 */
	public static $title = 'id';

	/**
	 * The columns that should be searched.
	 *
	 * @var array
	 */
	public static $search = [
		'id',
		'name'
	];

	public static $group = 'Sections';

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function fields(Request $request)
	{
		return [
			ID::make(__('ID'), 'id')->sortable(),

			Text::make('Name')
				->sortable()
				->rules('required', 'max:255'),

			Text::make('URL', function ($section) {
				return '<a href="' . route('sections.show', ['section' => $section->id]) . '">Edit</a>';
			})
				->asHtml(),

			//	        Code::make('Html')
			//		        ->sortable()
			//		        ->rules('required', 'max:255'),

			Number::make('order_column')
				->sortable(),
			//
			Belongsto::make('Category', 'section_category', SectionCategory::class)
				->nullable()
				->sortable(),

			Boolean::make('html_structured')
				->sortable(),

			Boolean::make('beta_section')
				->sortable(),

			Boolean::make('model_section')
				->sortable(),

			Boolean::make('production_ready')
				->sortable(),

			Boolean::make('copy_fixed')
				->sortable(),

			Number::make('desktop_preview_height'),

			Number::make('tablet_preview_height'),

			Number::make('mobile_preview_height'),

			//	        Tags::make('Tags'),

			BelongsToMany::make('dependencies'),


			BelongsToMany::make('Collections', 'collections', 'App\Nova\SectionCollection'),

			//	       Date::make('Approved At')
			//		       ->nullable()
			//		       ->sortable(),


			Iframe::make('HTML Content', function ($section) {
				$html = '<head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
                <link rel="stylesheet" href="/user-brands">
                </head>';
				Colors::initialize();
				$html .= '<body>';
				$html .= $section->html_code->getPreviewHtml();
				$html .= '</body>';
				return $html;
			}),


		];
	}

	/**
	 * Get the cards available for the request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function cards(Request $request)
	{
		return [];
	}

	/**
	 * Get the filters available for the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function filters(Request $request)
	{
		return [
			//        	new BetaSections
		];
	}

	/**
	 * Get the lenses available for the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function lenses(Request $request)
	{
		return [
			new BetaSections,
			new CopyNotFixedForBetaSections,
			new CopyFixedForBetaSections,
		];
	}

	/**
	 * Get the actions available for the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function actions(Request $request)
	{
		return [];
	}
}
