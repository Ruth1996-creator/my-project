<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;

class ArrondissementController extends ARRONDISSEMENT_HELPER
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'scope:api-access']);
        $this->middleware("CheckIfUserIsEditer")->only([
            "ArrondissementCreate",
            "UpdateArrondissement",
            "_DeleteArrondissement",
            "AffectToCommune"
        ]);
    }

    #VERIFIONS SI LE USER EST AUTHENTIFIE
       // public function __construct()
        //{
            //$this->middleware(['auth:api', 'scope:api-access']);
        //}
        function ArrondissementCreate(Request $request)
    {
        #VERIFICATION DE LA METHOD
        if ($this->methodValidation($request->method(), "POST") == False) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
        };
       
        #VALIDATION DES DATAs DEPUIS LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
        $validator = $this->ArrondissementCreate_Validator($request->all());

        if ($validator->fails()) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError($validator->errors(), 404);
        }

        #ENREGISTREMENT DANS LA DB VIA **createProduct** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
        return $this->createArrondissement($request);
    }
      #GET ALL USERS
      function Arrondissements(Request $request)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "GET") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
  
          #RECUPERATION DE TOUT LES UTILISATEURS AVEC LEURS ROLES & TRANSPORTS
          return $this->getArrondissements();
      }
  
          function _ArrondissementRetrieve(Request $request, $id)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "GET") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
  
          #RECUPERATION D'UN PAYS VIA SON **id**
          return $this->arrondissementretrieve($id);
      }
  
      function UpdateArrondissement(Request $request,$id)
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
          return $this->_updateArrondissement($request,$id);
      }
  
      #SUPPRIMER UN PRODUIT
      function _DeleteArrondissement(Request $request,$id)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "POST") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
   
          #RECUPERATION D'UN PRODUIT VIA SON **id**
          return $this->deleteArrondissement($request,$id);
      }
      function AffectToCommune(Request $request,$id)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "POST") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
   
          #RECUPERATION D'UN PRODUIT VIA SON **id**
          return $this->affectCommune($request,$id);
      }
}
