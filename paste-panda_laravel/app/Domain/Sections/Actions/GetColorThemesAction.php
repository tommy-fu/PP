<?php

namespace App\Domain\Sections\Actions;

use App\Domain\ColorThemes\ColorSchemeSet;

class GetColorThemesAction
{
    public function execute()
    {
        $themes = ColorSchemeSet::with('colorSchemes')
            ->whereNull('user_id')
            ->where('public', 1)
            ->select(['id', 'name'])
            ->get();

        foreach ($themes as $theme) {
            foreach ($theme->colorSchemes as $colorScheme) {
                $colorScheme->colors = [
                    'bg_1' => $colorScheme->colors['background'],
                    'bg_2' => $colorScheme->colors['text'],
                    'bg_3' => $colorScheme->colors['primary'],
                    'bg_4' => $colorScheme->colors['secondary'],
                    'bg_5' => $colorScheme->colors['tertiary'],
                    'bg_6' => $colorScheme->colors['quaternary'],
                ];
            }
        }

        return $themes;
    }
}
