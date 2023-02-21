<?php

namespace Tests\Feature\Sections\Elements;

use App\Domain\Sections\Actions\GetAvatars;
use App\Domain\Sections\HtmlSections\Avatars;
use App\Domain\Sections\Models\Avatar;
use Tests\DbTestCase;

class AvatarsFeatureTest extends DbTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_get_avatars()
    {
        Factory(Avatar::class, 5)->create([
            'gender' => 0,
        ]);

        Factory(Avatar::class, 5)->create([
            'gender' => 1,
        ]);

        $avatarService = new Avatars();

        $male = $avatarService->getAvatar('male');
        $this->assertEquals('male', $male->gender);
        
        $female = $avatarService->getAvatar('female');
        
        $this->assertEquals('female', $female->gender);
    }
	
	
	/** @test
	 * @param GetAvatars $getAvatars
	 */
	public function it_can_get_avatars_from_cache()
	{
		Factory(Avatar::class, 10)->create();
		
		$this->assertCount(10, (new GetAvatars())->execute());
	}
}
