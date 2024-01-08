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
        Schema::create('quatiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("arrondissement_id")
                ->nullable()
                ->constrained("arrondissements", "id")
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quatiers');
    }
};
