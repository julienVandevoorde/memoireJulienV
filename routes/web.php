<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShopController; // Import du ShopController pour gérer la boutique
use App\Http\Controllers\CartController; // Import du CartController pour gérer le panier
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here est where you can register web routes for your application.
| These routes sont loaded by the RouteServiceProvider and all of them will be
| assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home.index'); // Page d'accueil (par défaut)
})->name('home.index');

// Routes pour les utilisateurs administrateurs avec Middleware de vérification de rôle
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index'); // Page d'administration
    })->name('dashboard.index');
});

// Routes pour la gestion du profil utilisateur (nécessite authentification)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Page de modification du profil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Mettre à jour le profil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Supprimer le profil
});

// Authentification (routes par défaut de Laravel Breeze ou Jetstream)
require __DIR__.'/auth.php';

// Routes pour les pages de la navbar
Route::get('/tattoos', function () {
    return view('tattoos.index'); // Page des tatouages
})->name('tattoos.index');

Route::get('/find-my-tattoo-artist', function () {
    return view('artists.index'); // Page pour trouver un tatoueur
})->name('artists.index');

// Utilisation de ShopController pour afficher les produits dynamiques
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

// Page "À propos de nous"
Route::get('/about-us', function () {
    return view('about.index'); // Page "À propos de nous"
})->name('about.index');

// Routes pour le panier (cart)
// Afficher le panier (nécessite une authentification)
Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');

// Ajouter un produit au panier via AJAX (disponible pour tous)
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

// Mettre à jour la quantité d'un produit dans le panier (disponible pour tous)
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

// Supprimer un produit du panier (disponible pour tous)
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Nouvelle route pour récupérer le nombre d'articles dans le panier (AJAX)
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// Routes pour le processus de paiement
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index'); // Afficher la page de paiement
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store'); // Effectuer le paiement
Route::post('/checkout/session', [CheckoutController::class, 'createSession'])->name('checkout.createSession'); // Créer une session de paiement
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success'); // Page de succès
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel'); // Page d'annulation
