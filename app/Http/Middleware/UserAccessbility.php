<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Auth;

class UserAccessibility
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {

            return ResponseHelper::error(
                null,
                [
                    'en' => __('validation.unauthenticated'),
                    'ar' => __('validation.unauthenticated'),
                ],
                401
            );
        }

        if (Auth::user()->user_type !== 'admin') {

            return ResponseHelper::error(
                null,
                [
                    'en' => __('validation.unauthorized'),
                    'ar' => __('validation.unauthorized'),
                ],
                403
            );
        }

        return $next($request);
    }
}
