<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Sanctum
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bearer = $request->bearerToken();
        $token = DB::table('personal_access_tokens')->where('token',Hash('sha256', $bearer));
        if ($token->first())
        {
            $last_used = Carbon::parse($token->first()->last_used_at);
            $current_used = Carbon::parse(date("Y-m-d H:i:s", strtotime('now')));
            if($last_used->diffInMinutes($current_used) > 30) {
                return response()->json([
                    'success' => false,
                    'code' => 'token',
                    'message' => 'Token expired',
                ], 403);
            }
            if (User::find($token->first()->tokenable_id))
            {
                $token->update([
                    'last_used_at'=>date("Y-m-d H:i:s", strtotime('now')),
                ]);
                return $next($request);
            }
        }

        return response()->json([
            'success' => false,
            'code' => 'token',
            'message' => 'Access denied.',
        ], 401);
    }
}
