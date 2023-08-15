@extends('layouts.admin.master')

@section('title')
    Akun
@endsection

@section('content')
    <div class="page-heading">
        <h3>Akun</h3>
    </div>

    <section class="section mt-4">

        {{-- Profile --}}
        <div class="row">
            <div class="col-md-3">
                <h4>{{ __('Profile') }}</h4>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user-profile-information.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="email">{{ __('E-mail Address') }}</label>
                                <input type="email" name="email"
                                    class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror"
                                    id="email" placeholder="{{ __('E-mail Address') }}"
                                    value="{{ old('email') ?? auth()->user()->email }}" required>

                                @error('email', 'updateProfileInformation')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" name="name"
                                    class="form-control  @error('name', 'updateProfileInformation') is-invalid @enderror"
                                    id="name" placeholder="{{ __('Name') }}"
                                    value="{{ old('name') ?? auth()->user()->name }}" required>
                                @error('name', 'updateProfileInformation')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="username">{{ __('Username') }}</label>
                                <input type="text" name="username"
                                    class="form-control  @error('username', 'updateProfileInformation') is-invalid @enderror"
                                    id="username" placeholder="{{ __('Username') }}"
                                    value="{{ old('username') ?? auth()->user()->username }}" required>
                                @error('username', 'updateProfileInformation')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Password --}}
        <div class="row">
            <div class="col-md-12">
                <hr class="mb-5">
            </div>

            <div class="col-md-3">
                <h4>{{ __('Ubah Password') }}</h4>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user-password.update', $user->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="password">{{ __('Password Saat Ini') }}</label>
                                <input type="password" name="current_password"
                                    class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                    id="password" placeholder="Password Saat Ini">
                                @error('current_password', 'updatePassword')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password Baru') }}</label>
                                <input type="password" name="password"
                                    class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                    id="password" placeholder="Password Baru">
                                @error('password', 'updatePassword')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">{{ __('Konfirmasi Password Baru') }}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Konfirmasi Password Baru">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Ubah Password') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
