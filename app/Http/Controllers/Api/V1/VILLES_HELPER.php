<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Validator;

use App\Models\Pays;
use App\Models\Villes;

class Villes_HELPER extends BASE_HELPER
{
    static function add_rules(): array
    {
        return [
            "name" => ["required"],
            'pays_id' => ['required', 'integer']

        ];
    }

    static function add_messages(): array
    {
        return [
            "name.required" => "Le nom de la villes  est réquis!",
            "pays_id.required" => "Veuillez préciser le pays de la ville!",
            "product_category.integer" => "Le pays de la ville doit être un entier!",

        ];
    }

    static function VillesCreate_Validator($formDatas)
    {
        #
        $rules = self::add_rules();
        $messages = self::add_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }


    static function createVilles($request)
    {
        $formData = $request->all();
        $user = request()->user();
        $pays = Pays::find($formData["pays_id"]);
        if (!$pays) {
            return self::sendError("Ce pays n'existe pas!", 404);
        }
        // return $user->id; 
        ####___TRAITEMENT DE L'IMAGE

        //$formData["user"] = $user->id;
        // $formData["product_category"]=$product_category->id;

        $user = Villes::create($formData); #ENREGISTREMENT DE LA VILLE DANS LA DB

        #=====ENVOIE DE NOTIFICATION =======~####
        $message = "Votre Ville a été ajouter avec succès sur FOCUS 54";

        try {
            Send_Notification(
                $user,
                "AJPOUT DE VILLES SUR FOCUS 54",
                $message
            );
        } catch (\Throwable $th) {
            //throw $th;
        }

        return self::sendResponse($user, 'ville ajoutée avec succès!!');
    }
    static function getVilles()
    {
        $villes =  Villes::with("Pays")->orderBy("id", "desc")->get();
        return self::sendResponse($villes, 'Tout les villes récupérés avec succès!!');
    }
    ##_____RETRIEVE D'UN PAYS______##
    static function VillesRetrieve($id)
    {
        $villes = Villes::with("Pays")->find($id);
        if (!$villes) {
            return self::sendError("Cette ville n'existe pas!", 404);
        }

        return self::sendResponse($villes, "Villes récupé avec succès:!!");
    }

    ##___MODIFICATION D'UN VILLE ____~###
    static function _updateVilles($request, $id)
    {
        $formData = $request->all();
        $villes = Villes::find($id);

        // return $user;
        if (!$villes) {
            return self::sendError("Cette ville n'existe pas!", 404);
        };

        $villes->update($formData);
        return self::sendResponse($villes, "Votre ville a été modifié avec succès ");
    }
    ##___ FIN MODIFICATION D'UNE VILLE~###


    ##_____ FIN RETRIEVE D'UNE VILLE___##
    static function deletevilles($request, $id)
    {
        $formData = $request->all();

        $villes = Villes::find($id);

        // return $user;
        if (!$villes) {
            return self::sendError("Cette villes n'existe pas!", 404);
        };

        $villes->delete($formData);
        return self::sendResponse($villes, "Votre villes a été supprimer avec succès ");
    }
    ##___FIN SUPPRESSION  D'UNE VILLES~###

}
