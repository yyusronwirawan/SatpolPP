<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Profile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function show($slug)
    {
        $profile = Profile::where('slug', $slug)->firstOrFail();
        return view('layouts.admin.profile.index', ['profile' => $profile]);
    }

    public function edit(Profile $profile)
    {
        return view('layouts.admin.profile.index', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        $this->validate($request, [
            'title'   => 'required|min:5',
            'content'   => 'required|min:5',
        ]);

        $profile = Profile::findOrFail($profile->id);

        $profile->update([
            'title'  => $request->title,
            'content' => $request->content,
        ]);

        if ($profile) {
            $profile->update([
                'slug' => Str::slug($request->title),
            ]);
            return redirect()->back();
        }
    }
}
