<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SharedDatasMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            $data = $response->getData(true);

            $user = null;

            if (auth()->check()) {
                $user = auth()->user();

                $user = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'is_admin' => $user->is_admin,
                    'cart' => $user->cart->load('items.cart', 'items.product')->toResource(),
                ];
            }

            $shared = [
                'user' => $user,
            ];

            $response->setData([
                'shared' => $shared,
                ...$data,
            ]);
        }

        return $response;
    }
}
