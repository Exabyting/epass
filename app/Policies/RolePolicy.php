<?php

namespace App\Policies;

use App\Entities\User;
use App\Entities\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Role  $role
     * @return mixed
     */
    public function view(User $user)
    {
//        return $user->hasPermission('view', 'Role');
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Role  $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Role  $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }


    public function before($user, $ability)
    {
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            return true;
        }

        return false;
    }
}
