<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Facón') }} | {{$sectionName}}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


        <script>
            window.API_ROUTES = {
                @foreach ($apiRoutes as $key => $route)
                    {{ $key }}: "{{ $route }}",
                @endforeach
            };
        </script>

        @vite('resources/css/app.css')
        @foreach ($cssSheets as $sheet)
            @vite($sheet)
        @endforeach

        @vite('resources/js/app.js')
        @foreach ($jsScripts as $script)
            @vite($script)
        @endforeach
    </head>
    <body class="gradient-bg font-reg">
        <div class="h-100 d-flex overflow-hidden">
            <x-nav-bar :sectionId="$sectionId" />
            <div id="content" class="w-100 overflow-y-auto">
                {{ $slot }}
            </div>
        </div>

        @foreach ($jsScriptsToEnd as $script)
            @vite($script)
        @endforeach
    </body>
</html>