<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CheckApiKey
{
    /**
     * Check the API key inside the header request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        if ($request->header('X-Api-Key') !== env('API_KEY')) {
            return response()->json([
                'status' => [
                    'error' => 'You are not allow to use the API. Please check the documentation: https://github.com/FrancoisCAN/social-media-api.',
                    'state' => false,
                ],
            ], HttpResponse::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
