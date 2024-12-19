<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Traits\AppHelper;
use Symfony\Component\HttpFoundation\Response;
class SuperCheckRole
{
    use AppHelper;
    public function getRoute()
    {
        return Route::current()->getName();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $type = null;
            $page = null;
            if (str_contains($this->getRoute(), '.')) {
                list($type, $page) = explode('.', $this->getRoute());
            }
            if (

                 AppHelper::perUser($this->getRoute())
                || ($page == 'multi_destroy' && AppHelper::perUser($type . '.destroy'))
                || ($page == 'store' && AppHelper::perUser($type . '.create'))
                || ($page == 'update' && AppHelper::perUser($type . '.edit'))
                || ($page == 'change_status' && AppHelper::perUser($type . '.edit'))
                ||in_array($this->getRoute(), ['admin.home', 'users.profile', 'users.profile_update'])
            )
            {
                return $next($request);
            } else {
                return abort(403);
            }
        }
        return redirect()->route('redirect');
    }
}
