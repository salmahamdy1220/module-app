<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Resources\SuperAdminResource;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class SuberAccessTokenController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        return true ;
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ], 200);
    }
}
