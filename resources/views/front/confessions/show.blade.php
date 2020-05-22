<!DOCTYPE html>
<html>

<head>
    <title>Comment</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @auth
    <script>
    /* beautify ignore:start */
    var user = @json(auth()->user());
    var rootUrl = '{{ url('/') }}';
    /* beautify ignore:end */

    </script>
    @endauth

    <style>
        .dropdown:hover .dropdown-menu {
          display: block;
        }
    </style>
</head>

<body>
    @include('front.includes.header')
    <div id="app" v-cloak>
        <confession-detail :confession="{{ $confession }}"></confession-detail>
    </div>
    <script type="text/javascript" src="/js/app.js"></script>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>

</html>
