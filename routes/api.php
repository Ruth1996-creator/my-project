<?php

use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\Authorization;
use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\DonController;
use App\Http\Controllers\Api\V1\LikeController;
use App\Http\Controllers\Api\V1\PaysController;
use App\Http\Controllers\Api\V1\VillesController;
use Illuminate\Support\Facades\Route;

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


Route::prefix('v1')->group(function () {
    ###========== USERs ROUTINGS ========###
    Route::controller(UserController::class)->group(function () {
        Route::prefix('user')->group(function () {
            Route::any('register', 'Register');
            Route::any('login', 'Login');
            Route::middleware(['auth:api'])->get('logout', 'Logout');
            Route::any('all', 'Users');
            Route::any('/{id}/retrieve', 'RetrieveUser');
            Route::any('password/update', 'UpdatePassword');
        });
    });
    Route::any('authorization', [Authorization::class, 'Authorization'])->name('authorization');

    ###========== PRODUCTS ROUTINGS ========###
    Route::controller(ProductController::class)->group(function () {
        Route::prefix('produit')->group(function () {
            Route::any('add', 'ProductCreate'); #AJOUT DE PRODUITS
            Route::any('all', 'Products'); #GET ALL PRODUCTS
            Route::any('{id}/retrieve', 'ProductRetrieve'); #RECUPERATION D'UN PRODUIT
            Route::any('{id}/update', 'UpdateProduct'); #MODIFICATION DE PRODUITS
            Route::any('{id}/delete', '_DeleteProduct'); #SUPPRESSION DE PRODUITS
            Route::any('{id}/reference', 'ProductReference'); #SUPPRESSION DE PRODUITS
            Route::any('{id}/remove', '_RemoveReference'); #SUPPRESSION DE PRODUITS
            Route::any('{search}/search', 'SearchProduct'); #SUPPRESSION DE PRODUITS
        });
    });


    ###========== PAYS ROUTINGS ========###
    Route::controller(PaysController::class)->group(function () {
        Route::prefix('pays')->group(function () {
            Route::any('all', 'Pays'); #GET ALL PAYS

            Route::any('{id}/retrieve', '_PaysRetrieve'); #RECUPERATION D'UN PAYS
            Route::any('{id}/retrieve', '_PaysRetrieve'); #RECUPERATION D'UN PAYS
            Route::any('{id}/update', 'UpdatePays'); #MODIFICATION DE PRODUITS
            Route::any('{id}/delete', '_DeletePays'); #SUPPRESSION DE PAYS
        });
    });

    ###========== VILLES ROUTINGS ========###
    Route::controller(VillesController::class)->group(function () {
        Route::prefix('villes')->group(function () {
            Route::any('add', 'VillesCreate'); #AJOUT DE PRODUITS
            Route::any('all', 'Villes'); #GET ALL PAYS
            Route::any('{id}/retrieve', '_VillesRetrieve'); #RECUPERATION D'UNE VILLES
            Route::any('{id}/retrieve', '_VillesRetrieve'); #RECUPERATION D'UN VILLES
            Route::any('{id}/update', 'UpdateVilles'); #MODIFICATION DE VILLES
            Route::any('{id}/delete', '_DeleteVilles'); #SUPPRESSION DE VILLES
        });
    });

    ###========== DONS ROUTINGS ========###
    Route::controller(DonController::class)->group(function () {
        Route::prefix('dons')->group(function () {
            Route::any('all', 'Dons'); #GET ALL DONS
            Route::any('{id}/retrieve', 'DonsRetrieve'); #RECUPERATION D'UN PAYS
            Route::any('{id}/delete', '_DeleteDons'); #SUPPRESSION DE PAYS
        });
    });
     ###========== FAN LISTE ROUTINGS ========###
     Route::controller(LikeController::class)->group(function () {
        Route::prefix('fan')->group(function () {
            Route::any('like', '_AddLikes'); #AJPUTER UN LOIKE  
            Route::any('all', 'Fan'); #GET ALL FAN
           // Route::any('{id}/retrieve', 'DonsRetrieve'); #RECUPERATION D'UN PAYS
           // Route::any('{id}/delete', '_DeleteDons'); #SUPPRESSION DE PAYS
        });
    });
});
