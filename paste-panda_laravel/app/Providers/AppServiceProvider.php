<?php

namespace App\Providers;

use App\Models\LookupTag;
use App\Observers\LookupTagObserver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\ServiceProvider;
use PHPUnit\Framework\Assert;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Collection::macro('pipe', function ($callback) {
			return $callback($this);
		});



		Collection::macro('getCssStyle', function ($key) {
			return $this->first(function ($style) use ($key) {
				return $style->getClassName() == $key;
			});
		});

		Collection::macro('getCssStyleValue', function ($key, $value) {
			$cssStyle = $this->getCssStyle($key);

			return collect($cssStyle->getStyles())
				->first(function ($style) use ($value) {
					return $style['key'] == $value;
				})['value'];
		});



		Collection::macro('assertCssStyleValue', function ($key, $cssValue, $value) {
			$cssStyle = $this->getCssStyle($key);

			$cssStyle = collect($cssStyle->getStyles())
				->first(function ($style) use ($cssValue) {
					return $style['key'] == $cssValue;
				})['value'];

			Assert::assertEquals($value, $cssStyle);
		});


		Collection::macro('getNth', function ($n) {
			return $this->slice($n, 1)->first();
		});

		LookupTag::observe(LookupTagObserver::class);
	}
}
