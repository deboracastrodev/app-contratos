<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Aplicação para controle contratos de propriedade">
        <meta name="keywords" content="HTML, CSS, VueJs, Laravel">
        <meta name="author" content="Débora Castro - deboracastro.pm@gmail.com">

        <meta name="csfr-token" content="{{ csrf_token() }}">
        <title>App Contratos</title>

        <base href="/"> 

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@latest/dist/tailwind-ui.min.css">

        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div id="app">
            <router-view></router-view>

        </div>


        <script src="/js/app.js"></script>

    </body>
</html>
