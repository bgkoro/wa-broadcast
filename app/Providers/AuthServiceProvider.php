<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('has-permission', function (User $user, $permissions) {
            $hasPermission = false;

            if (!$user->role) return Response::denyAsNotFound();

            $userPermissions = $user->role->permission()->wherePivot('role_id', $user->role_id)->get();

            if (!is_array($permissions)) {
                $hasPermission = $userPermissions->contains('name', $permissions);
            } else {
                foreach ($permissions as $permission) {
                    if ($userPermissions->contains('name', $permission)) {
                        $hasPermission = true;
                    }
                }
            }

            return $hasPermission ? Response::allow() : Response::deny('You do not have permission to perform this action. Please contact your administrator.');
        });
    }
}
