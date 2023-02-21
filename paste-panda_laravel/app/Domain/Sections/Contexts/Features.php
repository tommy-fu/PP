<?php

namespace App\Domain\Sections\Contexts;

class Features
{
    private $texts;
    private $currentText;
	private $originalTexts;
	
	public function __construct()
    {
        $this->originalTexts = collect([
                [
                    'title' => 'Sit Etiam Dolor.',
                    'description' => 'Et vitae sed purus dolor enim porta ac lorem nulla sit sollicitudin in sit tellus porttitor.',
                ],
                [
                    'title' => 'Ornare Vitae.',
                    'description' => 'Lacinia tortor, faucibus enim integer mi, lorem arcu, pellentesque ornare ultrices erat et, nunc vitae fames',
                ],
                [
                    'title' => 'Ullamcorper Mi.',
                    'description' => 'Non tellus id iaculis nisl urna arcu ullamcorper vitae, mi pharetra nec amet sapien et nec',
                ],
                [
                    'title' => 'Nulla Nec Sit.',
                    'description' => 'Nulla feugiat dui nulla vel dictumst nullam et sit eget commodo nec ut non nisl, malesuada',
                ],
            ]);
        
        $this->texts = clone $this->originalTexts;
    }

    public function getTexts()
    {
        return $this->texts;
    }

    public function retrieveNewText()
    {
    	$this->currentText = $this->texts->shuffle()
		    ->first();
    	
    	$this->texts->filter(function($text){
    		return $text['title'] != $this->currentText['title'];
	    });
    }
	
	public function getCurrentText(){
		return $this->currentText;
    }
}
