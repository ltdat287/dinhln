<?php namespace VirtualProject\Http\Middleware;

use Closure;
use VirtualProject\User;

class CheckUserDisabled {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	    // Check user disabled in db.
	    if ($request->id) {
	        $user = User::find($request->id);
	        if ($user->disabled || empty($user)) {
	            $errors[] = sprintf(trans('valids.deleted_id'), $request->id);
	            return view('errors.system_error')->with('errors', $errors);
	        }
	    } else {
	        return redirect('/');
	    }
	    
		return $next($request);
	}

}
