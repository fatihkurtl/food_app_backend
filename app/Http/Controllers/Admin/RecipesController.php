<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = [
            [
                'id' => 1,
                'title' => 'Spaghetti Carbonara',
                'photo_url' => 'https://cdn.yemek.com/mncrop/620/388/uploads/2021/04/patlicanli-pilav-yemekcom.jpg',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Ana Yemek',
            ],
            [
                'id' => 2,
                'title' => 'Chicken Alfredo',
                'photo_url' => 'https://i.ytimg.com/vi/DqyI_P3uJaU/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLBrw-VnRpC8M2Roa5_C_J-u5T-Qrg',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Ana Yemek',
            ],
            [
                'id' => 3,
                'title' => 'Beef Stroganoff',
                'photo_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWzmrk1WPjf8-biydMbnfXK0IP1SzEyCYnVg&s',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Ana Yemek',
            ],
            [
                'id' => 4,
                'title' => 'Vegetarian Lasagna',
                'photo_url' => 'https://i0.wp.com/tarifsokagi.com/wp-content/uploads/2022/02/9831D15C-D698-4F5A-86B3-426F3816E859.jpeg?resize=800%2C530&ssl=1',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Ana Yemek',
            ],
            [
                'id' => 5,
                'title' => 'Spaghetti Carbonara',
                'photo_url' => 'https://cdn.yemek.com/mncrop/620/388/uploads/2021/04/patlicanli-pilav-yemekcom.jpg',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Tatlı',
            ],
            [
                'id' => 6,
                'title' => 'Chicken Alfredo',
                'photo_url' => 'https://i.ytimg.com/vi/DqyI_P3uJaU/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLBrw-VnRpC8M2Roa5_C_J-u5T-Qrg',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Tatlı',
            ],
            [
                'id' => 7,
                'title' => 'Beef Stroganoff',
                'photo_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWzmrk1WPjf8-biydMbnfXK0IP1SzEyCYnVg&s',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Tatlı',
            ],
            [
                'id' => 8,
                'title' => 'Vegetarian Lasagna',
                'photo_url' => 'https://i0.wp.com/tarifsokagi.com/wp-content/uploads/2022/02/9831D15C-D698-4F5A-86B3-426F3816E859.jpeg?resize=800%2C530&ssl=1',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Tatlı',
            ],
            [
                'id' => 9,
                'title' => 'Spaghetti Carbonara',
                'photo_url' => 'https://cdn.yemek.com/mncrop/620/388/uploads/2021/04/patlicanli-pilav-yemekcom.jpg',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Ara Öğün',
            ],
            [
                'id' => 10,
                'title' => 'Chicken Alfredo',
                'photo_url' => 'https://i.ytimg.com/vi/DqyI_P3uJaU/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLBrw-VnRpC8M2Roa5_C_J-u5T-Qrg',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Ara Öğün',
            ],
            [
                'id' => 11,
                'title' => 'Beef Stroganoff',
                'photo_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWzmrk1WPjf8-biydMbnfXK0IP1SzEyCYnVg&s',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Ara Öğün',
            ],
            [
                'id' => 12,
                'title' => 'Vegetarian Lasagna',
                'photo_url' => 'https://i0.wp.com/tarifsokagi.com/wp-content/uploads/2022/02/9831D15C-D698-4F5A-86B3-426F3816E859.jpeg?resize=800%2C530&ssl=1',
                'save_count' => 120,
                'share_count' => 35,
                'category' => 'Ara Öğün',
            ],
        ];
        return view('pages.admin.recipes', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.add_recipe');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);
        return view('pages.admin.edit_recipe', ['recipeId' => $id]);
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
