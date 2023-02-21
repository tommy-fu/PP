<?php

namespace App\Domain\Sections\HtmlSections;

use App\Domain\Sections\Models\Image;
use Illuminate\Support\Facades\Cache;

class UnsplashImages
{
	private $images;
	private $currentImage;
	/**
	 * @var Image[]|\Illuminate\Database\Eloquent\Collection
	 */
	private $originalImages;
	
	public function __construct()
	{
		$this->images = Cache::rememberForever('unsplash-images', function () {
			return Image::all();
		});
		
		$this->originalImages = clone $this->images;
	}
	
	public function getImage()
	{
		if ($this->images->count() == 0) {
			$this->images = Cache::rememberForever('unsplash-images', function () {
				return Image::all();
			});
		}
		
		$image = collect($this->images)
//            ->shuffle()
			->first();
		
		$this->images = collect($this->images)
			->filter(function ($avt) use ($image) {
				return $avt['id'] != $image['id'];
			});
		
		$this->currentImage = $image;
		
		return $image;
	}
	
	public function getImages()
	{
		return $this->images;
	}
	
	public function getImageByIndex($index)
	{
		if (!$index) {
			return $this->getImage();
		}
		
		if ($this->images->count() == 0) {
			$this->images = Cache::rememberForever('unsplash-images', function () {
				return Image::all();
			});
		}
		
		return $this->originalImages->first(function ($image) use ($index) {
			return $image->id == intval($index);
		});
	}
	
	public function getCurrentImage()
	{
		return $this->currentImage;
	}
}
