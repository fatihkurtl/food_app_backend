<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Categories;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = (object) [
            'totalUsers' => 150,
            'totalRecipes' => 1200,
            'totalDownloads' => 3400,
            'totalCategories' => 45,
        ];

        return view('pages.admin.index', compact('stats'));
    }

    public function adminUsersIndex()
    {

        $users = [
            [
                'id' => 1,
                'name' => 'Fatih Kurt',
                'email' => 'fatih@example.com',
                'profile_photo_url' => 'https://www.pngkey.com/png/detail/114-1149878_setting-user-avatar-in-specific-size-without-breaking.png',
                'age' => 27,
                'gender' => 'Erkek',
            ],
            [
                'id' => 2,
                'name' => 'Berkecan Güveç',
                'email' => 'ahmet@example.com',
                'profile_photo_url' => 'https://www.pngkey.com/png/detail/114-1149878_setting-user-avatar-in-specific-size-without-breaking.png',
                'age' => 27,
                'gender' => 'Kadın',
            ],
            [
                'id' => 3,
                'name' => 'Ertuğrul HardReset',
                'email' => 'ahmet@example.com',
                'profile_photo_url' => 'https://www.pngkey.com/png/detail/114-1149878_setting-user-avatar-in-specific-size-without-breaking.png',
                'age' => 25,
                'gender' => 'Erkek',
            ],
            [
                'id' => 4,
                'name' => 'Burak Yaban',
                'email' => 'ahmet@example.com',
                'profile_photo_url' => 'https://www.pngkey.com/png/detail/114-1149878_setting-user-avatar-in-specific-size-without-breaking.png',
                'age' => 25,
                'gender' => 'Erkek',
            ],
            [
                'id' => 5,
                'name' => 'Sinan Kaya',
                'email' => 'ahmet@example.com',
                'profile_photo_url' => 'https://www.pngkey.com/png/detail/114-1149878_setting-user-avatar-in-specific-size-without-breaking.png',
                'age' => 25,
                'gender' => 'Erkek',
            ],
            [
                'id' => 6,
                'name' => 'Fatih Kurt',
                'email' => 'fatih@example.com',
                'profile_photo_url' => 'https://www.pngkey.com/png/detail/114-1149878_setting-user-avatar-in-specific-size-without-breaking.png',
                'age' => 25,
                'gender' => 'Erkek',
            ],
            [
                'id' => 7,
                'name' => 'Berkecan Güveç',
                'email' => 'ahmet@example.com',
                'profile_photo_url' => 'https://www.pngkey.com/png/detail/114-1149878_setting-user-avatar-in-specific-size-without-breaking.png',
                'age' => 25,
                'gender' => 'Erkek',
            ],
            [
                'id' => 8,
                'name' => 'Ertuğrul HardReset',
                'email' => 'ahmet@example.com',
                'profile_photo_url' => 'https://www.pngkey.com/png/detail/114-1149878_setting-user-avatar-in-specific-size-without-breaking.png',
                'age' => 25,
                'gender' => 'Erkek',
            ],
            [
                'id' => 9,
                'name' => 'Burak Yaban',
                'email' => 'ahmet@example.com',
                'profile_photo_url' => 'https://www.pngkey.com/png/detail/114-1149878_setting-user-avatar-in-specific-size-without-breaking.png',
                'age' => 25,
                'gender' => 'Erkek',
            ],
            [
                'id' => 10,
                'name' => 'Sinan Kaya',
                'email' => 'ahmet@example.com',
                'profile_photo_url' => 'https://www.pngkey.com/png/detail/114-1149878_setting-user-avatar-in-specific-size-without-breaking.png',
                'age' => 25,
                'gender' => 'Erkek',
            ],
        ];
        return view('pages.admin.users', compact('users'));
    }

    public function allCarouselsIndex()
    {
        return view('pages.admin.carousels');
    }

    public function addCarouselIndex()
    {
        return view('pages.admin.add_carousel');
    }

    public function editCarouselPhoto(string $id)
    {
        return view('pages.admin.edit_carousel', ['carouselId' => $id]);
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
     * Display the specified resource.
     */
    public function show(string $id)
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
