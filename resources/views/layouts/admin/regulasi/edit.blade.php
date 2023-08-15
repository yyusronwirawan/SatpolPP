@extends('layouts.admin.master')

@section('title', 'Edit Regulasi | Admin Satpol PP Bone Bolango')

@section('content')
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('regulation.index') }}">Regulasi</a>
    </li>
    <li class="breadcrumb-item active fon">Edit Regulasi</li>
</ol>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('regulation.update', $regulation->slug)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label class="font-weight-bold">Judul Regulasi</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $regulation->title) }}" placeholder="Judul Galeri Kegiatan">

                            <!-- error message untuk title -->
                            @error('title')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Isi Galeri</label>
                            <textarea id="summernote" class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Isi Galeri Kegiatan">{{ old('description', $regulation->description) }}</textarea>

                            <!-- error message untuk description(isi) -->
                            @error('description')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Document</label>
                            <input type="file" class="form-control @error('document') is-invalid @enderror" name="document" value="{{ old('document', $regulation->document) }}">

                            <!-- error message untuk document -->
                            @error('document')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
