<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->id();
            $table->integer('amount')->nullable(false);
            $table->enum('unit', ['mg', 'g', 'kg', 'ml', 'l', 'tsp', 'piece', 'other'])->nullable(false);
            $table->integer('recipe_id')->constrained('recipes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ingredient_id')->constrained('ingredients')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_ingredients');
    }
};
