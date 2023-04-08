@include('includes.appHead')
</head>
<body>
    <header>
    @yield('nav')
    </header>
    <main @if (!Request::is('login') &&!Request::is('register')) class="container mt-5" @endif>
    @yield('content')
    @yield('login or register')
    </main>
    <footer>
    @yield('footer')
    </footer>
    @yield('scripts')
</body>
</html>