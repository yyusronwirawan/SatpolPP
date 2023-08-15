@extends('layouts.user.master')

@section('title')Profil @endsection

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="index.html">Beranda</a></li>
            <li>{{ $profile->title }}</li>
        </ol>
        <h2>{{ $profile->title }}</h2>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        {!! $profile->content !!}

    </div>
</section><!-- End Blog Section -->

@endsection
