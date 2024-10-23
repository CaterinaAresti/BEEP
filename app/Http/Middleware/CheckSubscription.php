<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Subscription;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $planType
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $planType)
    {
        
        $user = $request->user();

        if (!$user) {
            // Handling of unauthenticated users
            return redirect()->route('login');
        }

        // Retrieving of the latest active subscription
        $subscription = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->orderBy('start_date', 'desc')
            ->first();

        // Checking if the subscription exists and matches the required plan type
        if ($subscription && $subscription->plan_type_id === $planType) {
            return $next($request);
        }

        // Showing an error for insufficient permissions
        return response()->view('errors.subscription', [], 403);

    }
}
