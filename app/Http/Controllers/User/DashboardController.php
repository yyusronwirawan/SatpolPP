<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\News;

class DashboardController extends Controller
{
    public function index()
    {
        $news = News::latest()->limit(3)->get();
        return view('layouts.user.dashboard', compact('news'));
    }
}
