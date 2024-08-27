<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CarouselPhotos;

class CarouselPhotoController extends Controller
{
    public function carouselPhotos()
    {
        $photos = CarouselPhotos::active();
        if (count($photos) > 0) {
            return response()->json($photos, 200);
        }
        return response()->json($photos, 404);
    }
}
