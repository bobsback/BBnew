<?php

namespace App\Http\Middleware;

use Closure;
use App\BoardBan;

/**
 * Class CheckIfBanned
 *
 * @package App\Http\Middleware
 */
class CheckIfBanned
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
        if ($request->boardname && BoardBan::where('board_id', '=', $request->boardname->id)
                ->where('ip_address', '=', ip2long($request->getClientIp()))
                ->get()
                ->count()
        ) {
            return redirect()->to('/');
        }

        return $next($request);
    }
}
