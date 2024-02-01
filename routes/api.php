<?php

use App\Http\Controllers\Api\V1\ArrondissementController;
use App\Http\Controllers\Api\V1\ClasseController;
use App\Http\Controllers\Api\V1\CommuneController;
use App\Http\Controllers\Api\V1\DivisionController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\Authorization;
use App\Http\Controllers\Api\V1\DonController;
use App\Http\Controllers\Api\V1\LikeController;
use App\Http\Controllers\Api\V1\PaysController;
use App\Http\Controllers\Api\V1\ProductCategoryController;
use App\Http\Controllers\Api\V1\ProductReferenceController;
use App\Http\Controllers\Api\V1\QuatierController;
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
           // Route::any('{id}/reference', 'ProductReference'); #SUPPRESSION DE PRODUITS
           // Route::any('{id}/remove', '_RemoveReference'); #SUPPRESSION DE PRODUITS
            Route::any('{search}/search', 'SearchProduct'); #SUPPRESSION DE PRODUITS
            Route::any('{id}/affect', 'AffectToClasse'); #SUPPRESSION DE VILLES

        });
    });


     Route::controller(ProductReferenceController::class)->group(function () {
        Route::prefix('reference')->group(function () {
            Route::any('add', 'ProductReference'); #SUPPRESSION DE PRODUITS
            Route::any('{id}/remove', '_RemoveReference'); #SUPPRESSION DE PRODUITS

        });
    });


    ###========== PAYS ROUTINGS ========###
    Route::controller(PaysController::class)->group(function () {
        Route::prefix('pays')->group(function () {
            Route::any('all', 'Pays'); #GET ALL PAYS
            Route::any('add', 'PaysCreate'); #AJOUT DE PRODUITS
            Route::any('{id}/retrieve', '_PaysRetrieve'); #RECUPERATION D'UN PAYS
            Route::any('{id}/retrieve', '_PaysRetrieve'); #RECUPERATION D'UN PAYS
            Route::any('{id}/update', 'UpdatePays'); #MODIFICATION DE PRODUITS
            Route::any('{id}/delete', '_DeletePays'); #SUPPRESSION DE PAYS
        });
    });

    ###========== COMMUNES ROUTINGS ========###
    Route::controller(CommuneController::class)->group(function () {
        Route::prefix('commune')->group(function () {
            Route::any('add', 'CommuneCreate'); #AJOUT DE PRODUITS
            Route::any('all', 'Communes'); #GET ALL PAYS
            Route::any('{id}/retrieve', '_CommuneRetrieve'); #RECUPERATION D'UNE VILLES
            Route::any('{id}/update', 'UpdateCommune'); #MODIFICATION DE VILLES
            Route::any('{id}/delete', '_DeleteCommune'); #SUPPRESSION DE VILLES
            Route::any('{id}/affect', '_AffectToPays'); #SUPPRESSION DE VILLES

        });
    });

    ###========== ARRONDISSEMENT ROUTINGS ========###
    Route::controller(ArrondissementController::class)->group(function () {
        Route::prefix('Arrondissement')->group(function () {
            Route::any('add', 'ArrondissementCreate'); #AJOUT DE PRODUITS
            Route::any('all', 'Arrondissements'); #GET ALL PAYS
            Route::any('{id}/retrieve', '_ArrondissementRetrieve'); #RECUPERATION D'UN VILLES
            Route::any('{id}/update', 'UpdateArrondissement'); #MODIFICATION DE VILLES
            Route::any('{id}/delete', '_DeleteArrondissement'); #SUPPRESSION DE VILLES
            Route::any('{id}/affect', 'AffectToCommune'); #SUPPRESSION DE VILLES

        });
    });
    ###========== QUATIER ROUTINGS ========###
    Route::controller(QuatierController::class)->group(function () {
        Route::prefix('quatier')->group(function () {
            Route::any('add', 'QuatierCreate'); #AJOUT DE PRODUITS
            Route::any('all', 'Quatiers'); #GET ALL PAYS
            Route::any('{id}/retrieve', '_QuatierRetrieve'); #RECUPERATION D'UN VILLES
            Route::any('{id}/update', 'UpdateQuatier'); #MODIFICATION DE VILLES
            Route::any('{id}/delete', '_DeleteQuatier'); #SUPPRESSION DE VILLES
            Route::any('{id}/affect', 'AffectToArrondissement'); #SUPPRESSION DE VILLES

        });
    });

    ###========== DONS ROUTINGS ========###
    Route::controller(DonController::class)->group(function () {
        Route::prefix('dons')->group(function () {
            Route::any('add', 'DonCreate'); #GET ALL DONS
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
    ###========== CATEGORY ROUTINGS ========###
    Route::controller(ProductCategoryController::class)->group(function () {
        Route::prefix('categories')->group(function () {
            Route::any('add', 'CategoryCreate'); #AJOUT DE PRODUITS
            Route::any('all', 'Category'); #GET ALL PAYS
            Route::any('{id}/retrieve', '_CategoryRetrieve'); #RECUPERATION D'UN VILLES
            Route::any('{id}/update', '_UpdateCategory'); #MODIFICATION DE VILLES
            Route::any('{id}/delete', '_DeleteCategory'); #SUPPRESSION DE VILLES

        });
    });
    ###========== DIVISIONS ROUTINGS ========###
    Route::controller(DivisionController::class)->group(function () {
        Route::prefix('division')->group(function () {
            Route::any('add', 'DivisionCreate'); #AJOUT DE PRODUITS
            Route::any('all', 'Division'); #GET ALL PAYS
            Route::any('{id}/retrieve', '_DivisionRetrieve'); #RECUPERATION D'UN VILLES
            Route::any('{id}/update', 'UpdateDivistion'); #MODIFICATION DE VILLES
            Route::any('{id}/delete', '_DeleteDivision'); #SUPPRESSION DE VILLES
            Route::any('{id}/affect', 'AffectToCategory'); #SUPPRESSION DE VILLES

        });
    });
    ###========== CLASSE ROUTINGS ========###
    Route::controller(ClasseController::class)->group(function () {
        Route::prefix('classe')->group(function () {
            Route::any('add', 'ClassCreate'); #AJOUT DE PRODUITS
            Route::any('all', 'Classe'); #GET ALL PAYS
            Route::any('{id}/retrieve', '_ClassRetrieve'); #RECUPERATION D'UN VILLES
            Route::any('{id}/update', 'UpdateClass'); #MODIFICATION DE VILLES
            Route::any('{id}/delete', '_DeleteClass'); #SUPPRESSION DE VILLES
            Route::any('{id}/affect', 'AffectToDivision'); #SUPPRESSION DE VILLES

        });
    });
});
