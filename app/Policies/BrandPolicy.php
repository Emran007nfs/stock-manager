<?php

namespace App\Policies;

use App\Product;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class BrandPolicy
{
    use HandlesAuthorization;

    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {
        return $this->user;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view()
    {
        return $this->user;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()
    {
        return $this->user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update()
    {
        return $this->user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete()
    {
        return $this->user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore()
    {
        return $this->user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete()
    {
        return $this->user->is_admin;
    }
}
