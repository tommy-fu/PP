<?php

namespace App\Providers;

use App\Domain\Users\User;
use App\Policies\InvitationPolicy;
use App\Policies\SuperAdminPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Junaidnasir\Larainvite\Models\LaraInviteModel;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
//         User::class => SuperAdminPolicy::class
	    LaraInviteModel::class => InvitationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
