@extends('layouts.user.master')

@section('title')Detail Pengaduan @endsection

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="index.html">Beranda</a></li>
            <li>Pengaduan</li>
        </ol>
        <h2>Pengaduan</h2>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Pengaduan Section ======= -->
<section class="blog">

    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h2>Satpol PP Kabupaten Bone Bolango</h2>
            <p>Detail Pengaduan</p>
        </header>

        <a href="{{ route('pengaduan') }}" class="btn btn-md btn-primary my-2"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div class="row gy-4" data-aos="fade-left">
            <div class="col-12" data-aos="zoom-in" data-aos-delay="100">
                <article class="entry">

                    <h2 class="entry-title">
                        <a href="#">{{ $complaint->title }}</a>
                    </h2>

                    <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">{{ $complaint->name }}</a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time>{{ $complaint->created_at->format('d M Y H:i') }}</time></a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-info-circle"></i> <a href="#">
                                    @if($complaint->status == 0)
                                    Menunggu Tanggapan
                                    @elseif($complaint->status == 1)
                                    Dalam Tindakan
                                    @else
                                    Selesai
                                    @endif</a></li>
                        </ul>
                    </div>

                    <div class="entry-content">
                        <p>
                            {{ $complaint->description}}
                        </p>
                    </div>

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Tanggapan Petugas
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if($complaint->response)
                                    <div class="entry-meta">
                                        <ul>
                                            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">{{ $complaint->response->user->name ?? ''}}</a></li>
                                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time>{{ $complaint->response ? $complaint->response->created_at->format('d M Y H:i') : '' }}</time></a></li>
                                        </ul>
                                    </div>
                                    @endif

                                    {{ $complaint->response->response ?? 'Belum Ada Tanggapan' }}
                                </div>
                            </div>
                        </div>
                    </div>

                </article><!-- End blog entry -->
            </div>
        </div>

    </div>

</section>
<!-- End Pengaduan Section -->

@endsection
