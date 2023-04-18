<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::with('ratings', 'comments', 'user')->paginate(5);
        return view('pages.admin.recipes.index', ['recipes' => $recipes]);
    }

    public function recentlyPopular()
    {
        $recently = Recipe::with('ratings', 'comments', 'user')->orderBy('created_at', 'desc')->take(4)->get();
        $popular = Recipe::with('ratings', 'comments', 'user')->withCount('ratings')->orderBy('ratings_count', 'desc')->take(4)->get();
        return view('pages.home', ['recently' => $recently, 'popular' => $popular]);
    }

    public function allRecipes(Request $request){
        $recipes = Recipe::with('ratings', 'comments', 'user');
        if($request->has('difficulty')){
            $recipes = $recipes->where('difficulty', '<=', $request->difficulty);
        }

        if($request->has('min_rating')){
            $recipes = $recipes->withAvg('ratings', 'rating_number')
                ->having('ratings_avg_rating_number', '>=', $request->min_rating);
        }

        if($request->has('max_rating')){
            $recipes = $recipes->withAvg('ratings', 'rating_number')
                ->having('ratings_avg_rating_number', '<=', $request->min_rating);
        }
        
        $recipes = $recipes->paginate(12);
        return view('pages.recipes.index', ['recipes' => $recipes]);
    }

    public function showRecipe(Recipe $recipe)
    {
        $recipe = $recipe->load('ingredients', 'instructions','ratings', 'images', 'user');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return response()->json($recipe->load('ingredients', 'instructions','ratings', 'images', 'comments', 'user'));
    }

    public function getRecipesByDifficulty($difficulty)
    {
        $recipes = Recipe::where('difficulty', $difficulty)->get()->load('ingredients', 'instructions','ratings', 'images', 'comments', 'user');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->back()->with('success', 'Recipe deleted successfully');
    }
}
