<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next)
    {
        $token = Session::get('access_token');

        // Si on a un token, on le vérifie
        if ($token) {
            $response = Http::withToken($token)->get(env('API_URL') . '/auth/verify');

            if ($response->ok()) {
                // Utilisateur authentifié
                view()->share('isAuthenticated', true);
                view()->share('user', Session::get('user'));
                return $next($request);
            }

            // Si token expiré, tente un refresh
            if ($response->status() === 401) {
                $refreshResponse = Http::withCookies($request->cookies->all(), env('API_URL'))
                    ->post(env('API_URL') . '/auth/refresh-token');

                if ($refreshResponse->ok()) {
                    // Stocke le nouveau token
                    Session::put('access_token', $refreshResponse['token']);
                    Session::put('user', $refreshResponse['data']);

                    view()->share('isAuthenticated', true);
                    view()->share('user', $refreshResponse['data']);

                    return $next($request);
                } else {
                    // Token non valide, suppression du token de la session
                    Session::forget('access_token');
                    Session::forget('user');
                }
            } else {
                // Token non valide, suppression du token de la session
                Session::forget('access_token');
                Session::forget('user');
            }
        }

        // Non authentifié
        view()->share('isAuthenticated', false);
        view()->share('user', null);
        return $next($request);
    }
}
