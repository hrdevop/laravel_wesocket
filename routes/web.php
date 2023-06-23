<?php

use App\Http\Controllers\MarkerController;
use App\Http\Controllers\userAuthController;
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



Route::post('/login', [userAuthController::class, 'login'])->name('login');
Route::get('/', function () {
    return view('login');
});

// Route for creating a new marker
Route::post('/markers', [MarkerController::class, 'onAddMarker']);

Route::get('dashboard/{userId}', function ($userId) {
    return view('dashboard',compact('userId'));
});
