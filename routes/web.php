<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProfilBisnisController;
use App\Http\Controllers\ZisCategoryController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']
    )->name('dashboard')->middleware('can:dashboard');
    Route::get('profile-edit', function () {
        return view('pages.profile');
    })->name('profile.edit');
    Route::resource('user', UserController::class);
    Route::resource('profil-bisnis', ProfilBisnisController::class);

    Route::get('/export-penduduk', [PendudukController::class, 'exportToExcel']);
    Route::resource('penduduk', PendudukController::class);
    Route::resource('zis-category', ZisCategoryController::class);
});