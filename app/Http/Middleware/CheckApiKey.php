<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CheckApiKey
{
    /**
     * Verify the API key inside the header request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse)  $next
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
