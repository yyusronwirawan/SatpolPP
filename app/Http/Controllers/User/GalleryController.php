<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Galery;


class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Galery::latest()->paginate(9);
        return view('layouts.user.gallery', compact('gallery'));
    }
}
