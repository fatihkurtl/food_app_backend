<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Recipes;
use App\Models\Tokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerAuthController extends Controller
{
    public function customerRegister(Request $request)
    {

        $customers = Customers::where('email', $request->email)->first();

        if ($customers) {
            return response()->json(['message' => 'Bu e-posta adresi zaten kayıtlı.', 'status' => 'error'], 404);
        }

        if (!$customers) {
            $customer = Customers::create([
                'full_name' => $request->fullName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $customer->save();

            return response()->json(['message' => 'Kayıt işlemi başarıyla tamamlandı.', 'status' => 'success'], 200);
        }
        return response()->json(['message' => 'Invalid data'], 404);
    }

    public function customerLogin(Request $request)
    {
        $customer = Customers::where('email', $request->email)->first();
        if ($customer && Hash::check($request->password, $customer->password)) {

            $token = Str::random(60);
            $expiresAt = now()->addMinutes(60);

            if (Tokens::where('customer_id', $customer->id)->exists()) {
                Tokens::where('customer_id', $customer->id)->update([
                    'token' => $token,
                    'expires_at' => $expiresAt,
                ]);
            } else {
                Tokens::create([
                    'customer_id' => $customer->id,
                    'token' => $token,
                    'expires_at' => $expiresAt,
                ]);
            }

            return response()->json(['access_token' => $token, 'token_type' => 'Bearer', 'customer' => $customer, 'message' => 'Başarıyla giriş yaptınız.', 'status' => 'success'], 200);
        } else {
            return response()->json(['message' => 'Kullanıcı adı ya da şifre hatalı!', 'status' => 'error'], 404);
        }
    }

    public function verifyToken(Request $request)
    {
        $token = Tokens::where('token', $request->header('Authorization'))->where('expires_at', '>', now())->first();

        if ($token) {
            return response()->json(['message' => 'Token geçerli.', 'status' => 'success'], 200);
        } else {
            return response()->json(['message' => 'Token geçersiz veya süresi dolmuş.', 'status' => 'error'], 401);
        }
    }

    public function customerLogout(Request $request)
    {
        Tokens::where('token', $request->header('Authorization'))->delete();
        return response()->json(['message' => 'Çıkış işleminiz tamamlanmıştır.'], 200);
    }

    public function customerProfile(Request $request, $id)
    {
        $customer = Customers::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Kullanıcı bulunamadı.'], 404);
        }
        $token = $request->header('Authorization');
        $storedToken = Tokens::where('customer_id', $customer->id)->first();
        if ($storedToken && $storedToken->token === $token) {
            $favoriteRecipes = $customer->favoriteRecipes;
            $recipes = [];
            foreach ($favoriteRecipes as $recipe) {
                $recipes[] = Recipes::where('id', $recipe->recipe_id)->first();
            }
            return response()->json(['customer' => $customer, 'favoriteRecipes' => $recipes], 200);
        } else {
            return response()->json(['message' => 'Kullanıcı bulunamadı.'], 404);
        }
    }

    public function removeFavoriteRecipe(Request $request, $id)
    {
        // dd($request->all(), $id);
        if (is_null($id)) {
            return response()->json(['error' => 'ID is required'], 400);
        }
        $token = $request->header('Authorization');
        $storedToken = Tokens::where('token', $token)->first();
        if ($storedToken) {
            $customer = $storedToken->customer;
            $favoriteRecipe = $customer->favoriteRecipes()->where('recipe_id', $id)->first();
            if ($favoriteRecipe) {
                $favoriteRecipe->delete();
                return response()->json(['message' => 'Tarif favorilerinizden kaldırıldı.'], 200);
            } else {
                return response()->json(['message' => 'Tarif favorilerinizde bulunmuyor.'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid token'], 401);
        }
    }
}
