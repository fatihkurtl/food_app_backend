<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipes;
use App\Models\Categories;
use App\Models\PopularRecipes;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allRecipes(Request $request)
    {
        $recipes = Recipes::all();
        if (count($recipes) > 0) {
            return response()->json($recipes, 200);
        }
        return response()->json($recipes, 404);
    }
    /**
     * Display the specified resource.
     */
    public function recipeDetails(string $id)
    {
        $recipe = Recipes::findOrFail($id);
        return response()->json($recipe, 200);
    }

    public function allCategories()
    {
        $categories = Categories::all();
        if (count($categories) > 0) {
            return response()->json($categories, 200);
        }
        return response()->json($categories, 404);
    }

    public function categoryRecipes(string $id)
    {
        $recipes = Recipes::where('category_id', $id)->get();
        if (count($recipes) > 0) {
            return response()->json($recipes, 200);
        }
        return response()->json($recipes, 404);
    }

    public function popularRecipes()
    {
        $popular_recipes = PopularRecipes::pluck('recipe_id')->toArray();
        $recipes = Recipes::whereIn('id', $popular_recipes)->get();

        if (count($recipes) > 0) {
            return response()->json($recipes, 200);
        }
        return response()->json($recipes, 404);
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
