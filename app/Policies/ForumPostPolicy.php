<?php

namespace App\Policies;

use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ForumPostPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ForumPost $forumPost): bool
    {
        return $user->role === 'admin' || $user->id === $forumPost->user_id;
    }
}