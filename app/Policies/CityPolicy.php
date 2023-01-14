<?php

namespace App\Policies;

use App\Models\City;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny( $user)
    {
        //  // بدنا نعرف مين الي بعدل وبضيف هل الادمن او المستخدم العادي
        $guard =auth('admin')->check() ? 'admin' : 'web';
        return auth($guard)->user()->hasPermissionTo('Read-Cities') ? $this->allow() :$this->deny();

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view( $user, City $city)
    {
        $guard =auth('admin')->check() ? 'admin' : 'web';
        return auth($guard)->user()->hasPermissionTo('Read-Cities') ? $this->allow() :$this->deny();

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)   
    {
        $guard =auth('admin')->check() ? 'admin' : 'web';
        return auth($guard)->user()->hasPermissionTo('Create-City') ? $this->allow() :$this->deny();

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update()
    {
        $guard =auth('admin')->check() ? 'admin' : 'web';
        return auth($guard)->user()->hasPermissionTo('Update-City') ? $this->allow() :$this->deny();

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete()
    {
        $guard =auth('admin')->check() ? 'admin' : 'web';
        return auth($guard)->user()->hasPermissionTo('Delete-City') ? $this->allow() :$this->deny();

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, City $city)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, City $city)
    {
        //
    }
}
