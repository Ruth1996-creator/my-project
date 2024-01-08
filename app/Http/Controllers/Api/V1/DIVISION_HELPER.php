<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Classe;
use App\Models\Division;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Validator;
class DIVISION_HELPER extends BASE_HELPER
{
    static function add_rules(): array
    {
        return [
            "name" => ["required"],
            'product_category' => ['required', 'integer']

        ];
    }

    static function add_messages(): array
    {
        return [
            "name.required" => "Le nom de la division  est réquis!",
            "product_category.required" => "Veuillez préciser la categorie du produit !",
            "product_category.integer" => "La categorie du produit  doit être un entier!",

        ];
    }

    static function DivisionCreate_Validator($formDatas)
    {
        #
        $rules = self::add_rules();
        $messages = self::add_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }


    static function createDivision($request)
    {
        $formData = $request->all();
        $user = request()->user();
        $category = ProductCategory::find($formData["product_category"]);
        if (!$category) {
            return self::sendError("Cette categorie de produit n'existe pas!", 404);
        }
        // return $user->id; 
        ####___TRAITEMENT DE L'IMAGE

        //$formData["user"] = $user->id;
        // $formData["product_category"]=$product_category->id;

        $user = Division::create($formData); #ENREGISTREMENT DE LA VILLE DANS LA DB

        #=====ENVOIE DE NOTIFICATION =======~####
         //throw $th;
        

        return self::sendResponse($user, 'classe ajoutée avec succès!!');
    }
    static function getDivision()
    {
        $division =  Division::with("Category","Classes")->orderBy("id", "desc")->get();
        return self::sendResponse($division, 'Toutes les divisions récupérés avec succès!!');
    }
    ##_____RETRIEVE D'UN PAYS______##
    static function DivisionRetrieve($id)
    {
        $division = Division::with("Category","Classes")->find($id);
        if (!$division) {
            return self::sendError("Cette division n'existe pas!", 404);
        }

        return self::sendResponse($division, "Division récupé avec succès:!!");
    }

    ##___MODIFICATION D'UN VILLE ____~###
    static function _updateDivision($request, $id)
    {
        $formData = $request->all();
        $division = Division::find($id);

        // return $user;
        if (!$division) {
            return self::sendError("Cette division n'existe pas!", 404);
        };

        $division->update($formData);
        return self::sendResponse($division, "Votre division a été modifié avec succès ");
    }
    ##___ FIN MODIFICATION D'UNE VILLE~###


    static function deletedivision($request, $id)
    {
        $formData = $request->all();

        $division = Division::find($id);

        // return $user;
        if (!$division) {
            return self::sendError("Cette division n'existe pas!", 404);
        };

        $division->delete($formData);
        return self::sendResponse($division, "Votre division a été supprimer avec succès ");
    }
    ##___FIN SUPPRESSION  D'UNE VILLES~###
    static function affectCategory($request, $id)
    {
        $division = Division::find($id);
        $category = ProductCategory::find($request->get("category"));

        if(!$request->get("category")){
            return self::sendError("Le champ categorie est réquise!", 404);
        }
        // return $user;
        if (!$division) {
            return self::sendError("Cette division n'existe pas!", 404);
        };
        if (!$category) {
            return self::sendError("Cette categorie n'existe pas!", 404);
        };

        $division->product_category = $request->get("category");
        $division->save();

        return self::sendResponse($division, "Division affectée a la categorie  avec succès ");
    }

}
