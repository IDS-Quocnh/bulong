<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .feed::-webkit-scrollbar {
        display: none;
    }

    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/main.css')}}">
    @auth
    <script>
    /* beautify ignore:start */
    var user = @json(auth()->user());
    /* beautify ignore:end */

    </script>
    @endauth
</head>

<body>
    <div id="app">
        <app></app>
    </div>
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</body>

</html>
