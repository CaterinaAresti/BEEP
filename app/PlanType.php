<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanType extends Model
{
    protected $guarded  = ['id'];
    protected $fillable = ['name', 'description', 'price']; 
    
    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }
}
