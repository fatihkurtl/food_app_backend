<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('pages.admin.categories');
    }

    public function show($id)
    {
        return view('pages.admin.category_detail', ['categoryId' => $id]);
    }
}
