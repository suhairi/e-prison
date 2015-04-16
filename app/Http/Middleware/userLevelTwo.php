<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;

class userLevelTwo {

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if($this->auth->user()->level != 2) {
            $this->auth->logout();

            return view('auth.login');
        }
		return $next($request);
	}

}
