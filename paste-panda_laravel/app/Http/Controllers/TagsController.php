<?php

namespace App\Http\Controllers;

use App\LookupTagIndexConfigurator;
use App\Repositories\ITagRepository;
use App\Services\ElasticService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(ITagRepository $tagRepository)
	{
		return Cache::rememberForever(Request()->tag, function () use ($tagRepository) {
			
			return $tagRepository->getByString(Request()->tag);
		});
	}
}
