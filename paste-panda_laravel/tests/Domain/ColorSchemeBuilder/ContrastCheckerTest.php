<?php

namespace Tests\Domain\ColorSchemeBuilder;

use App\Domain\ColorSchemeBuilder\ContrastChecker;
use PHPUnit\Framework\TestCase;

class ContrastCheckerTest extends TestCase
{
	
	
	/** @test */
	
	function it_can_select_the_contrast_with_highest_luminosity() {
		$this->assertEquals('#FFFFFF', ContrastChecker::getBestContrast('000000', 'ffffff', '000000'));
		$this->assertEquals('#000000', ContrastChecker::getBestContrast('ffffff', '000000', 'ffffff'));
		$this->assertEquals('#1D1F1D', ContrastChecker::getBestContrast('88bb88', '1D1F1D', 'ffffff'));
	}
}
