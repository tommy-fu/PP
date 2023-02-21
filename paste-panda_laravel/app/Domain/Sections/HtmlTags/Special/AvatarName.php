<?php

namespace App\Domain\Sections\HtmlTags\Special;

use App\Domain\Sections\HtmlTags\HtmlModelBase;
use Illuminate\Support\Collection;

class AvatarName extends HtmlModelBase
{
	public function getAttributes(): Collection
	{
		return collect(['class', 'style', 'src']);
	}
	
	public function __construct($node, $config)
	{
		$node['children'][] = [
			'element' => '#text',
			'wholeText' => app('avatars')->getCurrentAvatar()->name,
		];
		
		parent::__construct($node, $config);
	}
}
