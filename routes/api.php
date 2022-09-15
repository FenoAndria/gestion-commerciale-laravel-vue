<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\CommandeController;
use App\Http\Controllers\API\FactureController;
use App\Http\Controllers\API\ProduitController;
use App\Http\Controllers\API\StockController;
use App\Http\Controllers\API\TypeProduitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {
    return response()->json([
        'message' => 'Vous devez vous connecter pour bénéficier nos ressources'
    ]);
})->name('api-home');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('produit', ProduitController::class);
    Route::apiResource('type-produit', TypeProduitController::class);
    Route::post('stock/ajout/{produit}', [StockController::class, 'store']);
    Route::apiResource('client', ClientController::class);
    Route::apiResource('commande', CommandeController::class);
    Route::apiResource('facture', FactureController::class);
    Route::post('facture/finaliser/{facture}', [FactureController::class, 'finaliser']);
    Route::post('facture/payer/{facture}', [FactureController::class, 'payer']);
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('api-logout');
});

Route::post('auth/login', [AuthController::class, 'login'])->name('api-login');
Route::post('auth/register', [AuthController::class, 'register'])->name('api-register');

