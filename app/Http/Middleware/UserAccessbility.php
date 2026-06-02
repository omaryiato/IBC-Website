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
                    'en' => trans('validation.unauthenticated'),
                    'ar' => trans('validation.unauthenticated'),
                ],
                401
            );
        }

        if (Auth::user()->user_type !== 'admin') {

            return ResponseHelper::error(
                null,
                [
                    'en' => trans('validation.unauthorized'),
                    'ar' => trans('validation.unauthorized'),
                ],
                403
            );
        }

        return $next($request);
    }
}
