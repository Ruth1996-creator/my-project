<?php
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

class LikeController extends LIKES_HELPER
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'scope:api-access']);
        $this->middleware("CheckIfUserIsVendor")->only([
            "AddLikes",
        ]);
        
    }
    function _AddLikes(Request $request)
    {
        #VERIFICATION DE LA METHOD
        if ($this->methodValidation($request->method(), "POST") == False) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
        };
       
        $validator = $this->Like_Validator($request->all());

       if ($validator->fails()) {
            #RENVOIE D'ERREURE VIA **sendError** 
            return $this->sendError($validator->errors(), 404);
        }

        #ENREGISTREMENT DANS LA DB VIA **Addlikes** DE LA CLASS    
        return $this->add_Likes($request);
    }

    function Fan(Request $request)
    {
        #VERIFICATION DE LA METHOD
        if ($this->methodValidation($request->method(), "GET") == False) {
            #RENVOIE D'ERREURE VIA **sendError** DE LA CLASS BASE_HELPER HERITEE PAR USER_HELPER
            return $this->sendError("La methode " . $request->method() . " n'est pas supportée pour cette requete!!", 404);
        };

        #RECUPERATION DE TOUT LES UTILISATEURS AVEC LEURS ROLES & TRANSPORTS
        return $this->getFan();
    }
}
