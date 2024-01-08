<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
class DivisionController extends Division_HELPER
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'scope:api-access']);
        $this->middleware("CheckIfUserIsEditer")->only([
            "DivisionCreate",
            "UpdateDivistion",
            "_DeleteDivision"
        ]);
    }

    #VERIFIONS SI LE USER EST AUTHENTIFIE
       // public function __construct()
        //{
            //$this->middleware(['auth:api', 'scope:api-access']);
        //}
        function DivisionCreate(Request $request)
    {
        #VERIFICATION DE LA METHOD
        if ($this->methodValidation($request->method(), "POST") == False) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
        };
       
        #VALIDATION DES DATAs DEPUIS LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
        $validator = $this->DivisionCreate_Validator($request->all());

        if ($validator->fails()) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError($validator->errors(), 404);
        }

        #ENREGISTREMENT DANS LA DB VIA **createProduct** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
        return $this->createDivision($request);
    }
      #GET ALL USERS
      function Division(Request $request)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "GET") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
  
          #RECUPERATION DE TOUT LES UTILISATEURS AVEC LEURS ROLES & TRANSPORTS
          return $this->getDivision();
      }
  
          function _DivisionRetrieve(Request $request, $id)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "GET") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
  
          #RECUPERATION D'UN PAYS VIA SON **id**
          return $this->divisionretrieve($id);
      }
  
      function UpdateDivistion(Request $request,$id)
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
          return $this->_updateDivision($request,$id);
      }
  
      #SUPPRIMER UN PRODUIT
      function _DeleteDivision(Request $request,$id)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "POST") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
   
          #RECUPERATION D'UN PRODUIT VIA SON **id**
          return $this->deleteDivision($request,$id);
      }
      function AffectToCategory(Request $request,$id)
      {
          #VERIFICATION DE LA METHOD
          if ($this->methodValidation($request->method(), "POST") == False) {
              #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
              return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
          };
   
          #RECUPERATION D'UN PRODUIT VIA SON **id**
          return $this->affectCategory($request,$id);
      }
}

