<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use App\Models\Role;
use App\Models\Typeuser;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class USER_HELPER extends BASE_HELPER
{
    ##======== REGISTER VALIDATION =======##
    static function register_rules(): array
    {
        return [
            "username" => ["required", Rule::unique('users')],
            'phone' => ['required', "numeric", Rule::unique("users")],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', Rule::unique('users')],
            "category" => ["required", "integer"],
            "type" => ["required", "integer"],
            "pays_id" => ["required", "integer"],
            "arrondissement_id" => ["required", "integer"],
            "commune_id" => ["required", "integer"],
            "quatier" => ["required", "integer"],
            "enseigne" => ["required"],
            "sexe" => ["required"],
            "photo" => ["required"],
            "annee" => ["required"]
            

        ];
    }

    static function register_messages(): array
    {
        return [
            "username.required" => "Veuillez préciser votre nom d'utilisateur",
            "username.unique" => "Veuillez choisir un autre nom d'utilisateur",

            "phone.required" => "Le numero whatsapp  est réquis!",
            "phone.numeric" => "Le phone doit être de format numéric!",
            "phone.unique" => "Veuillez choisir un autre numéro de téléphone!",

            "email.required" => "Le mail  est réquis!",
            "email.email" => "Le champ mail doit être de format mail!",
            "email.unique" => "Veuillez choisir un autre mail!",

            "password.required" => "Le password  est réquis!",
            "password.unique" => "Veuillez choisir un autre password!",

            "category.required" => "La categorie  est réquise!",
            "category.integer" => "Ce champ doit être un entier!",

            "type.required" => "Le type d'utilisateur est réquis!",
            "type.integer" => "Ce champ doit être un entier!",

            "pays_id.required" => "Le pays d'utilisateur est réquis!",
            "pays_id.integer" => "Ce champ doit être un entier!",

               
            "arrondissement_id.required" => "L'arrondissement d'utilisateur est réquis!",
            "arrondissement_id.integer" => "Ce champ doit être un entier!",
           
            "commune_id.required" => "La commune d'utilisateur est réquis!",
            "commune_id.integer" => "Ce champ doit être un entier!",
          
            "quatier.required" => "La commune d'utilisateur est réquis!",
            "quatier.integer" => "Ce champ doit être un entier!",


            "enseigne.required" => "Le nom de l'enseigne  est réquis!",
            "indication.required" => "L'indication géographique  est réquis!",
            "photo.required" => "La photo de l'enseigne  est réquise!",
            "annee.required" => "La date de naissance est réquise!",
            "sexe.required" => "Le sexe  est réquis!"


        ];
    }

    static function Register_Validator($formDatas)
    {
        #
        $rules = self::register_rules();
        $messages = self::register_messages();
       
        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }

    ##======== LOGIN VALIDATION =======##
    static function login_rules(): array
    {
        return [
            'account' => 'required',
            'password' => 'required',
        ];
    }

    static function login_messages(): array
    {
        return [
            'account.required' => 'Le champ account est réquis!',
            'password.required' => 'Le champ Password est réquis!',
        ];
    }

    static function Login_Validator($formDatas)
    {
        #
        $rules = self::login_rules();
        $messages = self::login_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }

    ##======== NEW PASSWORD VALIDATION =======##
    static function NEW_PASSWORD_rules(): array
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required',
        ];
    }

    static function NEW_PASSWORD_messages(): array
    {
        return [
            // 'new_password.required' => 'Veuillez renseigner soit votre username,votre phone ou soit votre email',
            // 'password.required' => 'Le champ Password est réquis!',
        ];
    }

    static function NEW_PASSWORD_Validator($formDatas)
    {
        #
        $rules = self::NEW_PASSWORD_rules();
        $messages = self::NEW_PASSWORD_messages();

        $validator = Validator::make($formDatas, $rules, $messages);
        return $validator;
    }

    static function createUser($request)
    {
        $formData = $request->all();
        $category = Category::find($formData["category"]);
        $type = Typeuser::find($formData["type"]);

        if (!$category) {
            return self::sendError("Cette categorie n'existe pas!", 404);
        }

        if (!$type) {
            return self::sendError("Ce type d'utilisateur n'existe pas!", 404);
        }

        ####___TRAITEMENT DE L'IMAGE
        $image = $request->file('photo');
        $image_name = $image->getClientOriginalName();
        $image->move("profils", $image_name);
        $formData["photo"] = asset("profils/" . $image_name);
        $user = User::create($formData); #ENREGISTREMENT DU USER DANS LA DB

        #=====ENVOIE DE NOTIFICATION =======~####
        $message = "Votre Compte a été crée avec succès sur FOCUS 54";

        try {
            Send_Notification(
                $user,
                "CREATION DE COMPTE SUR FOCUS 54",
                $message
            );
        } catch (\Throwable $th) {
            //throw $th;
        }

        return self::sendResponse($user, 'Compte crée avec succès!!');
    }

    static function userAuthentification($request)
    {
        if (is_numeric($request->get('account'))) {
            $credentials  =  ['phone' => $request->get('account'), 'password' => $request->get('password')];
        } elseif (filter_var($request->get('account'), FILTER_VALIDATE_EMAIL)) {
            $credentials  =  ['email' => $request->get('account'), 'password' => $request->get('password')];
        } else {
            $credentials  =  ['username' => $request->get('account'), 'password' => $request->get('password')];
        }

        if (Auth::attempt($credentials)) { #SI LE USER EST AUTHENTIFIE
            $user = Auth::user();

            $token = $user->createToken('MyToken', ['api-access'])->accessToken;
            // $cookie = Cookie("jwt", $token, 60 * 24);
            $user["token"] = $token;
            $user["pays"] = $user->pays;
            $user["ville"] = $user->Ville;

            #RENVOIE D'ERREURE VIA **sendResponse** DE LA CLASS BASE_HELPER
            return self::sendResponse($user, 'Vous etes connecté(e) avec succès!!');
        }

        #RENVOIE D'ERREURE VIA **sendResponse** DE LA CLASS BASE_HELPER
        return self::sendError('Connexion échouée! Vérifiez vos données puis réessayez à nouveau!', 500);
    }

    static function getUsers()
    {
        $users =  User::with("Villes")->orderByorderBy("id", "desc")->get();
        return self::sendResponse($users, 'Tout les utilisatreurs récupérés avec succès!!');
    }

    static function _updatePassword($formData)
    {
        $user = request()->user();
        if (!$user) {
            return self::sendError("Ce compte ne vous appartient pas!", 404);
        };

        #### VERIFIONS SI LE NOUVEAU PASSWORD CORRESPONDS ENCORE AU ANCIEN PASSWORD
        if ($formData["old_password"] == $formData["new_password"]) {
            return self::sendError('Le nouveau mot de passe ne doit pas etre identique à votre ancien mot de passe', 404);
        }

        if (Hash::check($formData["old_password"], $user->password)) { #SI LE old_password correspond au password du user dans la DB
            $user->update(["password" => $formData["new_password"]]);
            return self::sendResponse($user, 'Mot de passe modifié avec succès!');
        }
        return self::sendError("Votre mot de passe est incorrect", 505);
    }

    static function retrieveUsers($id)
    {
        $user = User::with("pays","Ville")->find($id);
        if (!$user) {
            return self::sendError("Ce utilisateur n'existe pas!", 404);
        }

        return self::sendResponse($user, "Utilisateur récupé avec succès:!!");
    }

    static function userLogout($request)
    {
    
        $request->user()->token()->revoke();

        // <!-- $cookie = Cookie::forget("jwt"); -->
        return self::sendResponse([], 'Vous etes déconnecté(e) avec succès!');
    }
}
