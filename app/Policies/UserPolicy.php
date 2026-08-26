<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, User $target): bool
    {
        return $user->id === $target->id || $user->isAdmin();
    }

    public function delete(User $user, User $target): bool
    {
        return $user->isAdmin();
    }
}
