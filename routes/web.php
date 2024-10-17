<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\TattooController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TattooReportController;
use App\Http\Controllers\UserReportController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

// Authentification (routes par défaut de Laravel Breeze ou Jetstream)
require __DIR__.'/auth.php';

// Pages publiques
Route::get('/', function () {
    return view('home.index');
})->name('home.index');

Route::get('/about-us', function () {
    return view('about.index');
})->name('about.index');

// Pages pour les tatouages
Route::get('/tattoos', [TattooController::class, 'index'])->name('tattoos.index');

// Boutique et produits
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

// Liste des artistes
Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');

// Panier
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'removeProduct'])->name('cart.remove');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
    
    // Processus de paiement
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/create-session', [CheckoutController::class, 'createSession'])->name('checkout.createSession');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success')->middleware('auth');
    Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
    
    // Portfolio
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::delete('/portfolio/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolio.delete');
    
    // Gestion du profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.uploadPhoto');
    Route::post('/profile/update', [ProfileController::class, 'updateField'])->name('profile.updateField');
    
    // Profil utilisateur spécifique
    Route::get('/profile/{login}', [ProfileController::class, 'showProfile'])->name('profile.showProfile');

    // Report un tatouage
    Route::get('/tattoos/{portfolio}/report', [TattooReportController::class, 'create'])->name('tattoo.report');
    Route::post('/tattoos/{portfolio}/report', [TattooReportController::class, 'store'])->name('tattoo.report.store');

    // Report un utilisateur
    Route::get('/user/{id}/report', [UserReportController::class, 'showReportForm'])->name('report.user.form');
    Route::post('/user/{id}/report', [UserReportController::class, 'submitReport'])->name('report.user.submit');

    Route::post('/tattoos/{portfolio}/like', [LikeController::class, 'like'])->name('tattoo.like');
    Route::delete('/tattoos/{portfolio}/unlike', [LikeController::class, 'unlike'])->name('tattoo.unlike');

    Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders');
});

// Routes administratives (avec vérification du rôle admin)
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Tableau de bord de l'admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Gestion des utilisateurs
    Route::prefix('admin/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Gestion des produits
    Route::prefix('admin/products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });
});
