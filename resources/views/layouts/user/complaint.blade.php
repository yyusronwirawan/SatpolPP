@extends('layouts.user.master')

@section('title')Pengaduan @endsection

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
            <p>Pengaduan</p>
        </header>

        <section class="contact">
            <div class="col-lg-12">
                <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" style="background: #fafbff;
                                                                                                                 padding: 30px;
                                                                                                                 height: 100%;">
                    @csrf
                    <div class="row gy-4">

                        <div class="col-md-12">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama">
                            @error('name')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12 ">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Email">
                            @error('email')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title" placeholder="Judul Aduan">
                            @error('title')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" name="description" rows="6" placeholder="Tuliskan Aduan Anda"></textarea>
                            @error('description')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" style="background: #4154f1;
                                                         border: 0;
                                                         padding: 10px 30px;
                                                         color: #fff;
                                                         transition: 0.4s;
                                                         border-radius: 4px;">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <div class="row gy-4" data-aos="fade-left">
            <h3 style="color: #012970;">Daftar Aduan</h3>
            @if($complaint->isEmpty())
            <h2>Maaf, aduan belum ada</h2>
            @else
            @foreach ($complaint as $data)
            <div class="col-lg-6 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <article class="entry">

                    <h2 class="entry-title">
                        <a href="#">{{ $data->title }}</a>
                    </h2>

                    <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">{{ $data->name }}</a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time>{{ $data->created_at->format('d M Y H:i') }}</time></a></li>
                        </ul>
                    </div>

                    <div class="entry-content">
                        <p>
                            {{ Illuminate\Support\Str::words(strip_tags($data->description) , 5) }}
                        </p>
                        <div class="read-more">
                            <a href="{{ route('pengaduan.detail', $data->slug) }}">Selengkapnya</a>
                        </div>
                    </div>

                </article><!-- End blog entry -->
            </div>
            @endforeach
            @endif
        </div>

        {{ $complaint->links('vendor.pagination.custom') }}

    </div>

</section>
<!-- End Pengaduan Section -->

@endsection
