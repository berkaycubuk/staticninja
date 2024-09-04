<?php

namespace App\Jobs;

use App\Models\Plan;
use App\Models\UserPlan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use LemonSqueezy\Laravel\Subscription;

class SqueezyNewSubscriptionCancelled implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $subscription_id,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sub = Subscription::where('lemon_squeezy_id', $this->subscription_id)->first();
        if (!$sub) {
            // notify admin
            error_log('no subscription found!');
            return;
        }

        $user_plan = UserPlan::where('user_id', $sub->billable_id)->where('plan_id', Plan::where('name', 'Pro')->first()->id)->first();
        if (!$user_plan) {
            // notify admin
            error_log('no user plan found!');
            return;
        }

        $user_plan->plan_id = Plan::where('name', 'Starter')->first()->id;
        $user_plan->save();
    }
}
