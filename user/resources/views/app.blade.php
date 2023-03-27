<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <script defer src="{{ mix('js/app.js') }}"></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css' rel='stylesheet' />
</head>

<body>
    <div id="app" style="posi">
        <main>
            @include('layout.header')

            @yield('content')

            @include('layout.footer')
        </main>
    </div>
</body>

</html>
