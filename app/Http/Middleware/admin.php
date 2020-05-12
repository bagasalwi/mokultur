<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class admin
{
    
    public function handle($request, Closure $next)
    {
        // dd($request->user());
        
        if(Auth::user()->hasRole('admin')){
            return $next($request);
        }else if(Auth::user()->hasRole('user')){
            return abort(401, 'This action is unauthorized.');
        }
        
        
    }
}
