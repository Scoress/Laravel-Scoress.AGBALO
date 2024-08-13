<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post)
    {
        // L'utilisateur peut mettre à jour le post s'il est le créateur
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post)
    {
        // L'utilisateur peut supprimer le post s'il est le créateur
        return $user->id === $post->user_id;
    }
}
