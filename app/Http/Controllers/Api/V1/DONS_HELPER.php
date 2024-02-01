<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Don;
use Illuminate\Support\Facades\Validator;


class DONS_HELPER extends BASE_HELPER
{
    static function add_rules(): array
    {
        return [
            "user" => ["required"],
            "montant" => ["required"],



        ];
    }

    static function add_messages(): array
    {
        return [
            "user.required" => "Le nom du  donnateur  est réquis!",
            "montant.required" => "Le montant du  don  est réquis!",



        ];
    }

    static function DonCreate_Validator($formDatas)
    {
        
        $rules = self::add_rules();
        $messages = self::add_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }

static function createDon($request)
    {
        $formData = $request->all();
        $user = request()->user();
        $formData["statut"] = "En cour...";

        $don = Don::create($formData); #ENREGISTREMENT DE LA VILLE DANS LA DB

        #=====ENVOIE DE NOTIFICATION =======~####
         //throw $th;
        

        return self::sendResponse($don, 'Don enregistrer avec succès!!');
    }
    static function getDons()
    {
        $dons =  Don::orderBy("id", "desc")->get();
        return self::sendResponse($dons, 'Tout les dons récupérés avec succès!!');
    }
##_____RETRIEVE D'UN PAYS______##
static function DonsRetrieve($id)
{
    $dons = Don::find($id);
    if (!$dons) {
        return self::sendError("Ce relevé de don n'existe pas!", 404);
    }

    return self::sendResponse($dons, "Relevé de don récupé avec succès:!!");
}
##_____ FIN RETRIEVE D'UN PAYS______##
static function deleteDons($request, $id)
    {
        $formData = $request->all();

        $dons = Don::find($id);

        // return $user;
        if (!$dons) {
            return self::sendError("Ce relevé de don n'existe pas!", 404);
        };

        $dons->delete($formData);
        return self::sendResponse($dons, "Votre relevé de don a été supprimer avec succès ");
    }
    ##___FIN SUPPRESSION  D'UN PRODUIT____~###

}