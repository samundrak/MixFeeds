<?php

namespace App\Http\Middleware;

use Closure;

class Verification {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		error_log('hy');
		return $next($request);
	}
}
