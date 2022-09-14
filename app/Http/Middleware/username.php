<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class username
{

    public function handle(Request $request, Closure $next)
    {
        $username=User::select('username')->where('id',Auth::id())->first();
        if(!empty($username->username))
        return $next($request);
        else {
            return redirect('/EnterUsername');
        }
    }
}
