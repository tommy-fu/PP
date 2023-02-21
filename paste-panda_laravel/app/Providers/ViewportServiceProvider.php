<?php

namespace App\Providers;

use App\Domain\Brand\CssStyleBuilder\Viewports\DesktopCssStyle;
use App\Domain\Brand\CssStyleBuilder\Viewports\LandscapeCssStyle;
use App\Domain\Brand\CssStyleBuilder\Viewports\TabletCssStyle;
use Illuminate\Support\ServiceProvider;

class ViewportServiceProvider extends ServiceProvider
{
	
	private $viewports = [
		LandscapeCssStyle::class,
		TabletCssStyle::class,
		DesktopCssStyle::class,
	];
	
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
	}
}
