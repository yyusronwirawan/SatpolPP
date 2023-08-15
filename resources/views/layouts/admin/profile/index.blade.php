@extends('layouts.admin.master')

@section('title')
    {{ $profile->title }}
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="page-heading">
        <h3>{{ $profile->title }}</h3>
    </div>

    <section class="section">
        <div class="page-content">
            <div class="card border-0 shadow rounded">
                <div class="card-body">

                    <div class="form-group">
                        <label class="font-weight-bold">Judul</label>
                        <p>{{ $profile->title }}</p>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Deskripsi</label>
                        <p>{!! $profile->content !!}</p>
                    </div>

                    <!-- Button trigger modal -->
                    <a href="{{ route('profile.edit', $profile->slug) }}" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Edit
                    </a>

                    {{-- modal edit --}}

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit {{ $profile->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('profile.update', $profile->slug) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="font-weight-bold">Judul</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" value="{{ old('title', $profile->title) }}"
                                                placeholder="Nama Instansi">

                                            <!-- error message untuk nama instansi -->
                                            @error('title')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Deskripsi</label>
                                            <textarea id="summernote" class="form-control @error('content') is-invalid @enderror" name="content" rows="5"
                                                placeholder="Masukan Deskripsi Instansi">{{ old('content', $profile->content) }}</textarea>

                                            <!-- error message untuk description(isi) -->
                                            @error('content')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- batas modal edit --}}
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                placeholder: 'Harap Masukan Isi Profil',
            });
        });
    </script>
@endpush
