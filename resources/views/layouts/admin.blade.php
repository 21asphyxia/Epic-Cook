@include('includes.adminHead')


<body>
    @yield('nav')
    @yield('sidebar')
    <main class="container mt-5">
        @yield('content')
    </main>
    @yield('scripts')
</body>
</html>