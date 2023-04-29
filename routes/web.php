<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\HomeController;
use App\Http\Livewire\InvCategorieController;
use App\Http\Livewire\InvProductController;
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

Route::middleware('auth')->group(function () {

    //Ruta por defecto despues de iniciar sesión :)
    Route::redirect('/', 'inicio');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Route of Home
    Route::get('inicio', HomeController::class);

    //Inventories
    Route::get('categoriaproducto', InvCategorieController::class);
    Route::get('listaproducto', InvProductController::class);
});

require __DIR__.'/auth.php';
