<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home.index'); // Page d'accueil (par défaut)
})->name('home');

//vérifier que ce soit un admin qui accède au dashboard (via Middleware/CheckRole)
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Navbar
Route::get('/tattoos', function () {
    return view('tattoos.index'); // Page des tatouages
})->name('tattoos');

Route::get('/find-my-tattoo-artist', function () {
    return view('artists.index'); // Page pour trouver un tatoueur
})->name('find-my-tattoo-artist');

Route::get('/shop', function () {
    return view('shop.index'); // Page du magasin
})->name('shop');

Route::get('/about-us', function () {
    return view('about.index'); // Page "À propos de nous"
})->name('about-us');

