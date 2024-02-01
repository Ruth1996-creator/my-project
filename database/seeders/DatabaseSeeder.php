<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Divison;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ##======== CREATION DES CATEGORIES PAR DEFAUT ============####
        $categories = [
            [
                "name" => "Agriculteurs exploitants (agriculture, élevage, pêche, etc.)"
            ],
            [
                "name" => "Artisans, commerçants, chefs d’entreprise.)"
            ],
            [
                "name" => "Cadres et professions intellectuelles supérieures)"
            ],
            [
                "name" => "Professions intermédiaires"
            ],
            [
                "name" => "Employés"
            ],
            [
                "name" => "Ouvriers."
            ],
            [
                "name" => "Retraités"
            ],
            [
                "name" => "Autres personnes sans activité professionnelle."
            ]
        ];

        foreach ($categories as $categorie) {
            \App\Models\Category::factory()->create($categorie);
        }

        ##======== CREATION DES TYPEUSER PAR DEFAUT ============####
        $typeusers = [
            [
                "name" => "Vendeur"
            ],
            [
                "name" => "Acheteur"
            ],
            [
                "name" => "Editeur"
            ]
        ];

        foreach ($typeusers as $typesuser) {
            \App\Models\Typeuser::factory()->create($typesuser);
        }

        ##======== CREATION DES CATEGORIES DE PRODUIT PAR DEFAUT ============####
        $productcategorys = [
            [
                "name" => "categorie1"
            ],
            [
                "name" => "categorie2"
            ],
            [
                "name" => "categorie3"
            ], [
                "name" => "categorie4"
            ]
        ];

        foreach ($productcategorys as $productcategory) {
            \App\Models\ProductCategory::factory()->create($productcategory);
        }
        ##======== CREATION DES PAYS  PAR DEFAUT ============####
        $pays = [
            [
                "name" => "Afrique du sud"
            ],
            [
                "name" => "Algerie"
            ],
            [
                "name" => "Angola"
            ],
            [
                "name" => "Bénin"
            ],
            [
                "name" => "Bostwana"
            ],
            [
                "name" => "Burkina Fasso"
            ],
            [
                "name" => "Burundi"
            ],
            [
                "name" => "Cameroun"
            ],
            [
                "name" => "Cap-Vert"
            ],
            [
                "name" => "Centreafrique"
            ],
            [
                "name" => "Comores"
            ],
            [
                "name" => "Congo"
            ],
            [
                "name" => "Côte d'Ivoire"
            ],
            [
                "name" => "Djibouti"
            ],
            [
                "name" => "Egytpte"
            ],
            [
                "name" => "Erythrée"
            ],
            [
                "name" => "Eswatini"
            ],
            [
                "name" => "Ethipie"
            ],
            [
                "name" => "Gabon"
            ],
            [
                "name" => "Gambie"
            ],
            [
                "name" => "Ghana"
            ],
            [
                "name" => "Guinée équatoriale"
            ],
            [
                "name" => "Guinée"
            ],
            [
                "name" => "Guinée Bissau"
            ],
            [
                "name" => "kenya"
            ],
            [
                "name" => "Lesotho"
            ],
            [
                "name" => "Libéria"
            ],
            [
                "name" => "Libye"
            ],
            [
                "name" => "Madagascar"
            ],
            [
                "name" => "Malawi"
            ],
            [
                "name" => "Mali"
            ],
            [
                "name" => "Maroc"
            ],
            [
                "name" => "Maurice"
            ],
            [
                "name" => "Mauritanie"
            ],
            [
                "name" => "Mozambique"
            ],
            [
                "name" => "Namibie"
            ],
            [
                "name" => "Niger"
            ],
            [
                "name" => "Nigeria"
            ],
            [
                "name" => "Ouganda"
            ],
            [
                "name" => "RD Congo"
            ],
            [
                "name" => "Rwanda"
            ],
            [
                "name" => "Sao Tomé-et-Principe"
            ],
            [
                "name" => "Sénégal"
            ],
            [
                "name" => "Seychelles"
            ],
            [
                "name" => "Sera Leone"
            ],
            [
                "name" => "Somalie"
            ],
            [
                "name" => "Soudan"
            ],
            [
                "name" => "Soudan du Sud"
            ],
            [
                "name" => "Tanzanie"
            ],
            [
                "name" => "Tchad"
            ],
            [
                "name" => "Togo"
            ],
            [
                "name" => "Tunisie"
            ],
            [
                "name" => "Zambie"
            ],
            [
                "name" => "Zimbabwe"
            ]
            




            
        ];

        foreach ($pays as $pay) {
            \App\Models\Pays::factory()->create($pay);
        };
        ##======== CREATION DES CATEGORIES PAR DEFAUT ============####
        
        $products = [
            [
                "user" => User::find(2),
                "image" => "Durban",
                "productname" => " Post-télévision",
                "description" => "télévision",
                "product_category" => 2,
                "reference" => "12ert"
            ],
            [
                "user" => User::find(2),
                "image" => "Durban",
                "productname" => " Post-radio",
                "description" => "radio",
                "product_category" => 2,
                "reference" => "12ert"
            ],
            [
                "user" => User::find(2),
                "image" => "Durban",
                "productname" => " Lait",
                "description" => "lait",
                "product_category" => 2,
                "reference" => "12ert"
            ],
            [
                "user" => User::find(2),
                "image" => "Durban",
                "productname" => " doko-",
                "description" => "doko",
                "product_category" => 2,
                "reference" => "12ert"
            ],
            [
                "user" => User::find(4),
                "image" => "Durban",
                "productname" => " pagne",
                "description" => "pagne",
                "product_category" => 2,
                "reference" => "15ert"
            ],
            [
                "user" => User::find(1),
                "image" => "Durban",
                "productname" => " yaout",
                "description" => "yaout",
                "product_category" => 2,
                "reference" => "ert"
            ],


        ];

        foreach ($products as $product) {
            \App\Models\Product::factory()->create($product);
        }

        $commune = [
            [
                "pays_id"=>2,
                "name" => "cotonou"
            ],
            [
                "pays_id"=>5,

                "name" => "ouemé"
            ],
            [
                "pays_id"=>12,

                "name" => "parakou"
            ], 
            [
                "pays_id"=>22,

                "name" => "calavi"
            ]
        ];

        foreach ($commune as $communes) {
            \App\Models\Commune::factory()->create($communes);
        }

        $arrondissement = [
            [
                "commune_id"=>2,

                "name" => "12é"
            ],
            [
                "commune_id"=>1,

                "name" => "13é"
            ],
            [
                "commune_id"=>3,

                "name" => "14é"
            ],
                
             [
                "commune_id"=>2,
                "name" => "15é"
            ]
        ];

        foreach ($arrondissement as $arrondissements) {
            \App\Models\Arrondissement::factory()->create($arrondissements);
        }

        $quatier = [
            [
                "arrondissement_id" => 1,

                "name" => "akpakpa"

            ],

            [
                "arrondissement_id" => 3,

                "name" => "godomey"
            ],

            [
                "arrondissement_id" => 2,

                "name" => "cadjehoun"
            ], 

            [
                "arrondissement_id" => 3,

                "name" => "vodjè"
            ]
        ];

        foreach ($quatier as $quatiers) {
            \App\Models\Quatier::factory()->create($quatiers);
        }

       
    }
}
