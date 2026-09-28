<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
  public function handle(Request $request, Closure $next, $role)
  {
    $user = auth::user();

    if (!$user) {
      return redirect()->route('login');
    }

    if ($user->role !== $role) {
      abort(403, 'Not Found');
    }

    return $next($request);
  }
}
