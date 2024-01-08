<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Commune;
use Illuminate\Support\Facades\Validator;

use App\Models\Pays;
class COMMUNE_HELPER extends BASE_HELPER
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
            "name.required" => "Le nom de la commune  est réquis!",

        ];
    }

    static function CommuneCreate_Validator($formDatas)
    {
        #
        $rules = self::add_rules();
        $messages = self::add_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }


    static function createCommune($request)
    {
        $formData = $request->all();
        $user = request()->user();
       // $pays = Pays::find($formData["pays_id"]);
        //if (!$pays) {
            //return self::sendError("Ce pays n'existe pas!", 404);
        //}
        // return $user->id; 
        ####___TRAITEMENT DE L'IMAGE

        //$formData["user"] = $user->id;
        // $formData["product_category"]=$product_category->id;

        $user = Commune::create($formData); #ENREGISTREMENT DE LA VILLE DANS LA DB

        return self::sendResponse($user, 'commune ajoutée avec succès!!');
    }
    static function getCommune()
    {
        $commune =  Commune::with("arrondissements","Pays")->orderBy("id", "desc")->get();
        return self::sendResponse($commune, 'Toutes les commune récupérés avec succès!!');
    }
    ##_____RETRIEVE D'UN PAYS______##
    static function CommuneRetrieve($id)
    {
        $commune = Commune::with("arrondissements","Pays")->find($id);
        if (!$commune) {
            return self::sendError("Cette commune n'existe pas!", 404);
        }

        return self::sendResponse($commune, "commune récupé avec succès:!!");
    }

    ##___MODIFICATION D'UN VILLE ____~###
    static function _updateCommune($request, $id)
    {
        $formData = $request->all();
        $commune = Commune::find($id);

        // return $user;
        if (!$commune) {
            return self::sendError("Cette commune n'existe pas!", 404);
        };

        $commune->update($formData);
        return self::sendResponse($commune, "Votre commune a été modifié avec succès ");
    }
    ##___ FIN MODIFICATON D'UNE VILLE~###


    ##_____ FIN RETRIEVE D'IUNE VILLE___##
    static function deletecommune($request, $id)
    {
        $formData = $request->all();

        $commune = Commune::find($id);

        // return $user;
        if (!$commune) {
            return self::sendError("Cette commune n'existe pas!", 404);
        };

        $commune->delete($formData);
        return self::sendResponse($commune, "Votre commune a été supprimer avec succès ");
    }
    ##___FIN SUPPRESSION  D'UNE VILLES~###

    static function affecttopays($request, $id)
    {
        $commune = Commune::find($id);
        $pays = Pays::find($request->get("pays"));

        if(!$request->get("pays")){
            return self::sendError("Le champ pays est réquise!", 404);
        }
        // return $user;
        if (!$commune) {
            return self::sendError("Cette commune n'existe pas!", 404);
        };
        if (!$pays) {
            return self::sendError("Ce pays n'existe pas!", 404);
        };

        $commune->pays_id = $request->get("pays");
        $commune->save();

        return self::sendResponse($commune, "Commune affectée au pays  avec succès ");
    }

}
