<?php

namespace App\Domain\Users;

use App\Domain;
use App\Domain\ReferralSystem\Models\ReferralReward;
use App\Domain\Sections\Models\Section;
use App\Domain\Sections\Models\SectionCategory;
use App\Fragment;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Junaidnasir\Larainvite\InviteTrait;
use Laravel\Passport\HasApiTokens;
use Questocat\Referral\Traits\UserReferral;

/**
 * App\Domain\Users\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $referred_by
 * @property string $affiliate_id
 * @property string $first_name
 * @property string $last_name
 * @property int|null $brand_id
 * @property int|null $color_scheme_set_id
 * @property int|null $color_scheme_id
 * @property int $onboarded
 * @property int $programming_language_id
 * @property int $survey_answered
 * @property int $show_onboarding
 * @property-read \App\Domain\Brand\Models\Brand|null $brand
 * @property-read \App\Domain\ColorThemes\ColorScheme|null $colorScheme
 * @property-read \App\Domain\ColorThemes\ColorSchemeSet|null $colorTheme
 * @property-read \Illuminate\Database\Eloquent\Collection|\Junaidnasir\Larainvite\Models\LaraInviteModel[] $invitations
 * @property-read int|null $invitations_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $referrals
 * @property-read int|null $referrals_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $verified_referrals
 * @property-read int|null $verified_referrals_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User referralExists($referral)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAffiliateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereColorSchemeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereColorSchemeSetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOnboarded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProgrammingLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereReferredBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShowOnboarding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurveyAnswered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
	use InviteTrait;
	use Notifiable;
	use HasApiTokens;
	
	use UserReferral {
		getReferralLink as getReferralLink;
	}
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name', 'last_name', 'name', 'email', 'password', 'referred_by', 'brand_id', 'color_scheme_set_id', 'color_scheme_id', 'onboarded', 'programming_language_id',
		'survey_answered', 'show_onboarding', 'section_id', 'fragment_id'
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	
	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];
	
	public function referrals()
	{
		return $this->hasMany(User::class, 'referred_by');
	}
	
	public function verified_referrals()
	{
		return $this->hasMany(User::class, 'referred_by')
			->whereNotNull('email_verified_at');
	}
	
	public function getReferralLink()
	{
		return route('referral.show', ['ref' => $this->affiliate_id]);
	}
	
	public function getReferralRewards()
	{
		$verified_referrals_count = $this->verified_referrals()->count();
		
		return ReferralReward::where('referrals_needed', '<=', $verified_referrals_count)->get();
	}
	
	public function getShortName()
	{
		return $this->first_name . ' ' . $this->last_name;
		
		$pieces = explode(' ', $this->name);
		
		if (count($pieces) > 1) {
			return $pieces[0] . ' ' . $pieces[count($pieces) - 1] . '.';
		}
		
		return $this->name;
	}
	
	public function getNameInitials()
	{
		return substr($this->first_name, 0, 1) . substr($this->last_name, 0, 1);
		
		$pieces = explode(' ', $this->name);
		
		if (count($pieces) > 1) {
			return substr($pieces[0], 0, 1) . substr($pieces[count($pieces) - 1], 0, 1);
		}
		
		return substr($this->name, 0, 1);
	}
	
	public function getNextReferralReward()
	{
		$rewards = ReferralReward::orderBy('referrals_needed', 'asc')->get();
		
		foreach ($rewards as $reward) {
			if ($reward->referrals_needed > \Auth::user()->verified_referrals()->count()) {
				return $reward;
			}
		}
	}
	
	public function isAdmin() : bool
	{
		$admins = ['vi.man93@gmail.com', 'viman@pastepanda.com', 'tommy@pastepanda.com', 'tim@pastepanda.com'];
		
		return in_array($this->email, $admins);
	}
	
	public function brand()
	{
		return $this->belongsTo(Domain\Brand\Models\Brand::class);
	}
	
	public function colorTheme()
	{
		return $this->belongsTo(Domain\ColorThemes\ColorSchemeSet::class, 'color_scheme_set_id');
	}
	
	public function colorScheme()
	{
		return $this->belongsTo(Domain\ColorThemes\ColorScheme::class);
	}
	
	public function getSections($category = null)
	{
		$surveyAnswered = $this->survey_answered;
		
		if ($category) {
			$sections = SectionCategory::whereSlug($category)->first()->sections()
				->where('beta_section', 1)
				->when($surveyAnswered, function ($query) {
					return $query->orWhere('survey_reward', 1);
				})
				->ordered()
				->get();
		} else {
			$sections = Section::where('beta_section', 1)
				->select(['id', 'html'])
				->when($surveyAnswered, function ($query) {
					return $query->orWhere('survey_reward', 1);
				})
				->ordered()
				->get();
		}
		
		
		return $sections;
	}
	
	public function shouldShowOnboarding(){
		return $this->show_onboarding == 1;
	}
	
	public function section(){
		return $this->belongsTo(Section::class);
	}
	
	public function fragment(){
		return $this->belongsTo(Fragment::class);
	}
}
