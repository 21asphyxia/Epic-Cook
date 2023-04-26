@php
    $route = Route::currentRouteName();
@endphp

<div class="@if ($route != 'login.page' && $route != 'register.page') mt-5 @endif">
    <footer class="text-center text-white">
        <div class="container">
            <hr class="my-5" />
            <section class="text-center pb-4">
                <a href="" class="text-dark me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="text-dark me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="text-dark me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="text-dark me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="text-dark me-4">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="text-dark ">
                    <i class="fab fa-github"></i>
                </a>
            </section>
        </div>

    </footer>
</div>