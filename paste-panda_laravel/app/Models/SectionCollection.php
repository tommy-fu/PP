<?php

namespace App\Models;

use App\Domain\Sections\Models\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionCollection extends Model
{
	use HasFactory;

	public function sections()
	{
		return $this->belongsToMany(Section::class, 'section_collection_sections');
	}

	public function searchableAs()
	{
		return '_doc';
	}

	protected $fillable = ['name'];
}
