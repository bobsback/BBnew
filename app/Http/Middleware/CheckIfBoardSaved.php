<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class CheckIfBoardSaved
 *
 * @package App\Http\Middleware
 */
class CheckIfBoardSaved
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $redirect = false;

        $storedInSession = session('board.' . $request->boardname->id . '.authorized');

        if (!($user = \Auth::user())) {
            if (!$storedInSession) {
                $redirect = true;
            }
        } else {
            if (!$user->boards()->find($request->boardname->id) && !$storedInSession) {
                $redirect = true;
            }
        }

        if ($redirect) {
            return redirect()->route('board.authorize', $request->boardname->boardname);
        }

        return $next($request);
    }
}
