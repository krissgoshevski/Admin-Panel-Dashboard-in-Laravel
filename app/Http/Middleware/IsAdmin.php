<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
 
     public function handle(Request $request, Closure $next): Response
{
    $user = $request->user();
    if ($user && $user->role_id === 3) {
        // Debugging statement
      //  dd('User is an admin');
        return $next($request);
    }

    // Debugging statement
    //dd('User is not an admin');

    // If the user is not an admin, you can handle this as needed.
    abort(403, 'Unauthorized, you cannot visit this page because you are not Admin');
}

}
