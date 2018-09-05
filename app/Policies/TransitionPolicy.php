<?php

namespace App\Policies;

use App\User;
use App\Transition;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransitionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the transition.
     *
     * @param  \App\User  $user
     * @param  \App\Transition  $transition
     * @return mixed
     */
    public function view(User $user, Transition $transition)
    {
        //
    }

    /**
     * Determine whether the user can create transitions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the transition.
     *
     * @param  \App\User  $user
     * @param  \App\Transition  $transition
     * @return mixed
     */
    public function update(User $user, Transition $transition)
    {
        //
    }

    /**
     * Determine whether the user can delete the transition.
     *
     * @param  \App\User  $user
     * @param  \App\Transition  $transition
     * @return mixed
     */
    public function delete(User $user, Transition $transition)
    {
        return $user->isSuperAdmin() || $user->id == $transition->user_id;
    }

    /**
     * Determine whether the user can restore the transition.
     *
     * @param  \App\User  $user
     * @param  \App\Transition  $transition
     * @return mixed
     */
    public function restore(User $user, Transition $transition)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the transition.
     *
     * @param  \App\User  $user
     * @param  \App\Transition  $transition
     * @return mixed
     */
    public function forceDelete(User $user, Transition $transition)
    {
        //
    }
}
