<?php

namespace App\Http\Controllers\Api\Admin;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;


class AdminAccessTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'device_name' => 'string|max:255',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {

            $device_name = $request->post('device_name', $request->userAgent());
            $token = $admin->createToken($device_name);   //object token not string

            return Response::json([
                'success' => true,
                'message' => 'Authenticated admin',
                'token' => $token->plainTextToken,
                'admin' => $admin,
            ], 201);
        }

        return Response::json([
            'success' => false,
            'message' => 'unAuthenticated admin',
        ], 401);
    }


    public function destroy($token = null)
    {
        $admin = Auth::guard('admin')->user();

        //Revoke all tokens -->ex: from all devices
        //$user->tokens()->delete();


        if(null === $token){
            $admin->currentAccessToken()->delete();
            return "current token deleted" ;
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);     //return token object

        if (
            $admin->id == $personalAccessToken->tokenable_id
            && get_class($admin) == $personalAccessToken->tokenable_type
        ) {
            $personalAccessToken->delete();
            return "input token deleted" ;
        }

    }
}
