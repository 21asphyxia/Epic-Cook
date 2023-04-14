<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Recipe::factory(10)->create();
        $ingredients = \App\Models\Ingredient::factory(10)->make();
        

        foreach (\App\Models\Recipe::all() as $recipe) {
            $recipe->comments()->saveMany(\App\Models\Comment::factory(10)->make());
            $recipe->ratings()->saveMany(\App\Models\Rating::factory(10)->make());
            $recipe->images()->saveMany(\App\Models\Image::factory(10)->make());
            $recipe->instructions()->saveMany(\App\Models\Instruction::factory(10)->make());
            

            $ingredientsPool = $ingredients->random(4);
            $ingredientsPool->each(function ($ingredient) use ($recipe) {
                $recipe->ingredients()->save($ingredient, [
                    'amount' => rand(1, 50),
                    'unit' => ['mg', 'g', 'kg', 'ml', 'l', 'tsp', 'p'][rand(0, 6)],
                ]);
            });

            $step = 1;
            foreach ($recipe->instructions as $instruction) {
                $instruction->step = $step;
                $instruction->save();
                $step++;
            }
        }
    }
}