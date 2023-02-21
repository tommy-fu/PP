<?php

namespace Tests\Feature\Users;

use App\Domain\ColorThemes\ColorScheme;
use App\Domain\ColorThemes\ColorSchemeSet;
use App\Domain\Users\User;
use Tests\DbTestCase;

class UserColorSchemeTest extends DbTestCase
{
    /** @test */
    public function a_user_can_select_a_color_theme()
    {
        $colorSchemeSet = Factory(ColorSchemeSet::class)->create();

        $colorSchemes = Factory(ColorScheme::class, 5)->create([
            'color_scheme_set_id' => $colorSchemeSet->id,
        ]);

        $user = Factory(User::class)->create();

        $this->be($user);
        
        $this->patch(route('user-color-schemes.update', $colorSchemes->first()->id))->assertSessionHasNoErrors()
            ->assertStatus(302);

        $this->assertEquals($colorSchemes->first()->id, $user->fresh()->colorScheme->id);
    }
}
