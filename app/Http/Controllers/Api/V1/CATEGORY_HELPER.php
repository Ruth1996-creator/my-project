<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Validator;

class CATEGORY_HELPER extends BASE_HELPER
{
    static function add_rules(): array
    {
        return [
            "name" => ["required"],

        ];
    }

    static function add_messages(): array
    {
        return [
            "name.required" => "Le nom de la catégorie  est réquise!",

        ];
    }

    static function CategoryCreate_Validator($formDatas)
    {
        #
        $rules = self::add_rules();
        $messages = self::add_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }


    static function createCategory($request)
    {
        $formData = $request->all();
        $user = request()->user();
        // return $user->id; 
        ####___TRAITEMENT DE L'IMAGE

        //$formData["user"] = $user->id;
        // $formData["product_category"]=$product_category->id;

        $user = ProductCategory::create($formData); #ENREGISTREMENT DE LA VILLE DANS LA DB

        return self::sendResponse($user, 'Catégorie ajoutée avec succès!!');
    }
    static function getCategory()
    {
        $category =  ProductCategory::with("Divisions")->orderBy("id", "desc")->get();
        return self::sendResponse($category, 'Tout les categories récupérées avec succès!!');
    }
    ##_____RETRIEVE D'UN PAYS______##
    static function CategoryRetrieve($id)
    {
        $category = ProductCategory::with("Divisions")->find($id);
        if (!$category) {
            return self::sendError("Cette categorie n'existe pas!", 404);
        }

        return self::sendResponse($category, "categorie récupé avec succès:!!");
    }

    ##___MODIFICATION D'UN VILLE ____~###
    static function updatecategory($request, $id)
    {
        $formData = $request->all();
        $category = ProductCategory::find($id);

        // return $user;
        if (!$category) {
            return self::sendError("Cette catégorie n'existe pas!", 404);
        };

        $category->update($formData);
        return self::sendResponse($category, "Votre catégorie a été modifié avec succès ");
    }
    ##___ FIN MODIFICATION D'UNE VILLE~###


    ##_____ FIN RETRIEVE D'UNE VILLE___##
    static function deletecategory($request, $id)
    {
        $formData = $request->all();

        $category = ProductCategory::find($id);

        // return $user;
        if (!$category) {
            return self::sendError("Cette catégorie n'existe pas!", 404);
        };

        $category->delete($formData);
        return self::sendResponse($category, "Votre catégorie a été supprimer avec succès ");
    }
    ##___FIN SUPPRESSION  D'UNE VILLES~###

    
}
