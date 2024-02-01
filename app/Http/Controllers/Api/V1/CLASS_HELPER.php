<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Classe;
use App\Models\Division;
use Illuminate\Support\Facades\Validator;
class CLASS_HELPER extends BASE_HELPER
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
            "name.required" => "Le nom de la classe  est réquis!",

        ];
    }

    static function ClassCreate_Validator($formDatas)
    {
        #
        $rules = self::add_rules();
        $messages = self::add_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }


    static function createClass($request)
    {
        $formData = $request->all();
        $user = request()->user();
        
        // return $user->id; 
        ####___TRAITEMENT DE L'IMAGE

        //$formData["user"] = $user->id;
        // $formData["product_category"]=$product_category->id;

        $user = Classe::create($formData); #ENREGISTREMENT DE LA VILLE DANS LA DB

        #=====ENVOIE DE NOTIFICATION =======~####
         //throw $th;
        

        return self::sendResponse($user, 'classe ajoutée avec succès!!');
    }
    static function getClasse()
    {
        $classe =  Classe::with("division")->orderBy("id", "desc")->get();
        return self::sendResponse($classe, 'Toutes les classes récupérés avec succès!!');
    }
    ##_____RETRIEVE D'UN PAYS______##
    static function ClassRetrieve($id)
    {
        $classe = Classe::with("division")->find($id);
        if (!$classe) {
            return self::sendError("Cette classe n'existe pas!", 404);
        }

        return self::sendResponse($classe, "Classe récupé avec succès:!!");
    }

    ##___MODIFICATION D'UN VILLE ____~###
    static function _updateClass($request, $id)
    {
        $formData = $request->all();
        $classe = Classe::find($id);

        // return $user;
        if (!$classe) {
            return self::sendError("Cette classe n'existe pas!", 404);
        };

        $classe->update($formData);
        return self::sendResponse($classe, "Votre classe a été modifié avec succès ");
    }
    ##___ FIN MODIFICATION D'UNE VILLE~###


    ##_____ FIN RETRIEVE D'UNE VILLE___##
    static function deleteclass($request, $id)
    {
        $formData = $request->all();

        $classe = Classe::find($id);

        // return $user;
        if (!$classe) {
            return self::sendError("Cette classe n'existe pas!", 404);
        };

        $classe->delete($formData);
        return self::sendResponse($classe, "Votre classe a été supprimer avec succès ");
    }
    ##___FIN SUPPRESSION  D'UNE VILLES~###*

    static function affectDivision($request, $id)
    {
        $classe = Classe::find($id);
        $division = Division::find($request->get("division"));

        if(!$request->get("division")){
            return self::sendError("Le champ division est réquise!", 404);
        }
        // return $user;
        if (!$classe) {
            return self::sendError("Cette classe n'existe pas!", 404);
        };
        if (!$division) {
            return self::sendError("Cette division n'existe pas!", 404);
        };

        $classe->division = $request->get("division");
        $classe->save();

        return self::sendResponse($classe, "Classe affectée a la categorie  avec succès ");
    }

}
