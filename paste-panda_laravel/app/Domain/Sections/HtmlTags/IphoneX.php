<?php


namespace App\Domain\Sections\HtmlTags;

class IphoneX extends HtmlBaseTag
{
    public function createNode($domDocument) : \DOMElement
    {
        $newNode = $domDocument->createElement('div');

        $newNode->setAttribute('class', $this->getNode()->getAttribute('class') . ' iphone-x');
        
        $iphoneSpeakerDiv = $domDocument->createElement('div');
        $iphoneSpeakerDiv->setAttribute('class', 'iphone-x-speaker');
	
	    $newNode->appendChild($iphoneSpeakerDiv);

        $iphoneMicrophoneDiv = $domDocument->createElement('div');
        $iphoneMicrophoneDiv->setAttribute('class', 'iphone-x-microphone');
	
	    $newNode->appendChild($iphoneMicrophoneDiv);

        $containerDiv = $domDocument->createElement('div');
        $containerDiv->setAttribute('class', 'is-relative is-fullheight is-fullwidth');
        $containerDiv->setAttribute('style', 'left: 0; right: 0; top: 0; bottom: 0; position: absolute;');

        foreach ($this->getNode()->attributes as $attribute) {
            if ($this->attributeShouldBeExcluded($attribute)) {
	            $containerDiv->setAttribute($attribute->nodeName, $attribute->nodeValue);
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
        return ['class', 'src'];
    }

    public function classes(): array
    {
        return [];
    }

    public function styles(): array
    {
    	$result = [];
	
	    foreach ($this->getNode()->attributes as $attribute) {
		    if($attribute->nodeName == 'tilt-right'){
			    $result[] = 'transform: rotate(2.5deg)';
		    }
		
		    if($attribute->nodeName == 'tilt-left'){
			    $result[] = 'transform: rotate(-2.5deg)';
		    }
    	}
	    
	    return $result;
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
