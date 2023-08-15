<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaint = Complaint::latest()->paginate(4);
        return view('layouts.user.complaint', compact('complaint'));
    }

    public function show(Complaint $complaint)
    {
        return view('layouts.user.complaintDetail', compact('complaint'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'required|min:5',
            'description' => 'required',
        ]);

        $complaint = Complaint::create([
            'name' => $request->name,
            'slug' =>  Str::slug($request->title),
            'email' => $request->email,
            'title' => $request->title,
            'description' => $request->description,
            'status' => '0',
        ]);

        if ($complaint) {
            // redirect kalau sukses
            return redirect()->route('pengaduan')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            // redirect kalau tidak sukses
            return redirect()->route('pengaduan')->with(['failed' => 'Data Gagal Disimpan']);
        }
    }
}
