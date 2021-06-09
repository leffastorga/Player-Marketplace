<?php

use Illuminate\Support\Facades\Route;
use App\Models\Card;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['cards' => User::find(Auth::id())->with('cards')->get()]);
})->middleware(['auth'])->name('dashboard');

Route::get('/marketplace', function () {
    return view('marketplace', ['cards' => Card::with('users')->with('attributes')->get()]);
})->middleware(['auth'])->name('marketplace');

require __DIR__.'/auth.php';
