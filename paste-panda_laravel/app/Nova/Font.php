<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Font extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Domain\Brand\Font::class;

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
    ];
	
	public static $group = 'Styles';
	
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
	        
//	        Text::make('Name')
//		        ->sortable()
//		        ->rules('required', 'max:255'),
	        
	        BelongsTo::make('Font Family', 'fontFamily', FontFamily::class)
	        ->sortable(),
	        
	        Files::make('Font File', 'font'),
	        
	        Select::make('Font Weight')
	        ->options([
		        '100' => 'Thin - 100',
		        '200' => 'Extra-Light - 200',
		        '300' => 'Light - 300',
		        '400' => 'Regular - 400',
		        '500' => 'Medium - 500',
		        '600' => 'Semi-bold - 600',
		        '700' => 'Bold - 700',
		        '800' => 'Extra-Bold - 800',
		        '900' => 'Black - 900',
	        ])
	        
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
