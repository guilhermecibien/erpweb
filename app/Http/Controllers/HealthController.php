<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HealthController extends Controller
{
    /**
     * Endpoint for load balancers and container health checks.
     */
    public function __invoke(): JsonResponse
    {
        try {
            DB::select('select 1');
        } catch (\Throwable $exception) {
            report($exception);

            return response()->json(['status' => 'unavailable'], 503);
        }

        return response()->json(['status' => 'ok']);
    }
}
