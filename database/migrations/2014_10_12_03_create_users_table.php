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

            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password')->unique();

            $table->string('enseigne')->nullable();
            $table->string('indication')->nullable();
            $table->string('phone')->unique();
            $table->string('sexe');
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
