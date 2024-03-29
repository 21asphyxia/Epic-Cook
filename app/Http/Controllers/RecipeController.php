<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use Intervention\Image\ImageManagerStatic as Image;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::with('ratings', 'comments', 'images', 'user')->orderBy('created_at', 'desc')->paginate(5);
        return view('pages.admin.recipes.index', ['recipes' => $recipes]);
    }

    public function recentlyPopular()
    {
        $recently = Recipe::with('ratings', 'comments', 'images', 'user')->orderBy('created_at', 'desc')->take(4)->get();
        $popular = Recipe::with('ratings', 'comments', 'images', 'user')->withCount('ratings')->orderBy('ratings_count', 'desc')->take(4)->get();
        return view('pages.home', ['recently' => $recently, 'popular' => $popular]);
    }

    public function allRecipes()
    {
        return view('pages.recipes.index');
    }

    public function showRecipe(Recipe $recipe)
    {
        $recipe = $recipe->load('ingredients', 'instructions', 'ratings', 'images', 'user');
        $comments = $recipe->comments()->orderBy('created_at', 'desc')->paginate(5);
        return view('pages.recipes.show', ['recipe' => $recipe, 'comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('pages.recipes.create', ['ingredients' => $ingredients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request)
    {
        $recipe = $request->user()->recipes()->create($request->validated());
        // dd($request->ingredients);
        foreach ($request->ingredients as $key => $ingredient) {
            if (Ingredient::find($ingredient)) {
                $recipe->ingredients()->attach($ingredient, ['amount' => $request->ingredients_amounts[$key], 'unit' => $request->ingredients_units[$key]]);
            } else {
                $ingredient = Ingredient::create(['name' => $ingredient]);
                $recipe->ingredients()->attach($ingredient, ['amount' => $request->ingredients_amounts[$key], 'unit' => $request->ingredients_units[$key]]);
            }
        }

        foreach ($request->instructions as $key => $instruction) {
            $recipe->instructions()->create(['step' => $key + 1, 'description' => $instruction]);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $image_resized = Image::make($image)->resize(800, 500)->encode('png', 100);

                Storage::disk('public')->put('upload/' . $image->hashName(), $image_resized);

                $name = 'upload/' . $image->hashName();

                $recipe->images()->create(['path' => $name]);
            }
        }
        return redirect()->route('app.recipes.show', $recipe);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return response()->json($recipe->load('ingredients', 'instructions', 'ratings', 'images', 'comments', 'user'));
    }

    public function getRecipesByDifficulty($difficulty)
    {
        $recipes = Recipe::where('difficulty', $difficulty)->get()->load('ingredients', 'instructions', 'ratings', 'images', 'comments', 'user');
        return response()->json($recipes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $allIngredients = Ingredient::all();
        $recipe = $recipe->load('ingredients', 'instructions', 'comments', 'images');
        return view('pages.recipes.edit', ['recipe' => $recipe, 'allIngredients' => $allIngredients]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecipeRequest  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $recipe->update($request->validated());
        $recipe->ingredients()->detach();
        foreach ($request->ingredients as $key => $ingredient) {
            if (Ingredient::find($ingredient)) {
                $recipe->ingredients()->attach($ingredient, ['amount' => $request->ingredients_amounts[$key], 'unit' => $request->ingredients_units[$key]]);
            } else {
                $ingredient = Ingredient::create(['name' => $ingredient]);
                $recipe->ingredients()->attach($ingredient, ['amount' => $request->ingredients_amounts[$key], 'unit' => $request->ingredients_units[$key]]);
            }
        }

        $recipe->instructions()->delete();
        foreach ($request->instructions as $key => $instruction) {
            $recipe->instructions()->create(['step' => $key + 1, 'description' => $instruction]);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $image_resized = Image::make($image)->resize(800, 500)->encode('png', 100);

                Storage::disk('public')->put('upload/' . $image->hashName(), $image_resized);

                $name = 'upload/' . $image->hashName();

                $recipe->images()->create(['path' => $name]);
            }
        }
        return redirect()->route('app.recipes.show', $recipe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $images = $recipe->images;

        foreach ($images as $image) {
            $imagePath = $image->path;
            unlink(storage_path('app/public/' . $imagePath));
        }

        $recipe->delete();

        return redirect()->route('app.recipes');
    }
}
