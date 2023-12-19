<?php

use App\Http\Controllers\Api\NikController;
use App\Http\Controllers\DanteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormulirContoller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KetuaTimController;
use App\Http\Controllers\KodeWilayahController;
use App\Http\Controllers\KomandoTeritoriController;
use App\Http\Controllers\LuarnegeriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PejuangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilBisnisController;
use App\Http\Controllers\Team100Controller;

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

Route::get('/', [FormulirContoller::class, 'formRelasi'])->name('home');
// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/kode-wilayah', [KodeWilayahController::class, 'index']);
// Route::get('/ceknik', [NikController::class, 'index'])->name('ceknik');
// Route::get('/form-dante', [FormulirContoller::class, 'formDante'])->name('form.dante');
// Route::get('/form-team100', [FormulirContoller::class, 'formTeam100'])->name('form.team100');
// Route::get('/form-pejuang', [FormulirContoller::class, 'formPejuang'])->name('form.pejuang');
// Route::get('/form-luarnegeri', [FormulirContoller::class, 'formLuarnegeri'])->name('form.luarnegeri');
// Route::post('/form-dante', [FormulirContoller::class, 'storeDante']);
// Route::post('/form-team100', [FormulirContoller::class, 'storeTeam100']);
// Route::post('/form-pejuang', [FormulirContoller::class, 'storePejuang']);
Route::post('/', [FormulirContoller::class, 'storeRelasi']);
// Route::post('/form-luarnegeri', [FormulirContoller::class, 'storeLuarnegeri']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get(
        'dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard')->middleware('can:dashboard');
    Route::get('profile-edit', function () {
        return view('pages.profile', ['type_menu' => '']);
    })->name('profile.edit');
    Route::resource('user', UserController::class);
    Route::resource('profil-bisnis', ProfilBisnisController::class);

    Route::post('/import-dante', [KomandoTeritoriController::class, 'importExcel'])->name('import.dante.excel');
    Route::post('/import-team100', [Team100Controller::class, 'importExcel'])->name('import.team100.excel');
    Route::post('/import-pejuang', [PejuangController::class, 'importExcel'])->name('import.pejuang.excel');
    Route::post('/import-luarnegeri', [LuarnegeriController::class, 'importExcel'])->name('import.luarnegeri.excel');
    Route::get('/export-dante', [KomandoTeritoriController::class, 'exportToExcel']);
    Route::get('/export-team100', [Team100Controller::class, 'exportToExcel']);
    Route::get('/export-pejuang', [PejuangController::class, 'exportToExcel']);
    Route::get('/export-luarnegeri', [LuarnegeriController::class, 'exportToExcel']);

    Route::resource('dante', DanteController::class);
    Route::resource('member', MemberController::class);
    Route::resource('team100', Team100Controller::class);
    Route::resource('pejuang', PejuangController::class);
    Route::resource('luarnegeri', LuarnegeriController::class);
    Route::resource('kodewilayah', KodeWilayahController::class);
    Route::resource('komandoteritori', KomandoTeritoriController::class);
    Route::resource('ketuatim', KetuaTimController::class);
});
