<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NikController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProvinsiController;
use App\Http\Controllers\Api\KabupatenController;
use App\Http\Controllers\Api\KecamatanController;
use App\Http\Controllers\Api\KelurahanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');
Route::get('/cek-nik/{nik}', [NikController::class, 'cek'])->name('cek.nik');
Route::apiResource('nik', NikController::class);

// Route::post('image/upload', [UploadController::class, 'uploadImage'])->middleware('auth:sanctum');
// Route::post('image/upload-multiple', [UploadController::class, 'uploadMultipleImage'])->middleware('auth:sanctum');
// Route::post('orders', [OrderController::class, 'order'])->middleware('auth:sanctum');

// Route::post('midtrans/notification/handling', [CallbackController::class, 'callback']);

// Route::apiResource('categories', CategoryController::class);
// Route::apiResource('products', ProductController::class);//->middleware('auth:sanctum');
// Route::apiResource('banners', BannerController::class);

Route::post('fcm-token', [AuthController::class, 'updateFcmToken'])
->middleware('auth:sanctum');
Route::apiResource('propinsi', ProvinsiController::class);
Route::apiResource('kabupaten', KabupatenController::class);
Route::apiResource('kecamatan', KecamatanController::class);
Route::apiResource('kelurahan', KelurahanController::class);