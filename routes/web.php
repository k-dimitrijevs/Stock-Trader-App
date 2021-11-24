<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\TransactionsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/stocks/search', [StocksController::class, 'search'])
    ->middleware(['auth'])
    ->name('search');
Route::get('/stocks/{symbol}', [StocksController::class, 'viewCompany'])
    ->middleware(['auth'])
    ->name('viewCompany');
Route::put('stocks/{symbol}/purchase', [StocksController::class, 'purchase'])
    ->middleware(['auth'])
    ->name('purchase');
Route::get('stocks/invalidPurchase', [StocksController::class, 'purchase'])
    ->middleware(['auth'])
    ->name('invalidPurchase');

Route::get('/myStocks', [StocksController::class, 'viewMyStocks'])
    ->middleware(['auth'])
    ->name('myStocks');
Route::patch('/myStocks/{myStock}/sellStock', [StocksController::class, 'sellStock'])
    ->middleware(['auth'])
    ->name('sellStock');

Route::get('/balance', [BalanceController::class, 'viewBalance'])
    ->middleware(['auth'])
    ->name('viewBalance');
Route::put('/balance/add', [BalanceController::class, 'addBalance'])
    ->middleware(['auth'])
    ->name('addBalance');

Route::get('/transactions', [TransactionsController::class, 'viewTransactions'])
    ->middleware(['auth'])
    ->name('viewTransactions');

require __DIR__.'/auth.php';
