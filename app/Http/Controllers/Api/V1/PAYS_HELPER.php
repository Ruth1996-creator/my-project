<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Pays;
use App\Models\Villes;

class PAYS_HELPER extends BASE_HELPER
{
    static function getPays()
    {
        $pays =  Pays::with("Villes")->orderBy("id", "desc")->get();
        return self::sendResponse($pays, 'Tout les pays récupérés avec succès!!');
    }
    ##_____RETRIEVE D'UN PAYS______##
    static function PaysRetrieve($id)
    {
        $pays = Pays::with("Villes")->find($id);
        if (!$pays) {
            return self::sendError("Ce pays n'existe pas!", 404);
        }

        return self::sendResponse($pays, "Pays récupé avec succès:!!");
    }

    ##___MODIFICATION D'UN PAYS____~###
    static function _updatePays($request, $id)
    {
        $formData = $request->all();
        $pays = Pays::find($id);

        // return $user;
        if (!$pays) {
            return self::sendError("Ce pays n'existe pas!", 404);
        };

        $pays->update($formData);
        return self::sendResponse($pays, "Votre pays a été modifié avec succès ");
    }
    ##___ FIN MODIFICATION D'UN PAYS~###


    ##_____ FIN RETRIEVE D'UN PAYS______##
    static function deletepays($request, $id)
    {
        $formData = $request->all();

        $pays = pays::find($id);

        // return $user;
        if (!$pays) {
            return self::sendError("Ce pays n'existe pas!", 404);
        };

        $pays->delete($formData);
        return self::sendResponse($pays, "Votre pays a été supprimer avec succès ");
    }
    ##___FIN SUPPRESSION  D'UN PRODUIT____~###

}
