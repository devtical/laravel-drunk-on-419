<?php

namespace Devtical\DrunkOn419\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleDrunkOn419
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response->status() === 419) {
            if ($request->expectsJson()) {
                return new JsonResponse(['message' => trans('drunkon419::session.expired')], 419);
            }

            if (url()->previous()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('expired', trans('drunkon419::session.expired'));
            }

            return redirect('/')
                ->withInput()
                ->with('expired', trans('drunkon419::session.expired'));
        }

        return $response;
    }
}
