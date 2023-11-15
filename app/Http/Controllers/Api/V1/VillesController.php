<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;

class VillesController extends VILLES_HELPER
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'scope:api-access']);
        $this->middleware("CheckIfUserIsEditer")->only([
            "VillesCreate",
            "UpdateVilles",
            "_DeleteVilles",
        ]);
    }

    #VERIFIONS SI LE USER EST AUTHENTIFIE
       // public function __construct()
        //{
            //$this->middleware(['auth:api', 'scope:api-access']);
        //}
        function VillesCreate(Request $request)
    {
        #VERIFICATION DE LA METHOD
        if ($this->methodValidation($request->method(), "POST") == False) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
        };
       
        #VALIDATION DES DATAs DEPUIS LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
        $validator = $this->VillesCreate_Validator($request->all());

        if ($validator->fails()) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError($validator->errors(), 404);
        }

        #ENREGISTREMENT DANS LA DB VIA **createProduct** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
        return $this->createVilles($request);
    }
      #GET ALL USERS
      function Villes(Request $request)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "GET") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
  
          #RECUPERATION DE TOUT LES UTILISATEURS AVEC LEURS ROLES & TRANSPORTS
          return $this->getVilles();
      }
  
          function _VillesRetrieve(Request $request, $id)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "GET") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
  
          #RECUPERATION D'UN PAYS VIA SON **id**
          return $this->villesretrieve($id);
      }
  
      function UpdateVilles(Request $request,$id)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "POST") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
   
       //    #VALIDATION DES DATAs DEPUIS LA CLASS USER_HELPER
       //    $validator = $this->NEW_PRODUCT_Validator($request->all());
       //    if ($validator->fails()) {
       //        #RENVOIE D'ERREURE VIA **sendResponse** DE LA CLASS PRODUCT_HELPER
       //        return $this->sendError($validator->errors(), 404);
       //    }
   
          #RECUPERATION D'UN PRODUIT VIA SON **id**
          return $this->_updateVilles($request,$id);
      }
  
      #SUPPRIMER UN PRODUIT
      function _DeleteVilles(Request $request,$id)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "POST") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
   
          #RECUPERATION D'UN PRODUIT VIA SON **id**
          return $this->deleteVilles($request,$id);
      }
}
