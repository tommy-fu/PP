<?php

namespace App\Models;

use App\Domain\Sections\Models\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SectionCollectionSection extends Pivot
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->section->save();
        });

        static::deleted(function ($model) {
            $model->section->save();
        });
    }
}
