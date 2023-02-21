<?php

namespace Tests\Unit\ColorSchemes;

use App\Domain\ColorThemes\ColorScheme;
use App\Domain\ColorThemes\Mock\ColorSchemeMock;
use Tests\DbTestCase;

class ColorSchemesUnitTest extends DbTestCase
{
 
	
	/** @test */
	
    public function it_contains_card_text_styles()
    {
    	$data = (new ColorSchemeMock)->getVariables();
    	$this->assertArrayHasKey('card_mega', $data);
    }
	
	/** @test */
	
	public function it_has_an_order_column()
	{
		$colorScheme = Factory(ColorScheme::class)->create();
		$this->assertNotNull($colorScheme->order_column);
		
		$colorScheme2 = Factory(ColorScheme::class)->create([
			'order_column' => 2
		]);
		
		$this->assertNotEquals($colorScheme->order_column, $colorScheme2->order_column);
		$this->assertTrue($colorScheme->isFirstInOrder());
		$this->assertTrue($colorScheme2->isLastInOrder());
	}

}
