<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShopController; // Import du ShopController pour gérer la boutique
use App\Http\Controllers\CartController; // Import du CartController pour gérer le panier
use App\Http\Controllers\PortfolioController; //import du portfolio controller
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\TattooController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here est where you can register web routes for your application.
| These routes sont loaded par le RouteServiceProvider and all of them will be
| assigned to the "web" middleware group. Make something great!
|
*/
// Authentification (routes par défaut de Laravel Breeze ou Jetstream)
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('home.index'); // Page d'accueil (par défaut)
})->name('home.index');

// Routes pour les utilisateurs administrateurs avec Middleware de vérification de rôle
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


// Routes pour la gestion du profil utilisateur (nécessite authentification)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index'); // Modifié pour utiliser 'index' au lieu de 'edit'
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Ajouté pour conserver l'édition
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Mettre à jour le profil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Supprimer le profil
    Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.uploadPhoto');
    Route::post('/profile/update', [ProfileController::class, 'updateField'])->name('profile.updateField')->middleware('auth');
});

// Route unique pour afficher le profil d'un utilisateur (tatoueur ou client)
Route::get('/profile/{login}', [ProfileController::class, 'showProfile'])->name('profile.showProfile');




// Routes pour les pages de la navbar
Route::get('/tattoos', function () {
    return view('tattoos.index'); // Page des tatouages
})->name('tattoos.index');

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
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');

// Supprimer un produit du panier (disponible pour tous)
Route::post('/cart/remove', [CartController::class, 'removeProduct'])->name('cart.remove');

// Nouvelle route pour récupérer le nombre d'articles dans le panier (AJAX)
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// Routes pour le processus de paiement (avec middleware pour vérifier que le panier n'est pas vide)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/create-session', [CheckoutController::class, 'createSession'])->name('checkout.createSession');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
});

// Routes pour le portfolio
Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store')->middleware('auth');
Route::delete('/portfolio/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolio.delete')->middleware('auth');

// route pour artists
Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');

// Route pour afficher la page des tatouages
Route::get('/tattoos', [TattooController::class, 'index'])->name('tattoos.index');

// Routes pour la gestion des utilisateurs par l'admin
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    // Route pour afficher le formulaire d'édition d'un utilisateur
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');


    // Routes pour la gestion des produits par l'admin
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});
