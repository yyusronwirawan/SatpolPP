<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Regulation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $regulation = Regulation::latest()->get();
        return view('layouts.admin.regulasi.index', [
            'regulation' => $regulation,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.regulasi.create');
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
            'title' => 'required|unique:regulations|min:5',
            'description' => 'required|min:5',
            'document' => 'required|mimes:pdf',
        ]);

        if ($request->file('document') && $request->file('document')->isValid()) {

            $filename = $request->file('document')->hashName();
            $request->file('document')->storeAs('regulation/', $filename, 'public');
        }

        $regulation = new Regulation();
        $regulation->document = $filename;
        $regulation->slug =  Str::slug($request->title);
        $regulation->title = $request->title;
        $regulation->description = $request->description;

        $regulation->save();
        return redirect()->route('regulation.index')->with(['success', 'Berhasil Upload Dokumen']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Regulation $regulation)
    {
        return view('layouts.admin.regulasi.edit', compact('regulation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regulation $regulation)
    {
        $attr = $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required|min:5',
            'document' => 'required|mimes:pdf',
        ]);

        if ($request->file('document') && $request->file('document')->isValid()) {

            $path = storage_path('app/public/regulation/');
            $filename = $request->file('document')->hashName();

            // delete old file from storage
            if ($regulation->document != null && file_exists($path . $regulation->document)) {
                unlink($path . $regulation->document);
            }

            $request->file('document')->storeAs('regulation/', $filename, 'public');
        }

        $regulation->update([
            'title' => $attr['title'],
            'slug' => Str::slug($attr['title']),
            'description' => $attr['description'],
            'document' => $filename,
        ]);

        return redirect()->route('regulation.index')->with(['success', 'Berhasil Upload Dokumen']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regulation $regulation)
    {
        try {
            // determine path file
            $pathFile = storage_path('app/public/regulation/');

            // if document file exist remove file from directory
            if ($regulation->document != null && file_exists($pathFile . $regulation->document)) {
                unlink($pathFile . $regulation->document);
            }

            $regulation->delete();
            return redirect()->route('regulation.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()
                ->route('regulation.index')
                ->with('error', __($th->getMessage()));
        }
    }
}
