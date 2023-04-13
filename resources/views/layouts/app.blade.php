@include('includes.appHead')
</head>
<body>
    <header class="header-area">
        <x-appNav :user="auth()->user()->name ?? 'Guest'" />
    </header>
    <main @if (!Request::is('login') &&!Request::is('register')) class="container mt-5" @endif>
        @yield('content')
    </main>
    <footer>
        <x-appFooter />
    </footer>
    @include('includes.appScripts')
</body>
</html>