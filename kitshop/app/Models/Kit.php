<?php

namespace App\Models;

use App\Models\Tag;
use \Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Kit extends Model implements HasMedia
{
	use InteractsWithMedia;
    use HasFactory;
    use HasTags;

    protected $fillable = ['tags'];

    public static function getTagClassName(): string
    {
        return CustomTag::class;
    }

    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order_column');
    }

    public function extraTagsHover()
    {
        if ($this->tags->count() > 3) {
            return $this->tags->skip(3)->implode('name', ', ');
        }
    }   
    
    public function retrieveMedia($name)
    {
        $kit = Kit::where('name', $name)->get();
        
        foreach($kit as $k) {
            return $k->getFirstMediaUrl('thumbnail');
        }
    }
}
