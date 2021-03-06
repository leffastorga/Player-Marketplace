<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Card;
use App\Models\User;
use App\Http\Controllers\BuysController;
use App\Http\Controllers\CreditUserController;

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
    $user = User::find(Auth::id());
    return view('dashboard', ['cards' => $user->cards]);
})->middleware(['auth'])->name('dashboard');

Route::get('/marketplace', function () {
    return view('marketplace', ['cards' => Card::with('users')->with('attributes')->get()]);
})->middleware(['auth'])->name('marketplace');

Route::get('/player/{card}', function(Card $card){
    return view('showcard', ['card' => $card]);
})->middleware(['auth', 'creditzero'])->name('player');

Route::get('/nocredit', function () {
    return view('nocredit');
})->middleware(['auth'])->name('nocredit');

Route::get('/my-account', function () {
    $user = User::find(Auth::id());
    return view('myaccount', ['user' => $user]);
})->middleware(['auth'])->name('my-account');

Route::get('/random', function () {
    $card = new Card;
    $user = User::find(Auth::id());
    $credit = $user->credit['credit'];
    $cards = $card->doesntHave('users')->get()->random(3);
    return view('random', [
        'cards' => $cards,
        'credit'=>$credit,
        'totalPrice' => $cards->sum('price')]);
})->middleware(['auth', 'creditzero'])->name('random');

Route::get('buys/purchase/{card}',[ BuysController::class, 'buyCard' ])->name('buys/purchase/');
Route::post('buys/purchase/random/',[ BuysController::class, 'buyRandomCards' ])->name('buys/purchase/random/');
Route::post('buys/purchase/scheduled/',[ BuysController::class, 'scheduledPurchase' ])->name('buys/purchase/scheduled/');
Route::put('credituser/{id}', [ CreditUserController::class, 'updateCredit' ])->name('credituser');



require __DIR__.'/auth.php';
