<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormulirContoller;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilBisnisController;

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
// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [FormulirContoller::class, 'formPejuang'])->name('home');
Route::post('/', [FormulirContoller::class, 'storePejuang']);
Route::get('/form-peserta', [FormulirContoller::class, 'formPejuang'])->name('form.pejuang');
Route::post('/form-peserta', [FormulirContoller::class, 'storePejuang']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']
    )->name('dashboard')->middleware('can:dashboard');
    Route::get('profile-edit', function () {
        return view('pages.profile');
        // return view('pages.profile', ['type_menu' => '']);
    })->name('profile.edit');
    Route::resource('user', UserController::class);
    Route::resource('profil-bisnis', ProfilBisnisController::class);

    Route::get('/export-peserta', [PesertaController::class, 'exportToExcel']);
    Route::resource('peserta', PesertaController::class);
});