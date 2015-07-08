<?php namespace VirtualProject\Http\Middleware;

use Closure;
use Auth;

class CheckIsManager {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	    // Get current user
	    $user = Auth::getUser();
	    
	    // Check exist role.
	    $role = $user->getFirstRole();
	    if (! $role)
	    {
	        return response('Unauthorized.', 401);
	    }
	    
	    // Only redirect if user not employ.
	    if ($role->slug == 'employ')
	    {
	        return redirect('/');
	    }
	    
		return $next($request);
	}

}
