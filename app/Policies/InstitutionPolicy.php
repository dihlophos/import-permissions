<?php

namespace App\Policies;

use App\Models\User;
use Gate;
use App\Models\Institution;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstitutionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can attach users to storages.
     *
     * @param  \App\User  $user
     * @param  \App\Institution  $institution
     * @return mixed
     */
    public function attachUsersToStorages(User $user, Institution $institution)
    {
        if ($user->RoleName() === "instspec") { return false; }

        if (($user->RoleName() === "instadmin") && ($user->institution->id !== $institution->id)) { return false; }

        return true;
    }
}
