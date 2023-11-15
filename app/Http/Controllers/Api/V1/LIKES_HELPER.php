<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Like;
use Illuminate\Support\Facades\Validator;

class LIKES_HELPER extends BASE_HELPER
{
    static function like_rules(): array
    {
        return [
            "vendor" => ["required", "integer"],
        ];
    }

    static function like_messages(): array
    {
        return [
            "vendor.required" => "Veuillez préciser le vendeur",
            "vendor.integer" => "Veuillez préciser le liker",
        ];
    }

    static function Like_Validator($formDatas)
    {
        #
        $rules = self::like_rules();
        $messages = self::like_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }
    static function add_Likes($request)
    {
        $formData = $request->all();
        $user = request()->user();

        if (!Is_User_A_Vendor($formData["vendor"])) {
            return self::sendError("Ce vendeur n'existe pas!", 404);
        }
        if (!Is_User_A_Buyer($user->id)) {
            return self::sendError("Vous n'êtes pas acheteur!", 505);
        }
        $formData["fan"] = $user->id;
        ###___
        $like = Like::create($formData);

        return self::sendResponse($like, 'Like ajouté avec succès!!');
    }
    static function getFan()
    {
        $likes =  Like::orderBy("id", "desc")->get();
        return self::sendResponse($likes, 'Tout les likes récupérés avec succès!!');
    }
}
