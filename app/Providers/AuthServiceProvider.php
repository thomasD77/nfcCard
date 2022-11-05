<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Member;
use App\Models\User;
use App\Policies\ContactPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Check the roles
        Gate::define('is_superAdmin', function ($user){
            $permission = 'is_superAdmin';
            return $user = $user->permissions()->contains($permission);
        });

        Gate::define('is_admin', function ($user){
            $permission = 'is_admin';
            return $user = $user->permissions()->contains($permission);
        });

        Gate::define('is_client', function ($user){
            $permission = 'is_client';
            return $user = $user->permissions()->contains($permission);
        });


        //Check if user has access to detail page
        Gate::define('hasAccessCheckMember', function ($user, $member){

            if($member){
                $member = Member::findOrFail($member);

                if($user->roles->first()->name == 'client')
                {
                    if($member->id != Auth::user()->member_id){
                        return false;
                    }
                }
                elseif ($user->roles->first()->name == 'admin')
                {
                    if($member->user->team_id != $user->team_id){
                        return false;
                    }
                }
                return true;
            } else {
                return true;
            }
        });

        Gate::define('hasAccessCheckContact', function ($user, $contact){

            if($contact){
                if($user->roles->first()->name == 'client')
                {
                    if($contact->member_id != Auth::user()->member_id){
                        return false;
                    }
                }
                elseif ($user->roles->first()->name == 'admin')
                {
                    if($contact->member->user->team_id != $user->team_id){
                        return false;
                    }
                }
                return true;
            } else {
                return true;
            }

        });

        Gate::define('hasAccessCheckUser', function ($user, $currentUser){

            if($currentUser){
                $currentUser = User::findOrFail($currentUser);

                if($user->roles->first()->name == 'client')
                {
                    if($currentUser->id != Auth::user()->id){
                        return false;
                    }
                }
                elseif ($user->roles->first()->name == 'admin')
                {
                    if($currentUser->team_id != $user->team_id){
                        return false;
                    }
                }

                return true;
            } else {
                return true;
            }
        });

        Gate::define('hasAccessCheckLocation', function ($user, $location){

            if($location) {
                if($location->user_id == Auth::user()->id){
                    return true;
                }else {
                    return false;
                }
            }
        });

    }
}
