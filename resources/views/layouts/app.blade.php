@include('includes.appHead')
</head>
<body>
    <header class="header-area">
        <x-appNav :user="auth()->user() ?? 'Guest'" />
    </header>
    @php
        $route = Route::currentRouteName();
        // dd($route);
    @endphp
    <main class="container @if($route == 'login.page' || $route == 'register.page') d-flex flex-column align-items-center justify-content-center py-4 @else mt-5 @endif">
        @yield('content')
    </main>
    <footer>
        <x-appFooter />
    </footer>
    @include('includes.appScripts')
</body>
</html>