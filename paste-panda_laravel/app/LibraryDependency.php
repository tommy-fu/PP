<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LibraryDependency
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryDependency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryDependency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryDependency query()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryDependency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryDependency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryDependency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryDependency whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryDependency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryDependency whereUrl($value)
 * @mixin \Eloquent
 */
class LibraryDependency extends Model
{
    protected $fillable = ['name', 'url', 'type'];
}
