<?php

namespace VirtualProject\Http\Controllers\Auth;

use VirtualProject\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use VirtualProject\Http\Requests\AuthLoginFormRequest;
use Auth;

class AuthController extends Controller
{
    
    /*
     * |--------------------------------------------------------------------------
     * | Registration & Login Controller
     * |--------------------------------------------------------------------------
     * |
     * | This controller handles the registration of new users, as well as the
     * | authentication of existing users. By default, this controller uses
     * | a simple trait to add these behaviors. Why don't you explore it?
     * |
     */
    
    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth            
     * @param \Illuminate\Contracts\Auth\Registrar $registrar            
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;
        
        $this->middleware('guest', [
            'except' => 'getLogout'
        ]);
    }
    
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(AuthLoginFormRequest $request)
    {
        $this->validate($request, [
			'email' => 'required|vpemail', 'password' => 'required',
		], $request->messages());

		$credentials = $request->only('email', 'password');
		
		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
    }
    
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return '/';
    }
    
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->auth->logout();
    
        return view('auth.logout');
    }
}
