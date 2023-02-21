<?php

namespace App\Domain\Onboarding;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain\Onboarding\OnboardingSurvey
 *
 * @property int $id
 * @property int $user_id
 * @property int $title_id
 * @property int $website_type_id
 * @property string|null $custom_title
 * @property string|null $custom_website_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurvey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurvey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurvey query()
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurvey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurvey whereCustomTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurvey whereCustomWebsiteType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurvey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurvey whereTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurvey whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurvey whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnboardingSurvey whereWebsiteTypeId($value)
 * @mixin \Eloquent
 */
class OnboardingSurvey extends Model
{
    protected $fillable = ['user_id', 'title_id', 'website_type_id', 'custom_title', 'custom_website_type'];
}
