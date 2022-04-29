<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />

        <!-- Scripts -->
        <script src="{{ mix('/js/app.js') }}" defer></script>

        <!-- Inertia head -->
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
