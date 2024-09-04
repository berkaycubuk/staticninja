<?php

namespace App\Policies;

use App\Models\Plan;
use App\Models\Site;
use App\Models\User;
use App\Models\UserPlan;

class SitePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Site $site): bool
    {
        if ($user->roles()->firstWhere('name', 'admin')) {
            return true;
        }

        return $site->user_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // get site limit
        $site_plans = Plan::where('related_product', 'sites')->pluck('id')->all();
        $user_site_plan = UserPlan::where('user_id', $user->id)->whereIn('plan_id', $site_plans)->first();
        $sites_limit = $user_site_plan->plan->features()->where('name', 'sites_limit')->first()->value;

        // current site count
        $my_sites = Site::where('user_id', $user->id)->count();

        return $my_sites < $sites_limit;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Site $site): bool
    {
        if ($user->roles()->firstWhere('name', 'admin')) {
            return true;
        }

        return $site->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Site $site): bool
    {
        if ($user->roles()->firstWhere('name', 'admin')) {
            return true;
        }

        return $site->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Site $site): bool
    {
        if ($user->roles()->firstWhere('name', 'admin')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Site $site): bool
    {
        if ($user->roles()->firstWhere('name', 'admin')) {
            return true;
        }

        return false;
    }
}
