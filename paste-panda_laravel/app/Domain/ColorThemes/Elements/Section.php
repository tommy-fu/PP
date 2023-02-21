<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyleBuilder;
use App\Domain\Brand\CssStyleBuilder\ICssStyleBuilder;
use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use App\Domain\Brand\Models\Brand;

class Section implements IStyleVariable
{
	public static $items = [
		[
			'key' => 'section',
		],
	];
	
	public static $attributes = [];
	
	final protected static function styleBase()
	{
		return [
			'base_styles' => [
				'padding-left' => '32px',
				'padding-right' => '32px',
			],
			'mobile_styles' => [
			],
			'tablet_styles' => [
			],
			'desktop_styles' => [
			],
		];
	}
	
	public static function makeStyle(): array
	{
		$res = [];
		
		foreach (self::$items as $card) {
			$res[$card['key']] = array_merge(self::styleBase(), ['type' => 'section']);
		}
		
		return $res;
	}
	
	public static function make($className, $styleItem, $colorVariable)
	{
		$builder = new CssStyleBuilder();
		
		$builder->setClassName($className);
		$builder->setColorVariable($colorVariable);
		$builder->setUsesColorVariable(false);
		$builder->setAttributes(self::$attributes);
		//		$builder->setBaseStyles(self::$baseStyles);
		$builder->setStyleItem(Brand::getVariable($styleItem));
		
		return $builder;
	}
	
	public static function getBuilder($className, $styleItem, $colorVariable): ICssStyleBuilder
	{
		$builder = new CssStyleBuilder();
		
		$builder->setClassName($className);
		$builder->setColorVariable($colorVariable);
		$builder->setUsesColorVariable(false);
		$builder->setAttributes(self::$attributes);
		//		$builder->setBaseStyles(self::$baseStyles);
		$builder->setStyleItem(Brand::getVariable($styleItem));
		
		return $builder;
	}
	
	public static function makeCssStyle() : CssStyle
	{
		$builder = static::make('section', 'section', 'section');
		
		return (new ResponsiveCssStyleDirector())->make($builder);
	}
}
