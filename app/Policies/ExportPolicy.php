<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Export;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the export.
     *
     * @param  \App\User  $user
     * @param  \App\Export  $export
     * @return mixed
     */
    public function view(User $user, Export $export)
    {
        if ($user->isAdmin()) 
        {
            return true;
        }

        if (($user->RoleName() === "Админастратор управления") || ($user->RoleName() === "Админастратор учреждения"))
        {
            return true;
        }

        if ($user->RoleName() === "Специалист учреждения")
        {
            if (!is_null($export->permission_num))
            {
                return true;
            }
        }

        return false;
    }

        /**
     * Determine whether the user can update the export.
     *
     * @param  \App\User  $user
     * @param  \App\Export  $export
     * @return mixed
     */
    public function update(User $user, Export $export)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if (($user->RoleName() === "Админастратор управления") || ($user->RoleName() === "Админастратор учреждения"))
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can process export products.
     *
     * @param  \App\User  $user
     * @param  \App\Export  $export
     * @return mixed
     */
    public function process(User $user, Export $export)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->RoleName() === "Специалист учреждения")
        {
            if (!is_null($export->permission_num))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can specify export number.
     *
     * @param  \App\User  $user
     * @param  \App\Export  $export
     * @return mixed
     */
    public function specifyNumber(User $user, Export $export)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->RoleName() === "Админастратор управления")
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create exports.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if (($user->RoleName() === "Админастратор управления") || ($user->RoleName() === "Админастратор учреждения"))
        {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the export.
     *
     * @param  \App\User  $user
     * @param  \App\Export  $export
     * @return mixed
     */
    public function delete(User $user, Export $export)
    {
        //
    }
}
