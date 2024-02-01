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
        Schema::create('product_references', function (Blueprint $table) {
            $table->id();

           $table->foreignId("user")
                ->nullable()
                ->constrained("users", "id")
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");

                $table->foreignId("product")
                ->nullable()
                ->constrained("products", "id")
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");

            $table->string('image');
            $table->string('reference');
            $table->string('legende');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_references');
    }
};
