<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use LemonSqueezy\Laravel\Billable;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        /*
        static::created(function (User $user) {
            $form_builder_role = Role::firstWhere('name', 'form builder');
            $sites_role = Role::firstWhere('name', 'sites');

            $user_role = new UserRole();
            $user_role->user_id = $user->id;
            $user_role->role_id = $form_builder_role->id;
            $user_role->save();

            $sites_user_role = new UserRole();
            $sites_user_role->user_id = $user->id;
            $sites_user_role->role_id = $sites_role->id;
            $sites_user_role->save();

            $user_credits = new UserCredits();
            $user_credits->user_id = $user->id;
            $user_credits->credits = 250;
            $user_credits->save();

            // add starter plan
            $user_plan = new UserPlan();
            $user_plan->plan_id = Plan::where('name', 'Starter')->first()->id;
            $user_plan->user_id = $user->id;
            $user_plan->save();

            // add sites - starter plan
            $user_plan = new UserPlan();
            $user_plan->plan_id = Plan::where('name', 'Sites - Starter')->first()->id;
            $user_plan->user_id = $user->id;
            $user_plan->save();
        });
        */
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() == 'admin') {
            if ($this->roles()->where('name', '=', 'admin')->first()) {
                return true;
            } else {
                return false;
            }
        }

        if ($panel->getId() == 'form-builder') {
            if ($this->roles()->where('name', '=', 'admin')->first()) {
                return true;
            }

            if ($this->roles()->where('name', '=', 'form builder')->first()) {
                return true;
            } else {
                return false;
            }
        }

        if ($panel->getId() == 'sites') {
            if ($this->roles()->where('name', '=', 'admin')->first()) {
                return true;
            }

            if ($this->roles()->where('name', '=', 'sites')->first()) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    public function plans()
    {
        return $this->hasMany(UserPlan::class);
    }

    public function credits()
    {
        return $this->hasOne(UserCredits::class);
    }
}
