@include('includes.adminHead')


<body>
    @include('components.nav', ['user' => auth()->user() ])
    @include('components.sidebar')
    <main id="main" class="main">
        @yield('content')
    </main>
    @include('includes.adminScripts')
</body>
</html>