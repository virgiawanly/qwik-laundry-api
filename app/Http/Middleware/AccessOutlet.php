<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use App\Models\Outlet;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessOutlet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user->can_access_multiple_outlets) {
            $outletId = $request->header('Outlet-Id');

            if (!$outletId) {
                return ResponseHelper::badRequest(config('app.debug')
                    ? 'The Outlet-id header not provided'
                    : 'Outlet must be selected');
            }

            $canAccessOutlet = Outlet::where('company_id', $user->company_id)
                ->where('id', $outletId)
                ->exists();

            if (!$canAccessOutlet) {
                return ResponseHelper::notFound('Outlet not found');
            }
        }

        return $next($request);
    }
}
