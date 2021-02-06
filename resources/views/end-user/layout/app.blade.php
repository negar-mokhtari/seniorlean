<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title')</title>

    @stack('styles')

    @include('end-user.layout._styles')
</head>

<body id="course-single" class="page">
<header>
    @include('end-user.layout._header')
</header>
<main>
    @yield('content')
    <br>
</main>
<footer>
    @include('end-user.layout._footer')
</footer>
@include('end-user.layout._scripts')
</body>
</html>
