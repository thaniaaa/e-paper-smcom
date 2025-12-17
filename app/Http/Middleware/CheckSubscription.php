<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Admin selalu boleh lewat
        if ($user->role === 'admin') {
            return $next($request);
        }

        $today = Carbon::today()->toDateString();

        $activeSub = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        if (! $activeSub) {
            return redirect()
                ->route('subscriptions.plans')
                ->with('error', "Anda belum memiliki langganan aktif. Silakan berlangganan terlebih dahulu.");
        }

        return $next($request);
    }
}
