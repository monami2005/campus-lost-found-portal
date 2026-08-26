<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;

class ItemPolicy
{
    public function create(User $user): bool
    {
        return $user->role !== 'suspended';
    }

    public function update(User $user, Item $item): bool
    {
        return $user->id === $item->user_id || $user->isAdmin();
    }

    public function delete(User $user, Item $item): bool
    {
        return $user->id === $item->user_id || $user->isAdmin();
    }
}
