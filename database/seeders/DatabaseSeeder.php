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
        $villes = [
            [
                "name" => " Tembisa",
                "pays_id" =>  1

            ],
            [
                "name" => "Benoni",
                "pays_id" =>  1
            ],
            [
                "name" => "Port Elizabeth",
                "pays_id" =>  1
            ],
            [
                "name" => "Pretoria",
                "pays_id" =>  1
            ],
            [
                "name" => "Soweto",
                "pays_id" =>  1
            ],
            [
                "name" => "Johannesburg",
                "pays_id" =>  1
            ],

            [
                "name" => "Durban",
                "pays_id" =>  1
            ],
            [
                "name" => "Capte Town",
                "pays_id" =>  1
            ],
            [
                "name" => "Alger ",
                "pays_id" =>  2
            ],
            [
                "name" => " Oran",
                "pays_id" =>  2
            ],
            [
                "name" => " Luanda",
                "pays_id" =>  3
            ],
            [
                "name" => " Lubango",
                "pays_id" =>  3
            ]
        ];

        foreach ($villes as $ville) {
            \App\Models\Villes::factory()->create($ville);
        }
        $products = [
            [
                "user" => User::find(2),
                "image" => "Durban",
                "productname" => " Post-télévision",
                "description" => "télévision",
                "price" => "Port 2500",
                "product_category" => 2,
                "reference" => "12ert"
            ],
            [
                "user" => User::find(2),
                "image" => "Durban",
                "productname" => " Post-radio",
                "description" => "radio",
                "price" => "Port 2500",
                "product_category" => 2,
                "reference" => "12ert"
            ],
            [
                "user" => User::find(2),
                "image" => "Durban",
                "productname" => " Lait",
                "description" => "lait",
                "price" => "Port 2500",
                "product_category" => 2,
                "reference" => "12ert"
            ],
            [
                "user" => User::find(2),
                "image" => "Durban",
                "productname" => " doko-",
                "description" => "doko",
                "price" => "Port 2500",
                "product_category" => 2,
                "reference" => "12ert"
            ],
            [
                "user" => User::find(4),
                "image" => "Durban",
                "productname" => " pagne",
                "description" => "pagne",
                "price" => "Port 12500",
                "product_category" => 2,
                "reference" => "15ert"
            ],
            [
                "user" => User::find(1),
                "image" => "Durban",
                "productname" => " yaout",
                "description" => "yaout",
                "price" => "Port 2500",
                "product_category" => 2,
                "reference" => "ert"
            ],


        ];

        foreach ($products as $product) {
            \App\Models\Product::factory()->create($product);
        }
        $arrondissement = [
            [
                "name" => "12é"
            ],
            [
                "name" => "13é"
            ],
            [
                "name" => "14é"
            ], [
                "name" => "15é"
            ]
        ];

        foreach ($arrondissement as $arrondissements) {
            \App\Models\Arrondissement::factory()->create($arrondissements);
        }
        $commune = [
            [
                "name" => "cotonou"
            ],
            [
                "name" => "ouemé"
            ],
            [
                "name" => "parakou"
            ], [
                "name" => "calavi"
            ]
        ];

        foreach ($commune as $communes) {
            \App\Models\Commune::factory()->create($communes);
        }

       
    }
}
