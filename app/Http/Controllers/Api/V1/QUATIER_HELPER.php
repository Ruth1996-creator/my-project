<?php
namespace App\Http\Controllers\Api\V1;
use App\Models\Arrondissement;
use App\Models\Quatier;
use Illuminate\Support\Facades\Validator;
class QUATIER_HELPER extends BASE_HELPER
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
            "name.required" => "Le nom de du quartier  est réquis!",

        ];
    }

    static function QuatierCreate_Validator($formDatas)
    {
        #
        $rules = self::add_rules();
        $messages = self::add_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }


    static function createQuatier($request)
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

        $user = Quatier::create($formData); #ENREGISTREMENT DE LA VILLE DANS LA DB

        #=====ENVOIE DE NOTIFICATION =======~####
         //throw $th;
        

        return self::sendResponse($user, 'Quatier ajoutée avec succès!!');
    }
    static function getQuatiers()
    {
        $quatier =  Quatier::with("arrondissement")->orderBy("id", "desc")->get();
        return self::sendResponse($quatier, 'Tous les quatiers récupérés avec succès!!');
    }
    ##_____RETRIEVE D'UN PAYS______##
    static function QuatierRetrieve($id)
    {
        $quatier = Quatier::with("arrondissement")->find($id);
        if (!$quatier) {
            return self::sendError("Ce Quatier n'existe pas!", 404);
        }

        return self::sendResponse($quatier, "Quatier récupé avec succès:!!");
    }

    ##___MODIFICATION D'UN VILLE ____~###
    static function _updateQuatier($request, $id)
    {
        $formData = $request->all();
        $quatier = Quatier::find($id);

        // return $user;
        if (!$quatier) {
            return self::sendError("Ce quatier n'existe pas!", 404);
        };

        $quatier->update($formData);
        return self::sendResponse($quatier, "Votre quatier a été modifié avec succès ");
    }
    ##___ FIN MODIFICATION D'UNE VILLE~###


    ##_____ FIN RETRIEVE D'UNE VILLE___##
    static function deleteQuatier($request, $id)
    {
        $formData = $request->all();

        $quatier = Quatier::find($id);

        // return $user;
        if (!$quatier) {
            return self::sendError("Ce quatier n'existe pas!", 404);
        };

        $quatier->delete($formData);
        return self::sendResponse($quatier, "Votre quatier a été supprimer avec succès ");
    }
    ##___FIN SUPPRESSION  D'UNE VILLES~###*

    static function affectArrondissement($request, $id)
    {
        $quatier = Quatier::find($id);
        $arrondissement = Arrondissement::find($request->get("arrondissement"));

        if(!$request->get("arrondissement")){
            return self::sendError("Le champ arrondissement est réquise!", 404);
        }
        // return $user;
        if (!$quatier) {
            return self::sendError("Ce quatier n'existe pas!", 404);
        };
        if (!$arrondissement) {
            return self::sendError("Ce quatier n'existe pas!", 404);
        };

        $quatier->arrondissement_id = $request->get("arrondissement");
        $quatier->save();

        return self::sendResponse($quatier, "Quatier affectée a la commune  avec succès ");
    }

}
