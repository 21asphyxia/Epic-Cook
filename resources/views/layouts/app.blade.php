@include('includes.appHead')
</head>
<body>
    <header class="header-area">
        @include('components.appNav')
    </header>
    <main @if (!Request::is('login') &&!Request::is('register')) class="container mt-5" @endif>
        @yield('content')
    </main>
    <footer>
        @yield('footer')
    </footer>
    @include('includes.appScripts')
</body>
</html>