<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReference;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class REFERENCE_HELPER extends BASE_HELPER
{
    ##======== ADD VALIDATION =======##
    static function add_rules(): array
    {
        return [
            'product' => ['required', 'integer'],
            'image' => ['required'],
            'reference' => ['required'],
            "legende" => ["required"],
        ];
    }

    static function add_messages(): array
    {
        return [
            "image.required" => "Veuillez choisir une image ",
            "product.required" => "Le produit est réquis!",
            "product.integer" => "Ce champ doit etre un entier!",

            "reference.reauired" => "La reference du produit doit est requise!",
            "legende.required" => "Une legende  est requise!",


        ];
    }

    static function ReferenceCreate_Validator($formDatas)
    {

        $rules = self::add_rules();
        $messages = self::add_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }


    static function createProductReference($request)
    {
        $formData = $request->all();
        $product = Product::find($formData["product"]);
        $user = request()->user();
        $formData["user"] = $user->id;

        $is_this_product_occuped_by_this_uer = ProductReference::where(["user" => $user->id, "product" => $formData["product"]])->first();
        if ($is_this_product_occuped_by_this_uer) {
            return self::sendError("Vous avez déjà occupé ce produit!", 404);
        }
        if (!$product) {
        return self::sendError("Ce produit n'existe pas!", 404);
         };

        // if ($product->user) {
        // return self::sendError("Ce produit n'est pas disponible", 404);
        // }

        ##TRAITEMENT DE L'IMAGEn
        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $image->move("products", $image_name);
            $formData["image"] = asset("products/" . $image_name);
        }
        $formData["user"] = $user->id;

        $refe = ProductReference::create($formData); #ENREGISTREMENT DU PRODUIT DANS LA DB
        return self::sendResponse($refe, "Votre reference a été ajouté avec succès!!");
    }
    static function removeReference($request, $id)
    {
        $formData = $request->all();

    $product = Product::find($id);
    $user = request()->user();
    $ref = ProductReference::where(["reference" => $formData["reference"], "product" => $id])->first();

    if (!$ref) {
        return self::sendError("Cette référence n'existe pas!", 404);
    }

    // Supprimer la référence
    $ref->delete();
    return self::sendResponse($ref, "Votre référence a été retirée avec succès");
}
    }
    ##___FIN SUPPRESSION  D'UN PRODUIT____~###



