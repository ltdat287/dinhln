<?php namespace VirtualProject\Http\Middleware;

use Closure;
use Auth;
use VirtualProject\Helpers\MemberHelper;

class CheckUserHasEdit {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	    $user = Auth::user();
	    
	    if (MemberHelper::getCurrentUserRole() != 'admin' && $user->id != $request->id)
	    {
	        $errors[] = sprintf(trans('valids.not_direct_access'));
	        return view('errors.system_error')->with('errors', $errors);
	    }
	    
		return $next($request);
	}

}
