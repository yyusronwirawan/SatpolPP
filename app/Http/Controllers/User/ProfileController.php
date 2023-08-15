<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Profile;


class ProfileController extends Controller
{
    public function index($slug)
    {
        $profile = Profile::where('slug', $slug)->firstOrFail();
        return view('layouts.user.profile', ['profile' => $profile]);
    }
}
