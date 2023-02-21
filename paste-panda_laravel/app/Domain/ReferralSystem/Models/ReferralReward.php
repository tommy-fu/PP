<?php

namespace App\Domain\ReferralSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Domain\ReferralSystem\Models\ReferralReward
 *
 * @property int $id
 * @property string $name
 * @property int $referrals_needed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $description
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-write mixed $file
 * @property-write mixed $zip
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralReward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralReward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralReward query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralReward whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralReward whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralReward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralReward whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralReward whereReferralsNeeded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralReward whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReferralReward extends Model  implements HasMedia
{
	use InteractsWithMedia;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'referral_rewards';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
	
	public function setFileAttribute($value)
	{
		$attribute_name = "file";
		$disk = "public";
		$destination_path = "rewards";
		
		$this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
		
		// return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
	}
	
	public function setZipAttribute($value)
	{
//		$attribute_name = "image";
//		$disk = "public";
//		$destination_path = "folder_1/subfolder_1";
//
//		$this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
		
		// return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
	}
	
	public static function boot()
	{
		parent::boot();
	}
}
