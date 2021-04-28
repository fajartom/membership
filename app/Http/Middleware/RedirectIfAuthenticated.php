<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = null)
    {
        $host = env("APP_DOMAIN");

        if (Auth::guard($guard)->check())
        {
            if ($host == request()->getHost())
            {
                if ($this->_getRedirectURL($encrypted, $urlRedirect, $urlValidation))
                {
                    $host = parse_url($urlRedirect, PHP_URL_HOST) ?: $urlRedirect;

                    $data = Crypt::encrypt([
                        'r' => $urlRedirect,
                        't' => Auth::user()->createToken($host)->token->id,
                    ]);

                    return redirect()->away("{$urlValidation}/{$data}");
                }

                return redirect()->route('dashboard', ['en']);
            } else {
                return redirect()->route('home', ['en']);
            }
        }

        return $next($request);
    }

    private function _getRedirectURL(&$encrypted = null, &$urlRedirect = null, &$urlValidation = null)
    {
        try {
            $data = Crypt::decrypt($encrypted = request()->input('o'));

            if (! isset($data['v']) || ! isset($data['r']))
                throw new Exception();

            $urlValidation = $data['v'];
            $urlRedirect = $data['r'];

            return true;
        } catch (\Exception $e) {}

        return false;
    }
}
