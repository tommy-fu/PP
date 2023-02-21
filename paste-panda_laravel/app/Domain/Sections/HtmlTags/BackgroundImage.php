<?php


namespace App\Domain\Sections\HtmlTags;

class BackgroundImage extends HtmlBaseTag
{
	
	public $name = 'background-image';
	
    public function createNode($domDocument) : \DOMElement
    {
        $newNode = $domDocument->createElement('div');

        $containerDiv = $domDocument->createElement('div');
        $containerDiv->setAttribute('class', 'is-relative');
        $containerDiv->setAttribute('style', 'z-index: 5');

        foreach ($this->getNode()->attributes as $attribute) {
            if ($this->attributeShouldBeExcluded($attribute)) {
                $newNode->setAttribute($attribute->nodeName, $attribute->nodeValue);
            }
        }

        foreach ($this->getNode()->childNodes as $node) {
            $containerDiv->appendChild($node->cloneNode(true));
        }

        $newNode->appendChild($containerDiv);

        return $newNode;
    }

    public function excludedAttributes() : array
    {
        return ['src'];
    }

    public function classes(): array
    {
        return ['is-relative', 'is-clipped', 'is-fullwidth', 'has-overlay-solid'];
    }

    public function styles(): array
    {
        $src = $this->getNode()->getAttribute('src');

        if (!$src) {
            return [];

            $index = !empty($this->getNode()->getAttribute('image-index')) ? $this->getNode()->getAttribute('image-index') : null;

            $img = app('unsplash-images')->getImageByIndex($index);

            $blend = app('colors')['background_image-blend'];

            $blend = str_replace('#', '', $blend);

            $saturation = app('colors')['background_image-saturation'];

            if ($img) {
                $src = $img->img_url . '?fit=crop&crop=entropy&blend=' . $blend . '&blend-mode=multiply';

                if ($saturation) {
                    $src .= '&sat=' . $saturation;
                }
            }
        }

        return ["background: url('" . $src . "')", 'background-repeat: no-repeat', 'background-size: cover', 'z-index: 2'];
    }

    /**
     * @param $attribute
     * @return bool
     */
    protected function attributeShouldBeExcluded($attribute): bool
    {
        return !in_array($attribute->nodeName, $this->excludedAttributes());
    }
}
