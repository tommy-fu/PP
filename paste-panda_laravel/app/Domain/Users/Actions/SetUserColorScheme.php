<?php

namespace App\Domain\Users\Actions;

use App\Domain\ColorThemes\ColorScheme;
use Illuminate\Support\Facades\Auth;

class SetUserColorScheme
{
    public function execute($id)
    {
        $colorTheme = ColorScheme::findOrFail($id);

        Auth::user()->update([
            'color_scheme_id' => $colorTheme->id,
            'color_scheme_set_id' => $colorTheme->color_scheme_set_id,
        ]);
    }
}
