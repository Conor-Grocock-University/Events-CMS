<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="canonical" content="{{ url()->full() }}">

    @hasSection('title')
        <title>@yield('title') | {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    @hasSection('description')
        <meta name="description" content="@yield('description')">
    @else
        <meta name="description" content="The best place to find and book events">
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        @include('partials.navigation')

        <main class="content">
            @yield('content')
        </main>
    </div>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        new Vue({
            data: function() {
            return {
                searchClient: algoliasearch(
                '{{ config('scout.algolia.id') }}',
                '{{ Algolia\ScoutExtended\Facades\Algolia::searchKey(App\Event::class) }}',
                ),
            };
            },
            el: 'main.content',
        });
    </script>
    <script>
        function toggleDropdown(elementID) {
            var element = document.getElementById(elementID);
            element.classList.toggle("hidden");
        }
        </script>
    @yield('scripts')


</body>
</html>
