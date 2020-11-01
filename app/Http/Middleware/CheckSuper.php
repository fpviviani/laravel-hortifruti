<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckSuper 
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user->name != "Super Admin") {
            return redirect(route('store.index'));

        }else{
            return $next($request);
        }
    }
}
