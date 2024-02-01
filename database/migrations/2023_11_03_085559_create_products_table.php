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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user")
            ->nullable()
            ->constrained("users", "id")
            ->onUpdate("CASCADE")
            ->onDelete("CASCADE");

             $table->foreignId("product_category")
            ->nullable()
            ->constrained("product_categories", "id")
            ->onUpdate("CASCADE")
            ->onDelete("CASCADE"); 

            $table->string('image')->nullable();
            $table->string('productname');
            $table->string('description');
            $table->string('reference')->nullable();

             $table->foreignId("classe")
            ->nullable()
            ->constrained("classes", "id")
            ->onUpdate("CASCADE")
            ->onDelete("CASCADE"); 

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
