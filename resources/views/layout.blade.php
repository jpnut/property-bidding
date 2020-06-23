<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Property Bidding | @yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="mt-4 container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <a class="navbar-brand" href="/">
                Property Bidding
            </a>
        </nav>
    </div>
    @yield('content')
    @yield('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
</div>
</body>
</html>
