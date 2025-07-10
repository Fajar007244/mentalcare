<?php

namespace App\Policies;

use App\Models\ForumComment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ForumCommentPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ForumComment $forumComment): bool
    {
        return $user->role === 'admin' || $user->id === $forumComment->user_id;
    }
}