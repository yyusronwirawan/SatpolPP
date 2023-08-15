@extends('layouts.admin.master')

@section('title', 'Pengaduan | Admin Satpol PP Bone Bolango')

@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('complaint.index') }}">Pengaduan</a>
    </li>
    <li class="breadcrumb-item active fon">Detail Pengaduan</li>
</ol>

<div class="row">
    <div class="col-lg-6 col-12">
        <div class="card">
            <div class="card-header">
                <div class="text-center">
                    Pengaduan
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Nama Pengadu</th>
                            <td>:</td>
                            <td>{{ $complaint->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td>{{ $complaint->email }}</td>
                        </tr>
                        <tr>
                            <th>Judul Pengaduan</th>
                            <td>:</td>
                            <td>{{ $complaint->title }}</td>
                        </tr>
                        <tr>
                            <th>Isi Pengaduan</th>
                            <td>:</td>
                            <td>{{ $complaint->description }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                                @if ($complaint->status =='0')
                                <a href="#" class="btn btn-danger">Menunggu Tanggapan</a>
                                @elseif ($complaint->status == '1')
                                <a href="#" class="btn btn-warning">Dalam Tindakan</a>
                                @else
                                <a href="#" class="btn btn-success">Selesai</a>
                                @endif
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12">
        <div class="card">
            <div class="card-header">
                <div class="text-center">
                    Tanggapan Petugas
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('response.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="input-group mb-3">
                            <select name="status" id="status" class="custom-select">
                                @if ($complaint->status=='0')
                                <option selected value="0">Menunggu Tanggapan</option>
                                <option value="1">Dalam Tindakan</option>
                                <option value="2">Selesai</option>
                                @elseif ($complaint->status=='1')
                                <option value="0">Menunggu Tanggapan</option>
                                <option selected value="1">Dalam Tindakan</option>
                                <option value="2">Selesai</option>
                                @else
                                <option value="0">Menunggu Tanggapan</option>
                                <option value="1">Dalam Tindakan</option>
                                <option selected value="2">Selesai</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="response">Tanggapan</label>
                        <textarea name="response" id="response" rows="4" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Belum ada Tanggapan">{{ $complaint->response->response ?? '' }}</textarea>
                        @error('response')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
                @if (Session::has('status'))
                <div class="alert alert-success mt-2">
                    {{ Session::get('status') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
