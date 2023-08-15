@extends('layouts.admin.master')

@section('title', 'Berita | Admin Satpol PP Bone Bolango')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets_admin/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_admin/compiled/css/table-datatable.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <h3>Berita</h3>
    </div>

    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('news.create') }}" class="btn btn-primary mb-4">Tambah Berita</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Judul Berita</th>
                                    <th>Isi Berita</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $item)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ Illuminate\Support\Str::words(strip_tags($item->body), 6) }}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('news.destroy', $item->slug) }}" method="POST">
                                                <a href="{{ route('berita.detail', $item->slug) }}" target="_blank"
                                                    class="btn btn-sm btn-info my-2"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ asset('storage/news/' . $item->image) }}" target="_blank"
                                                    class="btn btn-sm btn-success my-2"><i class="bi bi-image-fill"></i></a>
                                                <a href="{{ route('news.edit', $item->slug) }}"
                                                    class="btn btn-sm btn-primary my-2"><i
                                                        class="bi bi-pencil-fill"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger my-2"><i
                                                        class="bi bi-trash-fill"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach ($news as $item)
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets_admin/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets_admin/static/js/pages/simple-datatables.js') }}"></script>
@endpush
