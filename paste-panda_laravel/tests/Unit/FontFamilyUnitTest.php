<?php

namespace Tests\Unit;

use App\Domain\Brand\FontFamily;
use Tests\DbTestCase;

class FontFamilyUnitTest extends DbTestCase
{
    /** @test */
    public function it_has_fonts()
    {
        $fontFamily = Factory(FontFamily::class)->create();

        $this->assertEquals('Illuminate\Database\Eloquent\Collection', get_class($fontFamily->fonts));
    }
}
