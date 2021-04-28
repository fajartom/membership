<?php

namespace App\Http\Middleware;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use DB;
use Closure;

class CheckDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    use AuthenticatesUsers {
        logout as performLogout;
    }

    public function handle($request, Closure $next)
    {
        $host       = $request->getHost();
        $_get_id    = $request->user()->id;
        $user       = User::find($_get_id);
        $userRole   = $user->roles->pluck('name','name')->all();

        $_get_user  = DB::table('users')->select('contact_information.domain')
                                        ->join('contact_information', 'users.id', '=', 'contact_information.user_id')
                                        ->where('users.id', $_get_id)->first();

        if((in_array('superadmin', $userRole) or in_array('artist', $userRole))){

            if($_get_user->domain!=$host) {
                $this->performLogout($request);
                return redirect()->back()->withErrors('Your credential is invalid for '. $host);
            }
        }

        return $next($request);
    }
}
