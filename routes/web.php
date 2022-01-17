<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Wallpaper\Image;
use App\Http\Controllers\Wallpaper\WallpaperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});
Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);


Route::get('wallpapers', [WallpaperController::class, 'index']);
Route::get('wallpapers', [WallpaperController::class, 'index'])->middleware(['auth:sanctum']);
Route::get('wallpapers/create', [WallpaperController::class, 'create'])->middleware(['auth:sanctum']);
Route::resource('wallpaper', WallpaperController::class);
