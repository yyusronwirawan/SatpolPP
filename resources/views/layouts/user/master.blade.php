<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') - Satpol PP Bonebol</title>

    @include('layouts.user.partials.styles')
    @stack('style')
</head>

<body>

    @include('layouts.user.partials.header')

    <main id="main">
        @yield('content')
    </main><!-- End #main -->

    @include('layouts.user.partials.footer')

    @include('layouts.user.partials.scripts')

</body>

</html>
