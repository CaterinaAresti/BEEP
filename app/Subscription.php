<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded  = ['id'];
    protected $fillable = ['user_id', 'plan_type_id', 'status', 'start_date', 'end_date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function planType() {
        return $this->belongsTo(PlanType::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscription) {
            // Automatically set plan_type_id to 'basic' if not provided
            if (!$subscription->plan_type_id) {
                $basicPlan = PlanType::where('name', 'basic')->first();

                if ($basicPlan) {
                    $subscription->plan_type_id = $basicPlan->id;
                } else {
                    \Log::error('Basic plan not found in PlanType table');
                    throw new \Exception('Default "basic" plan is missing');
                }
            }
        });
    }
}
