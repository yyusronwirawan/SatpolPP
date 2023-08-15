@extends('layouts.user.master')

@section('title')
    {{ $news->title }}
@endsection

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.html">Beranda</a></li>
                <li>Berita</li>
            </ol>
            <h2>Berita</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="entry-img">
                            <img src="{{ Storage::url('news/' . $news->image) }}" alt="{{ $news->title }}" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            <a href="#">{{ $news->title }}</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">Bidang
                                        {{ $news->sector() }}</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time
                                            datetime="{{ $news->created_at->format('d M Y H:i') }}">{{ $news->created_at->format('d M Y H:i') }}</time></a>
                                </li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <p>
                                {!! $news->body !!}
                            </p>
                        </div>
                    </article><!-- End blog entry -->

                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        {{-- <h3 class="sidebar-title">Search</h3>
                    <div class="sidebar-item search-form">
                        <form action="#">
                            <input type="text" name="search">
                            <button type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div><!-- End sidebar search formn--> --}}

                        <h3 class="sidebar-title">Berita terkini</h3>
                        <div class="sidebar-item recent-posts">
                            @foreach ($recentNews as $data)
                                <div class="post-item clearfix">
                                    <img src="{{ Storage::url('news/' . $data->image) }}" alt="{{ $data->title }}">
                                    <h4><a href="{{ route('berita.detail', $data->slug) }}">{{ $data->title }}</a></h4>
                                    <time
                                        datetime="{{ $data->created_at->format('d M Y H:i') }}">{{ $data->created_at->format('d M Y H:i') }}</time>
                                </div>
                            @endforeach
                        </div><!-- End sidebar recent posts-->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Single Section -->
@endsection
