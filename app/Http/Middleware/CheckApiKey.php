<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckApiKey
{
    /**
     * Check the API key inside the header request.
     *
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function handle(Closure $next, Request $request): JsonResponse
    {
        if ($request->header('X-Api-Key') !== env('API_KEY')) {
            return response()->json([
                'status' => [
                    'error' => 'You are not allow to use the API. Please check the documentation: https://github.com/FrancoisCAN/social-media-api.',
                    'state' => false,
                ],
            ]);
        }

        return $next($request);
    }
}
