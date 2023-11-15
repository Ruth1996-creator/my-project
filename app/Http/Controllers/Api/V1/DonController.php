<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;

class DonController extends DONS_HELPER
{
        #VERIFIONS SI LE USER EST AUTHENTIFIE
       // public function __construct()
        //{
            //$this->middleware(['auth:api', 'scope:api-access']);
        //}
      #GET ALL USERS
    function Dons(Request $request)
    {
        #VERIFICATION DE LA METHOD
        if ($this->methodValidation($request->method(), "GET") == False) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
        };

        #RECUPERATION DE TOUT LES UTILISATEURS AVEC LEURS ROLES & TRANSPORTS
        return $this->getDons();
    }

        function _DonsRetrieve(Request $request, $id)
    {
        #VERIFICATION DE LA METHOD
        if ($this->methodValidation($request->method(), "GET") == False) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
        };

        #RECUPERATION D'UN PAYS VIA SON **id**
        return $this->donsretrieve($id);
    }
    #SUPPRIMER UN PRODUIT
    function _DeleteDons(Request $request,$id)
    {
        #VERIFICATION DE LA METHOD
        if ($this->methodValidation($request->method(), "POST") == False) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
        };
 
        #RECUPERATION D'UN PRODUIT VIA SON **id**
        return $this->deleteDons($request,$id);
    }
}
