<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

class ProductReferenceController extends REFERENCE_HELPER
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'scope:api-access']);
        
        $this->middleware("CheckIfUserIsVendor")->only([
            "ProductReference",
            
        ]);
        $this->middleware("CheckIfUserIsEditer")->only([
            "_RemoveReference",
        ]);
    }

   
   function ProductReference(Request $request)
    {
        #VERIFICATION DE LA METHOD
        if ($this->methodValidation($request->method(), "POST") == False) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            
            return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
        };
    
         $validator = $this->ReferenceCreate_Validator($request->all());

        if ($validator->fails()) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError($validator->errors(), 404);
        }

        return $this->createProductReference($request);

    }
    function _RemoveReference(Request $request,$id)
    {
        #VERIFICATION DE LA METHOD
        if ($this->methodValidation($request->method(), "POST") == False) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
        };
       return $this->removeReference($request,$id);

 
}

}
