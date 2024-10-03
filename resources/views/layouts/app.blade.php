<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
    @include('includes.style') <!-- Pastikan file ini ada dan memuat CSS yang diperlukan -->
    @stack('addon-style')
</head>

<body>
    <!-- Navigation -->
    @include('includes.navbar') <!-- Pastikan file ini ada dan tidak ada kelas yang membuat navbar transparan -->

    <!-- Page Content -->
    @yield('content')

    @include('includes.footer') <!-- Pastikan file ini ada dan benar -->

    @stack('prepend-script')
    @include('includes.script') <!-- Pastikan file ini ada dan memuat JS yang diperlukan -->
    @stack('addon-script')
</body>
</html>
