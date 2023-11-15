<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfUserIsVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::find(request()->user()->id);
        if ($user->type != 1) {
            return response()->json(
                [
                    "status" => false,
                    "message" => "Desolé! Seuls les vendeurs sont autorisés à éffectuer cette opération"
                ],
                505
            );
        }
        return $next($request);
    }
}
