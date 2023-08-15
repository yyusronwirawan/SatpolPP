<?php

namespace App\Http\Controllers\User;

use App\Models\Admin\Regulation;
use App\Http\Controllers\Controller;

class RegulationController extends Controller
{
    public function index()
    {
        $regulation = Regulation::latest()->paginate(9);
        return view('layouts.user.regulation', [
            'regulation' => $regulation,
        ]);
    }

    public function download($slug)
    {
        $regulation = Regulation::where('slug', $slug)->first();

        $file_path = 'storage/regulation/' . $regulation->document;

        return response()->download($file_path, $regulation->title . '.pdf', [
            'Content-Type' => 'application/octet-stream',
            'Content-Length' => filesize($file_path),
        ])->setStatusCode(200);
    }
}
