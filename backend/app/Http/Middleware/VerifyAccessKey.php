<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAccessKey
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
        // Obtenemos el api-key que el usuario envia
        $key = $request->headers->get('api-key');

        if ($key == env('APP_KEY'))
        {
            // Si coincide con el valor almacenado se sigue ejecutando
            return $next($request);
        } 
        else 
        {
            // Si falla devolvemos el mensaje de error
            return response()->json(['error' => 'unauthorized' ], 401);
        }
    }
}
