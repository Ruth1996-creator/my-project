<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("category")
                ->nullable()
                ->constrained("categories", "id")
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");

            $table->foreignId("type")
                ->nullable()
                ->constrained("typeusers", "id")
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");

                $table->foreignId("pays_id")
                ->nullable()
                ->constrained("pays", "id")
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");

                $table->foreignId("commune_id")
                ->nullable()
                ->constrained("communes", "id")
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");

                 $table->foreignId("arrondissement_id")
                ->nullable()
                ->constrained("arrondissements", "id")
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");


            $table->foreignId("quatier")
                ->nullable()
                ->constrained("quatiers", "id")
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");


            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password')->unique();

            $table->string('enseigne')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('sexe')->nullable();
            $table->string('photo')->nullable();
            $table->date('annee')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
