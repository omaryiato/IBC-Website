<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Login $request)
    {

        $user_details = User::where('email', $request->email)
                        ->where('is_active', 1)
                        ->first();

        if (!$user_details) {
            return ResponseHelper::error(
                    null,
                    [
                        'en' => __('validation.invalid_credentials'),
                        'ar' => __('validation.invalid_credentials'),
                    ],
                    401);
        }

        if (!Hash::check($request->password, $user_details->password)) {

            return ResponseHelper::error(
                    null,
                    [
                        'en' => __('validation.invalid_credentials'),
                        'ar' => __('validation.invalid_credentials'),
                    ],
                    401);
        }

        $token = $user_details->createToken('auth_token')->plainTextToken;

        return ResponseHelper::success(
                $user_details,
                [
                    'en' => __('validation.logged_in'),
                    'ar' => __('validation.logged_in'),
                    'token' => $token,
                ],
                200
            );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return ResponseHelper::success(
                null,
                [
                    'en' => __('validation.logged_out'),
                    'ar' => __('validation.logged_out'),
                ],
                200
            );
    }

    public function refresh(Request $request)
    {
        return ResponseHelper::success(
                $request->user(),
                [
                    'en' => __('validation.token_available'),
                    'ar' => __('validation.token_available'),
                ],
                200
            );
    }
}
