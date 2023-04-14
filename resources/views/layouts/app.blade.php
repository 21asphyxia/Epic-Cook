@include('includes.appHead')
</head>
<body>
    <header class="header-area">
        <x-appNav :user="auth()->user()->name ?? 'Guest'" />
    </header>
    <main class="container @if (!Request::is('login') &&!Request::is('register'))mt-4" @endif>
        @yield('content')
    </main>
    <footer>
        <x-appFooter />
    </footer>
    @include('includes.appScripts')
</body>
</html>