<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique(User::class)],
            'password' => ['required',],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('myAppToken');

        return(new UserResource($user))->additional([
            'token' => substr($token->plainTextToken, strpos($token->plainTextToken, "|") + 1),
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => ['required'],
            'password' => ['required',],
        ]);

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            return (new UserResource($user))->additional([
                'token' => $user->createToken('myAppToken')->plainTextToken,
            ]);
        }

        return response()->json([
            'message' => 'Your credential does not match.',
        ], 401);
    }

    public function logout(Request $request)
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
            $user = User::find($token->first()->tokenable_id);
            if ( $user)
            {
                DB::table('personal_access_tokens')->where('tokenable_id', $token->first()->tokenable_id)->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Success Logout',
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'code' => 'token',
            'message' => 'Access denied.',
        ], 401);
    }

    public function check_token(Request $request)
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
                return response()->json([
                    'success' => true,
                    'message' => 'Token active',
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'code' => 'token',
            'message' => 'Access denied.',
        ], 401);
    }
}
