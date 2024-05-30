<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\AdmSupplierController;
use App\Http\Livewire\AdmUserController;
use App\Http\Livewire\LandingCatalogueController;
use App\Http\Livewire\HomeController;
use App\Http\Livewire\InvBuyController;
use App\Http\Livewire\InvCategoryController;
use App\Http\Livewire\InvProductController;
use App\Http\Livewire\LandingHomeController;
use App\Http\Livewire\InvSaleController;
use App\Http\Livewire\SisCisternController;
use App\Http\Livewire\SisDriverController;
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

    // Administration
    Route::get('usuarios', AdmUserController::class);
    Route::get('proveedores', AdmSupplierController::class);

    // Inventories
    Route::get('categorias', InvCategoryController::class);
    Route::get('productos', InvProductController::class);
    Route::get('comprar', InvBuyController::class);
    Route::get('vender', InvSaleController::class);

    // SIS - PETROL
    Route::get('cisternas', SisCisternController::class);
    Route::get('conductores', SisDriverController::class);
});

require __DIR__.'/auth.php';
