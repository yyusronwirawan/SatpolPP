@extends('layouts.user.master')

@section('title')Galeri Kegiatan @endsection

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="index.html">Beranda</a></li>
            <li>Galeri Kegiatan</li>
        </ol>
        <h2>Galeri Kegiatan</h2>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">

    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h2>Satpol PP Kabupaten Bone Bolango</h2>
            <p>Galeri Kegiatan</p>
        </header>

        <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

            @if (!$gallery->isEmpty())
            @foreach ($gallery as $data)
            <div class="col-lg-4 col-md-6 portfolio-item ">
                <div class="portfolio-wrap">
                    <img src="{{ Storage::url('galery/'.$data->image) }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>{{ $data->title }}</h4>
                        <div class="portfolio-links">
                            <a href="{{ Storage::url('galery/'.$data->image) }}" data-gallery="portfolioGallery" class="portfokio-lightbox" title="{{ $data->title }}"><i class="bi bi-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <h2 class="my-2">Maaf, data tidak ada<h2>
                    @endif


                    {{ $gallery->links('vendor.pagination.custom') }}


</section><!-- End Portfolio Section -->

@endsection
