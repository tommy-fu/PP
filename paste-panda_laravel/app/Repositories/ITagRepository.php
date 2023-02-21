<?php


namespace App\Repositories;


use Illuminate\Support\Collection;

interface ITagRepository
{
	public function getAll() : Collection;
	
	public function getByString(string $query) : Collection;
}
