@extends('layouts.user.master')

@section('title')Regulasi @endsection

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="index.html">Beranda</a></li>
            <li>Regulasi</li>
        </ol>
        <h2>Regulasi</h2>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Section ======= -->
<section class="blog">

    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h2>Satpol PP Kabupaten Bone Bolango</h2>
            <p>Regulasi</p>
        </header>

        <div class="row gy-4" data-aos="fade-left">

            @if(!$regulation->isEmpty())
            @foreach ($regulation as $data)
            <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">

                <article class="entry">

                    <h2 class="entry-title">
                        <a href="#">{{ $data->title }}</a>
                    </h2>

                    <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">Admin</a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="{{ $data->created_at->format('d M Y') }}">{{ $data->created_at->format('d M Y') }}</time></a></li>
                        </ul>
                    </div>

                    <div class="entry-content">
                        <p>
                            {{ $data->description }}
                        </p>
                        <div class="read-more">
                            <a href="{{ Storage::url('regulation/'.$data->document) }}" target="pdf-frame"><i class="bi bi-eye me-2"></i>Lihat</a>
                            <a href="/download/{{ $data->slug }}"><i class="bi bi-download me-2"></i>Unduh</a>
                        </div>
                    </div>

                </article><!-- End blog entry -->

            </div>
            @endforeach

            @else
            <h2 class="my-2">Maaf, data tidak ada<h2>
                    @endif



        </div>

        {{ $regulation->links('vendor.pagination.custom') }}

    </div>

</section>
<!-- End Blog Section -->

@endsection
