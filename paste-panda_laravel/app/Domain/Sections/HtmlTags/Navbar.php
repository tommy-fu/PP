<?php

namespace App\Domain\Sections\HtmlTags;

use DOMElement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Navbar extends HtmlBaseTag
{
	
	private $height = '128px';
	
    public function createNode($domDocument): DOMElement
    {
        $newNode = $domDocument->createElement('header');
        $newNode->setAttribute('id', 'navbar');
        $newNode->setAttribute('class', $this->getNode()->getAttribute('class'));

        $this->appendChildNodesFromRoot($newNode);

        return $newNode;
    }

    public function css(): string
    {
        $params = array_merge([
            'scheme' => Auth::user()->colorScheme->colors,
        ], $this->bladeParameters());
        
        return View::file(resource_path('custom_components/navbar/navbar_css.blade.php'), $params)->render();
    }

    public function bladeParameters(): array
    {
        $result = [
        	'height' => $this->height,
        ];

        if ($this->getNode()->hasAttribute('filled')) {
            $result['background'] = true;
        }

        return $result;
    }


    public function javaScript(): string
    {
	    return View::file(resource_path('custom_components/navbar/navbar_js.blade.php'), [
		    'scheme' => Auth::user()->colorScheme->colors,
	    ])->render();
    }
}
