<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserIsRecruiter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        if (Auth::check() && $user->isRecruiter()) {
            return $next($request);
        }
        
        // Si l'utilisateur n'est pas recruteur, rediriger ou retourner une erreur
        return redirect()->route('home')->with('error', 'Accès non autorisé. Vous devez être recruteur.');
    }
}
