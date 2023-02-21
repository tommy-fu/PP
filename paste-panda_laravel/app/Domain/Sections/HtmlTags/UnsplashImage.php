<?php

namespace App\Domain\Sections\HtmlTags;

use DOMElement;

class UnsplashImage extends HtmlBaseTag
{
    public function createNode($domDocument): DOMElement
    {
        $newNode = $domDocument->createElement('img');

        $index = $newNode->getAttribute('image-index') ?? null;

        $img = app('unsplash-images')->getImageByIndex($index);

        $blend = app('colors')['image-blend'];

        $blend = str_replace('#', '', $blend);

        $saturation = app('colors')['image-saturation'];

        $sat = '';

        if ($saturation) {
            $sat .= '&sat=' . $saturation;
        }

        if ($img) {
            $newNode->setAttribute('src', $img->img_url . '?fit=crop&crop=entropy&blend=' . $blend . '&blend-mode=multiply' . $sat);
        }
	
	    $newNode->setAttribute('class', $this->getNode()->getAttribute('class'));
	    $newNode->setAttribute('style', $this->getNode()->getAttribute('style'));
	    
        return $newNode;
    }
}
