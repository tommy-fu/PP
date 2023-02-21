<?php

namespace Tests\Unit;

use Kitspring\SpacingModule\Converter;

class SpacingTest extends \PHPUnit\Framework\TestCase
{
	/** @test
	 * @dataProvider files
	 */
	function spacing_test($testfile, $result)
	{
		$initial = file_get_contents(__DIR__ . '/' . $testfile . '.html');
		$result = file_get_contents(__DIR__ . '/' . $result . '.html');

		$converter = new Converter();
		$foo = $converter->convertHtml($initial);

		$this->assertEquals($result, $foo);
	}

	function files()
	{
		// return [
		// 	['special3','special3-res']
		// ];

		$images = scandir(__DIR__.'/', 1);
		foreach ($images as $i) {
			if (preg_match("/(.*[^res])\.html/", $i, $matches)) {
				$l[] = [$matches[1], $matches[1] . '-res'];
			}
		}
		return $l;
	}
}
