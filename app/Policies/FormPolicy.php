<?php

namespace App\Policies;

use App\Models\Form;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Auth\Access\Response;

class FormPolicy
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
    public function view(User $user, Form $form): bool
    {
        if ($user->roles()->firstWhere('name', 'admin')) {
            return true;
        }

        return $form->user_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // get form limit
        $form_plans = Plan::where('related_product', 'forms')->pluck('id')->all();
        $user_form_plan = UserPlan::where('user_id', $user->id)->whereIn('plan_id', $form_plans)->first();
        $form_limit = $user_form_plan->plan->features()->where('name', 'forms_limit')->first()->value;

        // current form count
        $my_forms = Form::where('user_id', $user->id)->count();

        return $my_forms < $form_limit;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Form $form): bool
    {
        if ($user->roles()->firstWhere('name', 'admin')) {
            return true;
        }

        return $form->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Form $form): bool
    {
        if ($user->roles()->firstWhere('name', 'admin')) {
            return true;
        }

        return $form->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Form $form): bool
    {
        if ($user->roles()->firstWhere('name', 'admin')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Form $form): bool
    {
        if ($user->roles()->firstWhere('name', 'admin')) {
            return true;
        }

        return false;
    }
}
