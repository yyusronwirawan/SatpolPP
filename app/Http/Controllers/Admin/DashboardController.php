<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Complaint;
use App\Models\Admin\Galery;
use App\Models\Admin\News;
use App\Models\Admin\Regulation;

class DashboardController extends Controller
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
        $totalComplaint = Complaint::count();
        $totalRegulation = Regulation::count();
        $totalGallery = Galery::count();
        $totalNews = News::count();
        $totalComplaintInProcess = Complaint::where('status', '1')->count();
        $totalComplaintCompleted = Complaint::where('status', '2')->count();
        return view('layouts.admin.dashboard', compact('totalComplaint', 'totalRegulation', 'totalGallery', 'totalNews',  'totalComplaintInProcess', 'totalComplaintCompleted'));
    }
}
