<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Don;

class DONS_HELPER extends BASE_HELPER
{
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