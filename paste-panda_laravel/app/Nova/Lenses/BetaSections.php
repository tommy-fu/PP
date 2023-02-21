<?php

namespace App\Nova\Lenses;

use App\Nova\SectionCategory;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;

class BetaSections extends Lens
{
	/**
	 * Get the query builder / paginator for the lens.
	 *
	 * @param \Laravel\Nova\Http\Requests\LensRequest $request
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return mixed
	 */
	public static function query(LensRequest $request, $query)
	{
		return $request->withOrdering($request->withFilters(
			
			$query->where('beta_section', true)
		));
	}
	
	/**
	 * Get the fields available to the lens.
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
			
			Belongsto::make('Category', 'section_category', SectionCategory::class)
				->nullable()
				->sortable(),
			
			Boolean::make('html_structured')
				->sortable(),
			
			Boolean::make('beta_section')
				->sortable(),
			
			Boolean::make('production_ready')
				->sortable(),
		];
	}
	
	/**
	 * Get the cards available on the lens.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function cards(Request $request)
	{
		return [];
	}
	
	/**
	 * Get the filters available for the lens.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function filters(Request $request)
	{
		return [];
	}
	
	/**
	 * Get the actions available on the lens.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function actions(Request $request)
	{
		return parent::actions($request);
	}
	
	/**
	 * Get the URI key for the lens.
	 *
	 * @return string
	 */
	public function uriKey()
	{
		return 'beta-sections';
	}
}
