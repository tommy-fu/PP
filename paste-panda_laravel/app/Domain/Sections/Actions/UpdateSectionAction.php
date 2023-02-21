<?php

namespace App\Domain\Sections\Actions;

use App\Domain\Sections\Models\Section;

class UpdateSectionAction
{
    public function execute(Section $section, $data)
    {
        $section->update([
            'html' => $data['html'],
            'css' => $data['css'] ?? '',
            'javascript' => $data['javascript'] ?? '',
            'approved_at' => null,
        ]);
    }
}
