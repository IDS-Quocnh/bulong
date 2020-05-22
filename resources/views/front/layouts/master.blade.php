<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    @auth
    <script>
    /* beautify ignore:start */
    var user = @json(auth()->user());
    var rootUrl = '{{ url('/') }}';
    /* beautify ignore:end */

    </script>
    @endauth
    @guest
    <script>
        var user = '';
    </script>
    @endguest
</head>

<body>
    <div id="app">
        @include('front.includes.header')
        <div class="flex justify-between lg:px-4 pt-3">
            @include('front.includes.sidebar_left')
            <div>
                <main class="feed mx-4" style="width: 542px;">
                    @yield('content')
                    <v-dialog />
                </main>
            </div>
            @include('front.includes.sidebar_right')
        </div>
    </div>
    <script type="text/javascript" src="/js/app.js"></script>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>

</html>
