<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\LandingCatalogueController;
use App\Http\Livewire\HomeController;
use App\Http\Livewire\InvCategorieController;
use App\Http\Livewire\InvProductController;
use App\Http\Livewire\LandingHomeController;
use App\Http\Livewire\SaleController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta del catálogo (fuera del inicio de sesión)
Route::get('home', LandingHomeController::class);
Route::get('catalogo', LandingCatalogueController::class);

Route::middleware('auth')->group(function () {

    // Ruta por defecto despues de iniciar sesión :)
    Route::redirect('/', 'inicio');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route of Home
    Route::get('inicio', HomeController::class);

    // Inventories
    Route::get('categoriaproducto', InvCategorieController::class);
    Route::get('listaproducto', InvProductController::class);

    // Sale
    Route::get('vender', SaleController::class);
});

require __DIR__.'/auth.php';
