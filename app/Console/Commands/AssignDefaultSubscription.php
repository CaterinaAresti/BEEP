<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Subscription;
use App\PlanType;

class AssignDefaultSubscription extends Command
{
    protected $signature = 'subscriptions:assign-defaults';
    protected $description = 'Assign the basic subscription to all users without a subscription';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $basicPlan = PlanType::where('name', 'basic')->first();

        if (!$basicPlan) {
            $this->error('Basic plan not found in PlanType table.');
            return;
        }

        $usersWithoutSubscription = User::doesntHave('subscription')->get();

        foreach ($usersWithoutSubscription as $user) {
            Subscription::create([
                'user_id' => $user->id,
                'plan_type_id' => $basicPlan->id,
                'status' => 'active',
                'start_date' => now(),
                'end_date' => null,
            ]);
            $this->info('Assigned basic subscription to user ID: ' . $user->id);
        }

        $this->info('Default subscriptions assigned successfully.');
    }
}
