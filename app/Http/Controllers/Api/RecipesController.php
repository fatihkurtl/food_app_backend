<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipes;
use App\Models\Categories;
use App\Models\PopularRecipes;
use App\Models\Customers;
use App\Models\Tokens;
use App\Models\CustomerFavoriteRecipes;

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

    public function saveCustomerRecipe(Request $request)
    {

        $customer_token = Tokens::where('token', $request->header('Authorization'))->first();
        if (!$customer_token) {
            return response()->json(['message' => 'Token geçersiz veya süresi dolmuş.'], 401);
        } else {
             $customer = Customers::where('id', $customer_token->customer_id)->first();
             $recipe = Recipes::where('id', $request->recipeId)->first();

             if (!$customer && $request->customerId != $customer_token->customer_id) {
                return response()->json(['message' => 'Kullanıcı bulunamadı.'], 404);
            }
        
            if (!$recipe) {
                return response()->json(['message' => 'Tarif bulunamadı.'], 404);
            }

             $customer_favorite_recipe = CustomerFavoriteRecipes::where('customer_id', $customer->id)->where('recipe_id', $recipe->id)->first();

             if (!$customer_favorite_recipe) {
                 $customer_favorite_recipe = new CustomerFavoriteRecipes();
                 $customer_favorite_recipe->customer_id = $customer->id;
                 $customer_favorite_recipe->recipe_id = $recipe->id;
                 $customer_favorite_recipe->save();
                 return response()->json(['message' => 'Tarif favorilere eklendi.'], 200);
             } else {
                 $customer_favorite_recipe->delete();
                 return response()->json(['message' => 'Tarif favorilerden kaldırıldı.'], 200);
             }
        }
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
