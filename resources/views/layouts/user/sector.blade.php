@extends('layouts.user.master')

@section('title')
    Bidang
@endsection

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.html">Beranda</a></li>
                <li>Bidang</li>
            </ol>
            <h2>Bidang</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">
                    @if ($news->isEmpty())
                        <h2>Maaf, data belum ada</h2>
                    @else
                        @foreach ($news as $data)
                            <article class="entry">

                                <div class="entry-img">
                                    <img src="{{ Storage::url('news/' . $data->image) }}" alt="{{ $data->title }}"
                                        class="img-fluid">
                                </div>

                                <h2 class="entry-title">
                                    <a href="{{ route('berita.detail', $data->slug) }}">{{ $data->title }}</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                href="#">Admin</a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                href="#"><time
                                                    datetime="{{ $data->created_at->format('d M Y H:i') }}">{{ $data->created_at->format('d M Y H:i') }}</time></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="entry-content">
                                    <p>
                                        {{ Illuminate\Support\Str::words(strip_tags($data->body), 50) }}
                                    </p>
                                    <div class="read-more">
                                        <a href="{{ route('berita.detail', $data->slug) }}">Selengkapnya</a>
                                    </div>
                                </div>

                            </article><!-- End blog entry -->
                        @endforeach
                    @endif

                    {{ $news->links('vendor.pagination.custom') }}
                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        {{-- <h3 class="sidebar-title">Search</h3>
                    <div class="sidebar-item search-form">
                        <form action="/search" method="POST">
                            <input type="text" name="q">
                            <button type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div><!-- End sidebar search formn--> --}}

                        @if ($recentNews->isEmpty())
                            <p>Maaf, data belum ada</p>
                        @else
                            <h3 class="sidebar-title">Berita Terkini</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($recentNews as $data)
                                    <div class="post-item clearfix">
                                        <img src="{{ Storage::url('news/' . $data->image) }}" alt="{{ $data->title }}">
                                        <h4><a href="{{ route('berita.detail', $data->slug) }}">{{ $data->title }}</a>
                                        </h4>
                                        <time
                                            datetime="{{ $data->created_at->format('d M Y H:i') }}">{{ $data->created_at->format('d M Y H:i') }}</time>
                                    </div>
                                @endforeach

                            </div><!-- End sidebar recent posts-->
                        @endif


                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Section -->

@endsection
