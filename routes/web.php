<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\ProductController;
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
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        // fetch all users
        $users = User::all();

        return view('dashboard',compact('users'));
    })->name('dashboard');

    Route::get('/invoice', [ProductController::class, 'index'])->name('invoice');
    Route::post('/add/item',[ProductController::class,'addItem'])->name('store.item');
    Route::get('/edit/item/{id}',[ProductController::class,'editItem']);
    Route::post('/update/item/{id}',[ProductController::class,'updateItem']);
    Route::get('/delete/item/{id}',[ProductController::class,'Delete']);
    
    // Restore & Erase Permanently
    Route::get('/restore/item/{id}',[ProductController::class, 'Restore']);
    Route::get('/wipe/item/{id}',[ProductController::class, 'Wipe']);


   

});

