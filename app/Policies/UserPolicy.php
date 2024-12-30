<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function manageUser(User $user)
    {
        return $user->is_admin;
    }
}
