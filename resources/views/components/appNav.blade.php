  <nav class="navbar navbar-expand-lg">
      <div class="container">
          <a class="navbar-brand" href="#">Epic Cook</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
              <ul class="navbar-nav mb-0 mt-2 flex-row flex-wrap justify-content-center">
                  <li class="nav-item">
                      <a class="nav-link active" href="/">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('app.recipes') }}">Recipes</a>
                  <li class="nav-item">
                      <a class="nav-link" href="/about">About</a>
                  </li>
              </ul>
              <ul class="navbar-nav mb-0 mt-2 flex-row justify-content-center">
                  @auth
                      <li class="nav-item">
                          <a class="btn rounded-pill btn-light" href="{{ url('/dashboard') }}">Dashboard</a>
                      </li>
                  @else
                      @if (Route::has('login.page'))
                          <li class="nav-item">
                              <a class="btn text-secondary" href="{{ route('login.page') }}">Login</a>
                          </li>
                      @endif
                      @if (Route::has('register.page'))
                          <li class="nav-item">
                              <a class="btn rounded-pill btn-light" href="{{ route('register.page') }}">Sign up</a>
                          </li>
                      @endif
                  @endauth
              </ul>
          </div>
      </div>
  </nav>
  <hr class="mx-5">
  @if (Request::is('/'))
      <img src="{{ asset('img/banner-2.png') }}" alt="hero" class="img-fluid" height="100">
  @endif
