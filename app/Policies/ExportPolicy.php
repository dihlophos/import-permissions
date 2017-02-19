<?php

namespace App\Policies;

use App\Models\User;
use Gate;
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
        if (Gate::denies('view-export', null)) { return false; }

        if ($user->RoleName() === "Специалист учреждения")
        {
            if (!$export->permissionSpecified())
            {
                return false;
            }
        }

        return true;
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
        if (Gate::denies('modify-export', null)) { return false; }

        if ($user->RoleName() === "Админастратор учреждения")
        {
            if ($export->permissionSpecified())
            {
                return false;
            }
        }

        return true;
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
        if (Gate::denies('process-export', null)) { return false; }

        if ($user->RoleName() === "Специалист учреждения")
        {
            if (!$export->permissionSpecified())
            {
                return false;
            }
        }

        return true;
    }

    /**
     * Determine whether the user can specify export number.
     *
     * @param  \App\User  $user
     * @param  \App\Export  $export
     * @return mixed
     */
    public function specifyPermission(User $user, Export $export)
    {
        if (Gate::denies('specify-export-permission', null)) { return false; }

        return true;
    }
}
