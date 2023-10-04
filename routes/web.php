<?php

use App\Http\Controllers\GifsController;
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

Route::get('/', [GifsController::class, 'index'])->name('home');
Route::get('/gifs/search', [GifsController::class, 'search'])->name('gifs.search');
Route::get('/gifs/history', [GifsController::class, 'history'])->name('gifs.history');
Route::delete('/gifs/history/{search}', [GifsController::class, 'removeBySearch'])->name('gifs.removeBySearch');
