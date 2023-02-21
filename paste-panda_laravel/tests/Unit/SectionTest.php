<?php

namespace Tests\Unit;

use App\Domain\ColorThemes\ColorScheme;
use App\Domain\Sections\Models\Section;
use PHPUnit\Framework\TestCase;
use Tests\DbTestCase;

class SectionTest extends DbTestCase
{
 
	/** @test */
    public function it_can_be_ordered()
    {
	    $this->markTestSkipped();
	    
	    $section = Factory(Section::class)->create();
	    $this->assertNotNull($section->order_column);
	
	    $section2 = Factory(Section::class)->create([
	    	'order_column' => 2
	    ]);
	
	    $this->assertNotEquals($section->order_column, $section2->order_column);
	    $this->assertTrue($section->isFirstInOrder());
	    $this->assertTrue($section2->isLastInOrder());
    }
}
