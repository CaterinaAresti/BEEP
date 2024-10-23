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
}
