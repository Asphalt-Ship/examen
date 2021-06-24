<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role = 'admin')
        {
            return $next($request);
            // si l'utilisateur possède le rôle 'admin', on le laisse passer
        }
        else 
        {
            Auth::logout();
            Session::flush();
            return redirect()->route('login');
            // sinon, on le déconnecte, on efface la session en cours, et on le renvoie au login
        }
    }
}

// Ce middleware me permet de garantir que la partie admin du site ne sera accessible que par l'admin.
// Encore une fois, je pars du principe que cet examen consiste à créer un site web privé : l'utilisateur doit être authentifié
