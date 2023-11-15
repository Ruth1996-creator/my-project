<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PRODUCT_HELPER extends BASE_HELPER
{
    ##======== ADD VALIDATION =======##
    static function add_rules(): array
    {
        return [
            "image" => ["required"],
            'productname' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'product_category' => ['required', 'integer'],
            'reference' => ['required']

        ];
    }

    static function add_messages(): array
    {
        return [
            "image.required" => "Veuillez choisir une image ",
            "productname.required" => "Le nom du produit est réquis!",
            "description.required" => "La  description du produit  est réquise!",
            "price.required" => "Le prix du produit  est réquis!",

            "product_category.required" => "Veuillez préciser la catégorie du produit!",
            "product_category.integer" => "La catégorie du produit doit être un entier!",
            "reference.required" => "La reference du produit est requise!",

        ];
    }

    static function ProductCreate_Validator($formDatas)
    {
        #
        $rules = self::add_rules();
        $messages = self::add_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }


    static function createProduct($request)
    {
        $formData = $request->all();
        $user = request()->user();
        $product_category = ProductCategory::find($formData["product_category"]);
        if (!$product_category) {
            return self::sendError("Cette categorie n'existe pas!", 404);
        }
        // return $user->id; 
        ####___TRAITEMENT DE L'IMAGE
        $image = $request->file('image');
        $image_name = $image->getClientOriginalName();
        $image->move("profils", $image_name);
        $formData["image"] = asset("products/" . $image_name);
        $formData["user"] = $user->id;
        // $formData["product_category"]=$product_category->id;

        $user = Product::create($formData); #ENREGISTREMENT DU PRODUIT DANS LA DB

        #=====ENVOIE DE NOTIFICATION =======~####
        $message = "Votre Produit a été ajouter avec succès sur FOCUS 54";

        try {
            Send_Notification(
                $user,
                "CREATION DE PRODUIT SUR FOCUS 54",
                $message
            );
        } catch (\Throwable $th) {
            //throw $th;
        }

        return self::sendResponse($user, 'produit crée avec succès!!');
    }
    ##_____RETRIEVE PRODUCT______##
    static function ProductRetrieve($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return self::sendError("Ce produit n'existe pas!", 404);
        }

        return self::sendResponse($product, "Produit récupé avec succès:!!");
    }
    ##_____RETRIEVE PRODUCT______##

    static function getProducts()
    {
        $products =  Product::with(["user", "category"])->orderBy("id", "desc")->get();
        return self::sendResponse($products, 'Tout les produits récupérés avec succès!!');
    }
    ##======== NEW PASSWORD VALIDATION =======##
    static function NEW_PRODUCT_rules(): array
    {
        return [
            "image" => ["file"],
            "productname" => ["string"],
            "description" => ["string"],
            "product_category" => ["integer"],
            "price" => ["string"],
            "reference" => ["string"]
        ];
    }

    static function NEW_PRODUCT_messages(): array
    {
        return [
            // 'new_password.required' => 'Veuillez renseigner soit votre username,votre phone ou soit votre email',
            // 'password.required' => 'Le champ Password est réquis!',
        ];
    }

    static function NEW_PRODUCT_Validator($formDatas)
    {
        $rules = self::NEW_PRODUCT_rules();
        $messages = self::NEW_PRODUCT_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }

    ##___MODIFICATION D'UN PRODUIT____~###
    static function _updateProduct($request, $id)
    {
        $formData = $request->all();

        $product = Product::find($id);
        $user = request()->user();

        // return $user;
        if (!$product) {
            return self::sendError("Ce produit n'existe pas!", 404);
        };

        // return $product->user;
        if ($product->user != $user->id) {
            return self::sendError("Ce produit ne vous appartient!", 505);
        };

        if ($request->get("image")) {
            ####___TRAITEMENT DE L'IMAGE
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $image->move("products", $image_name);
            $formData["image"] = asset("products/" . $image_name);
        }

        $product->update($formData);
        return self::sendResponse($product, "Votre produit a été modifié avec succès ");
    }
    ##___ FIN MODIFICATION D'UN PRODUIT____~###

    ##SUPPRIMER UN PRODUIT____~###
    static function deleteproduct($request, $id)
    {
        $formData = $request->all();

        $product = Product::find($id);
        $user = request()->user();

        // return $user;
        if (!$product) {
            return self::sendError("Ce produit n'existe pas!", 404);
        };

        // return $product->user;
        if ($product->user != $user->id) {
            return self::sendError("Ce produit ne vous appartient!", 505);
        };
        $product->delete($formData);
        return self::sendResponse($product, "Votre produit a été supprimer avec succès ");
    }
    ##___FIN SUPPRESSION  D'UN PRODUIT____~###


    static function createProductReference($request, $id)
    {
        $formData = $request->all();
        $product = Product::find($id);
        $user = request()->user();

        if (!$product) {
            return self::sendError("Ce produit n'existe pas!", 404);
        };

        if ($product->user) {
            return self::sendError("Ce produit n'est pas disponible", 404);
        }

        $product->reference = $formData["reference"];
        $product->user = request()->user()->id;
        $product->save();
        return self::sendResponse($product, "Votre reference a été ajouté avec succès ");
        #=====ENVOIE DE NOTIFICATION =======~####
        //$message = "Votre Reference a été ajouter avec succès sur FOCUS 54";


        // return self::sendResponse($product, 'reference crée avec succès!!');
    }
    static function removeReference($request, $id)
    {
        $formData = $request->all();

        $product = Product::find($id);
        $user = request()->user();

        // return $user;
        if (!$product) {
            return self::sendError("Ce produit n'existe pas!", 404);
        };

        // return $product->user;
        //if ($product->user != $user->reference) {
        // return self::sendError("Ce produit ne vous appartient!", 505);
        //};
        $product->reference = null;
        $product->user = null;
        $product->save();
        return self::sendResponse($product, "Votre reference a été retirer avec succès ");
    }
    ##___FIN SUPPRESSION  D'UN PRODUIT____~###

    static function _searchProduct($search)
    {
        $result = collect(Product::all())->filter(
            function ($product) use ($search) {
                $rep = str::contains(strtolower($product['productname']), strtolower($search));
                if (!$rep) {
                    $resp = str::contains(strtolower($product['description']), strtolower($search));
                }
                return $resp;
            }
        )->all();

        return self::sendResponse($result, 'Résultat de la recherche!');
    }
}
