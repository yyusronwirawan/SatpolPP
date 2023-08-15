<?php

namespace App\Http\Controllers\Admin\Complaints;

use App\Http\Controllers\Controller;
use App\Models\Admin\Complaint;
use App\Models\Admin\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComplaintController extends Controller
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
        $complaints = Complaint::get();
        // dd($complaints);
        return view('layouts.admin.pengaduan.index', [
            'complaints' => $complaints,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view()
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($complaint_id)
    {
        // dd($complaint_id);
        $complaint = Complaint::where('slug', $complaint_id)->first();

        $response = Response::where('complaint_id', $complaint_id)->first();
        return view('layouts.admin.pengaduan.show', ['complaint' => $complaint, 'response' => $response]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $complaint = Complaint::findOrFail($slug);

        // $complaint->delete();

        // if($complaint) {
        //     return redirect()->route('complaint.index')->with(['success' => 'Berhasil']);
        // }else {
        //     return redirect()->route('complaint.index')->with(['error' => 'Gagal']);
        // }
        $delete = Complaint::find($id);
        $delete->delete();
        // return redirect()->route('complaint.index')->with(['success', 'Data Berhasil Dihapus']);
        if ($delete) {
            return redirect()->route('complaint.index')->with(['success' => 'Berhasil']);
        } else {
            return redirect()->route('complaint.index')->with(['error' => 'Gagal']);
        }
    }
}
