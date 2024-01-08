<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Arrondissement;
use App\Models\Commune;
use Illuminate\Support\Facades\Validator;
class ARRONDISSEMENT_HELPER extends BASE_HELPER
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
            "name.required" => "Le nom de l'arrondissement  est réquis!",

        ];
    }

    static function ArrondissementCreate_Validator($formDatas)
    {
        #
        $rules = self::add_rules();
        $messages = self::add_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }


    static function createArrondissement($request)
    {
        $formData = $request->all();
        $user = request()->user();
        //$commune = Commune::find($formData["commune_id"]);
        //if (!$commune) {
           // return self::sendError("Cette commune n'existe pas!", 404);
       // }
        // return $user->id; 

        //$formData["user"] = $user->id;
        // $formData["product_category"]=$product_category->id;

        $user = Arrondissement::create($formData); #ENREGISTREMENT DE LA VILLE DANS LA DB

        #=====ENVOIE DE NOTIFICATION =======~####
         //throw $th;
        

        return self::sendResponse($user, 'arrondissement ajoutée avec succès!!');
    }
    static function getArrondissements()
    {
        $arrondissement =  Arrondissement::with(["commune","quatiers"])->orderBy("id", "desc")->get();
        return self::sendResponse($arrondissement, 'Tous les arrondissements récupérés avec succès!!');
    }
    ##_____RETRIEVE D'UN PAYS______##
    static function ArrondissementRetrieve($id)
    {
        $arrondissement = Arrondissement::with(["commune","quatiers"])->find($id);
        if (!$arrondissement) {
            return self::sendError("Cette commune n'existe pas!", 404);
        }

        return self::sendResponse($arrondissement, "Arrondissement récupé avec succès:!!");
    }

    ##___MODIFICATION D'UN VILLE ____~###
    static function _updateArrondissement($request, $id)
    {
        $formData = $request->all();
        $arrondissement = Arrondissement::find($id);

        // return $user;
        if (!$arrondissement) {
            return self::sendError("Cette arrondissement n'existe pas!", 404);
        };

        $arrondissement->update($formData);
        return self::sendResponse($arrondissement, "Votre Arrondissement a été modifié avec succès ");
    }
    ##___ FIN MODIFICATION D'UNE VILLE~###


    ##_____ FIN RETRIEVE D'UNE VILLE___##
    static function deletearrondissement($request, $id)
    {
        $formData = $request->all();

        $arrondissement = Arrondissement::find($id);

        // return $user;
        if (!$arrondissement) {
            return self::sendError("Cet arrondissement n'existe pas!", 404);
        };

        $arrondissement->delete($formData);
        return self::sendResponse($arrondissement, "Votre arrondissement a été supprimer avec succès ");
    }
    ##___FIN SUPPRESSION  D'UNE VILLES~###*

    static function affectCommune($request, $id)
    {
        $arrondissement = Arrondissement::find($id);
        $commune = Commune::find($request->get("commune"));

        if(!$request->get("commune")){
            return self::sendError("Le champ commune est réquise!", 404);
        }
        // return $user;
        if (!$arrondissement) {
            return self::sendError("Cet arrondissement n'existe pas!", 404);
        };
        if (!$commune) {
            return self::sendError("Cette commune n'existe pas!", 404);
        };

        $arrondissement->commune_id = $request->get("commune");
        $arrondissement->save();

        return self::sendResponse($arrondissement, "Arrondissement affectée a la commune  avec succès ");
    }

}
