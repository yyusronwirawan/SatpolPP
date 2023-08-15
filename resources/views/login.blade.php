<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin</title>
    @include('layouts.admin.partials.styles')
</head>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    @if (session('status'))
                                    <div>
                                        <span class="text-danger"><strong>{{ session('status') }}</strong></span>
                                    </div>
                                    @endif
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error ('username') border-danger @enderror" id="username" type="text" name="username" placeholder="username" />
                                            <label for="username">Username</label>
                                            @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error ('password') border-danger @enderror" id="password" type="password" name="password" placeholder="Password" />
                                            <label for="password">Password</label>
                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mt-4">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    @include('layouts.admin.partials.scripts')
</body>

</html>
