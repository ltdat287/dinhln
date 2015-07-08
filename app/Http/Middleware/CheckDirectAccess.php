<?php namespace VirtualProject\Http\Middleware;

use Closure;
use VirtualProject\Helpers\MemberHelper;

class CheckDirectAccess {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	    // Check permission delete current user.
	    if (MemberHelper::checkLogin()->id == $request->id) {
	        $errors[] = sprintf(trans('valids.not_direct_access'));
	        return view('errors.system_error')->with('errors', $errors);
	    }
	    
		return $next($request);
	}

}
