<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckCartNotEmpty
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
        // Récupérer le panier de la session
        $cart = Session::get('cart', []);

        // Vérifier si le panier est vide
        if (empty($cart)) {
            // Rediriger vers la page du panier avec un message si le panier est vide
            return redirect()->route('cart.index')->with('warning', 'Your cart is empty. Please add items to proceed to checkout.');
        }

        // Si le panier n'est pas vide, continuer vers la route suivante
        return $next($request);
    }
}
