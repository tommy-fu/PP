<?php

namespace App\Services;


use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;

class ImagesService
{
	
	function addOrReplace(HasMedia $model, $file, $collectionName)
	{
//		if ( base64_encode(base64_decode($file, true)) === $file){
		if ($file == null) return;
		
		if (!filter_var($file, FILTER_VALIDATE_URL)) {
			$model->clearMediaCollection($collectionName);
			
			$model->addMediaFromBase64($file)
				->usingFileName(Str::random() . '.png')
				->addCustomHeaders([
					'ACL' => 'public-read',
				])
				->withResponsiveImages()
				->toMediaCollection($collectionName);
		}
	}
	
	function addToCollection(HasMedia $model, $file, $collectionName)
	{
		$hashName = $file->hashName();
		
		$model->addMedia($file)
			->usingFileName($hashName)
			->addCustomHeaders([
				'ACL' => 'public-read'
			])
			->withResponsiveImages()
			->toMediaCollection($collectionName);
	}
	
	function addOrReplaceFiles(HasMedia $model, $file, $collectionName)
	{
//		if ( base64_encode(base64_decode($file, true)) === $file){
		if ($file == null) return;
//		dd($file);
		$model->clearMediaCollection($collectionName);
		
		$model->addMedia($file)
			->addCustomHeaders([
				'ACL' => 'public-read',
			])
			->toMediaCollection($collectionName);
	}
	
	function addFilesToCollectionFromRequest(HasMedia $model, $files, $collectionName)
	{
		if ($files) {
			foreach ($files as $key => $file) {
				$this->addToCollection($model, $file, $collectionName);
			}
		}
	}
	
	public function clearFilesByURL(HasMedia $model, $urls, $collectionName)
	{
		
		if ($urls == null) $urls = [];
		
		$model->clearMediaCollectionExcept($collectionName, $model->getMedia($collectionName)
			->whereIn('url', $urls));
	}
}
