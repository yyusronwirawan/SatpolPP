<?php

namespace App\Http\Controllers\Admin\Complaints;

use App\Http\Controllers\Controller;
use App\Models\Admin\Complaint;
use App\Models\Admin\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'response' => 'required|min:5',
        ]);
        $complaint = Complaint::where('id', $request->complaint_id)->first();
        $response = Response::where('complaint_id', $request->complaint_id)->first();
      
        // Logika tanggapan pengaduan
        if ($response) {
            $complaint->update(['status' => $request->status]);

            $response->update([
                'response' => $request->response,
                'user_id' => Auth::user()->id,
            ]);
            return redirect()->route('complaint.show', ['complaint' => $complaint, 'response' => $response])->with(['status' => 'Berhasil Dikirim!']);
        }  else {
            $complaint->update(['status' => $request->status]);

            $response = Response::create([
                'complaint_id' => $request->complaint_id,
                'response' => $request->response,
                'user_id' => Auth::user()->id,
            ]);
            return redirect()->route('complaint.show', ['complaint' => $complaint, 'response' => $response])->with(['status' => 'Berhasil Dikirim!']);
        }
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
        //
    }
}
