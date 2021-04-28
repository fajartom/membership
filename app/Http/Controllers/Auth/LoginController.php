<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = 'id';

    private $token;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TokenRepository $token)
    {
        $this->middleware('guest')->except('logout');

        $this->token = $token;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        try {
            $redirectData = Crypt::decrypt($encrypted = request()->input('e'));

            return redirect()->away(env('APP_URL') . "/login?o={$encrypted}");
        } catch (\Exception $e) {}

        if (! request()->input('o'))
            return view('auth.login');

        if (! $this->_getRedirectURL($o))
            return redirect()->route('login');

        return view('auth.login', compact('o'));
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($this->_getRedirectURL($encrypted, $urlRedirect, $urlValidation))
        {
            $host = parse_url($urlRedirect, PHP_URL_HOST) ?: $urlRedirect;

            $data = Crypt::encrypt([
                'r' => $urlRedirect,
                't' => $user->createToken($host)->token->id,
            ]);

            return redirect()->away("{$urlValidation}/{$data}");
        }
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);

        if (request()->getHost() != env('APP_DOMAIN'))
            return redirect('/');

        return redirect()->route('dashboard', ['en']);
    }

    public function validateCrossSiteToken($encryptedData = null)
    {
        try {
            if (! $encryptedData)
                throw new Exception();

            if (! $data = Crypt::decrypt($encryptedData))
                throw new Exception();

            if (! isset($data['r']) || ! isset($data['t']))
                throw new Exception();

            if (! $token = $this->token->find($data['t']))
                throw new Exception();

            if ($token->revoked)
            {
                $token->delete();

                throw new Exception();
            }

            Auth::login($token->user()->first());

            $token->delete();

            return redirect($data['r']);
        } catch (\Exception $e) {}

        return redirect('/');
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
