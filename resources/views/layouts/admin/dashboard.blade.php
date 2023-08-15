@extends('layouts.admin.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="page-heading">
            <h3>Dashboard</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="text-muted font-semibold">Regulasi</h6>
                                            <h6 class="font-extrabold mb-0">{{ $totalRegulation }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="col-md-12">
                                        <h6 class="text-muted font-semibold">Galeri Kegiatan</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalGallery }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="col-md-12">
                                        <h6 class="text-muted font-semibold">Berita</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalNews }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistik Pengaduan</h4>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-6 col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-3">
                                            <div class="col-md-12">
                                                <h6 class="text-muted font-semibold">Jumlah Aduan</h6>
                                                <h6 class="font-extrabold mb-0">{{ $totalComplaint }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-3">
                                            <div class="col-md-12">
                                                <h6 class="text-muted font-semibold">Dalam Tindakan</h6>
                                                <h6 class="font-extrabold mb-0">{{ $totalComplaintInProcess }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-3">
                                            <div class="col-md-12">
                                                <h6 class="text-muted font-semibold">Diselesaikan</h6>
                                                <h6 class="font-extrabold mb-0">{{ $totalComplaintCompleted }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
