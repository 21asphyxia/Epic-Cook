@extends('layouts.app')

@section('additionalCSS')
    <link rel="stylesheet" href="{{ asset('css/vendor/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/owl.theme.default.min.css') }}">
@endsection

@section('additionalJS')
    <script src="{{ asset('js/vendor/owl.carousel.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                // autoHeight: true,
                center: true,
                autoWidth: true,
                items: 1,
                loop: false,
                margin: 10,
                nav: true,
            });
        });

        let editButtons = document.querySelectorAll('.edit-comment');
        editButtons.forEach((button) => {

            button.addEventListener('click', (e) => {
                console.log(e.target.parentElement.parentElement.parentElement.parentElement.querySelector(
                    '.comment-text'));
                let commentId = e.target.dataset.commentId;
                let commentText = e.target.parentElement.parentElement.parentElement.parentElement
                    .querySelector('.comment-text');
                let commentInput = document.querySelector(`#comment-input-${commentId}`);
                let form = `
                    <form action='/comments/${commentId}' method="POST" class="d-flex mb-2">
                        @csrf
                        @method('PUT')
                        <input type="text" name="content" class="form-control me-2" value = "${commentText.innerText}">
                        <button type="submit" class="btn btn-primary">Edit</button>
                `;
                commentText.innerHTML = form;
            });
        });
    </script>
@endsection

@section('content')
    <svg class="d-none">
        <defs>
            <symbol id="icon-star">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z">
                    </path>
                </svg>
            </symbol>
            <symbol id="icon-star-half">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M22 9.74L14.81 9.12L12 2.5L9.19 9.13L2 9.74L7.46 14.47L5.82 21.5L12 17.77L18.18 21.5L16.55 14.47L22 9.74ZM12 15.9V6.6L13.71 10.64L18.09 11.02L14.77 13.9L15.77 18.18L12 15.9Z">
                    </path>
                </svg>
            </symbol>
            <symbol id="icon-star-empty">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M22 9.24L14.81 8.62L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27L18.18 21L16.55 13.97L22 9.24ZM12 15.4L8.24 17.67L9.24 13.39L5.92 10.51L10.3 10.13L12 6.1L13.71 10.14L18.09 10.52L14.77 13.4L15.77 17.68L12 15.4Z">
                    </path>
                </svg>
            </symbol>
        </defs>
    </svg>
    <section class="recipe-detail row justify-content-between">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="text-column col-md-8 col-12 order-md-1 order-1">
            <!-- Upper Box -->
            <div class="upper-box mb-3">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-indicators">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($recipe->images as $image)
                            <button type="button" data-bs-target="#carouselExampleIndicators" @if($i == 0) class="active" @endif data-bs-slide-to="{{ $i++ }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @php
                            $j = 0;
                        @endphp
                        @foreach ($recipe->images as $image)
                            <div class="carousel-item @if($j++ == 0) active @endif">
                                <img src="@if ($image->path == 'public/img/card.jpg') {{ asset('img/card.jpg') }}
                                @else {{ asset('storage/' . str_replace('public', '', $image->path)) }} @endif" class="d-block w-100" alt="...">
                            </div>
                            @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                {{-- <div class="owl-carousel owl-theme">
                    @foreach ($recipe->images as $image)
                        <div class="item">
                            <figure class="image"><img
                                    src="@if ($recipe->images[0]->path == 'public/img/card.jpg') {{ asset('img/card.jpg') }}
                                @else {{ asset('storage/' . str_replace('public', '', $recipe->images[0]->path)) }} @endif"
                                    alt=""></figure>
                        </div>
                    @endforeach
                </div> --}}
            </div>
            <div class="inner-column mb-4">
                <h3 class="ps-3">List of ingredients :</h3>
                <hr>
                <ul class="ingredients-list ps-3">
                    @foreach ($recipe->ingredients as $ingredient)
                        <li class="ingredients-li">
                            <strong>{{ $ingredient->pivot->amount . $ingredient->pivot->unit }}</strong> of
                            {{ $ingredient->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="inner-column mb-4">
                <h3 class="ps-3">Steps :</h3>
                <hr>
                <ul class="ingredients-list ps-3">
                    @foreach ($recipe->instructions as $instruction)
                        <li class="ingredients-li">
                            <span>{{ $instruction->description }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="info-column col-md-4 col-12 order-md-2 order-3 ">
            <div class="inner-column mb-4">
                <h2>{{ $recipe->name }}</h2>
                <p>{{ $recipe->description }}</p>
                <ul class="recipe-info">
                    <li>
                        <span class="icon fa fa-user"></span>
                        <strong>Author</strong>
                        <p class="ps-3">{{ $recipe->user->name }}</p>
                    </li>
                    <li>
                        <span class="icon fa fa-clock"></span>
                        <strong>Preparation Time</strong>
                        <p class="ps-3">{{ $recipe->prep_time . ' minutes' }}</p>
                    </li>
                    <li>
                        <span class="icon bi bi-speedometer"></span>
                        <strong>Difficulty</strong>
                        <div class="ps-3">
                            @php
                                $full = $recipe->difficulty;
                                $empty = 5 - $full;
                                for ($i = 0; $i < $full; $i++) {
                                    echo '<svg class="icon icon-star"><use xlink:href="#icon-star"></use></svg>';
                                }
                                for ($i = 0; $i < $empty; $i++) {
                                    echo '<svg class="icon icon-star-empty"><use xlink:href="#icon-star-empty"></use></svg>';
                                }
                            @endphp
                        </div>
                    </li>
                    <hr>
                    <li>
                        <strong>Ratings :</strong>
                        <div class="">
                            @php
                                if (count($recipe->ratings) == 0) {
                                    $average = 0;
                                } else {
                                    $ratings = $recipe->ratings->pluck('rating_number')->toArray();
                                    $average = round(array_sum($ratings) / count($ratings), 1);
                                }
                            @endphp
                            <span
                                class="fs-7 lh-1 align-middle">{{ $average . ' (' . count($recipe->ratings) . ')' }}</span>
                            @php
                                $half = $average - floor($average);
                                if ($half >= 0.4) {
                                    $half = 1;
                                } else {
                                    $half = 0;
                                }
                                $full = floor($average);
                                $empty = round(5 - $full - $half);
                                for ($i = 0; $i < $full; $i++) {
                                    echo '<svg class="icon icon-star"><use xlink:href="#icon-star"></use></svg>';
                                }
                                if ($half) {
                                    echo '<svg class="icon icon-star-half"><use xlink:href="#icon-star-half"></use></svg>';
                                }
                                for ($i = 0; $i < $empty; $i++) {
                                    echo '<svg class="icon icon-star"><use xlink:href="#icon-star-empty"></use></svg>';
                                }
                            @endphp
                    </li>
                </ul>
                <hr>
                <div class="d-flex justify-content-center">

                    <a href="{{ route('app.recipes.edit', $recipe) }}" class="btn btn-primary me-2">Edit</a>
                    <form action="{{ route('app.recipes.destroy', $recipe) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            <div class="inner-column">
                <h2>Rate this recipe :</h2>
                @php
                    $rating = $recipe->ratings->where('user_id', Auth::id())->first();
                    $ratingNumber = $rating ? $rating->rating_number : 0;
                    // dd($rating);
                @endphp
                @if ($ratingNumber == 0)
                    <form action="{{ route('recipe.rate.store', $recipe) }}" method="POST">
                    @else
                        <form action="{{ route('recipe.rate.update', $rating) }}" method="POST">
                            @method('PUT')
                @endif
                @csrf
                <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column justify-content-center">
                        <input type="radio" name="rating_number" id="rating-1" value="1"
                            @if ($ratingNumber == 1) checked @endif>
                        <label for="rating-1" class="d-block">
                            <svg class="icon icon-star">
                                <use xlink:href="#icon-star"></use>
                            </svg>
                        </label>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <input type="radio" name="rating_number" id="rating-2" value="2"
                            @if ($ratingNumber == 2) checked @endif>
                        <label for="rating-2" class="d-block">
                            <svg class="icon icon-star">
                                <use xlink:href="#icon-star"></use>
                            </svg>
                        </label>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <input type="radio" name="rating_number" id="rating-3" value="3"
                            @if ($ratingNumber == 3) checked @endif>
                        <label for="rating-3" class="d-block">
                            <svg class="icon icon-star">
                                <use xlink:href="#icon-star"></use>
                            </svg>
                        </label>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <input type="radio" name="rating_number" id="rating-4" value="4"
                            @if ($ratingNumber == 4) checked @endif>
                        <label for="rating-4" class="d-block">
                            <svg class="icon icon-star">
                                <use xlink:href="#icon-star"></use>
                            </svg>
                        </label>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <input type="radio" name="rating_number" id="rating-5" value="5"
                            @if ($ratingNumber == 5) checked @endif>
                        <label for="rating-5" class="d-block">
                            <svg class="icon icon-star">
                                <use xlink:href="#icon-star"></use>
                            </svg>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="order-md-3 order-2">
            <div class="inner-column mb-md-0 mb-4">
                <h3>Comments :</h3>
                <hr>
                <div class="row flex-column gy-1 mb-3">
                    @foreach ($comments as $comment)
                        @auth
                            @php
                                $editable =
                                    auth()
                                        ->user()
                                        ->can('update all comments') ||
                                    (auth()
                                        ->user()
                                        ->can('update own comments') &&
                                        $comment->user()->is(auth()->user()));
                                $deletable =
                                    auth()
                                        ->user()
                                        ->can('delete all comments') ||
                                    (auth()
                                        ->user()
                                        ->can('delete own comments') &&
                                        $comment->user()->is(auth()->user()));
                            @endphp
                        @endauth
                        <div
                            class="comment rounded @auth @if ($editable || $deletable) d-flex justify-content-between pe-0 @endif @endauth">
                            @auth
                                @if ($editable || $deletable)
                                    <div>
                                @endif
                            @endauth
                            <div class="comment-header ps-1">
                                <div class="comment-author">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <span
                                        class="comment-date text-secondary d-none d-sm-inline">{{ $comment->created_at->toDayDateTimeString() }}
                                        @if ($comment->updated_at > $comment->created_at)
                                            <span>
                                                (edited : {{ $comment->updated_at->diffForHumans() }})
                                            </span>
                                        @endif
                                    </span>

                                    <span
                                        class="comment-date text-secondary d-inline d-sm-none">{{ $comment->created_at->diffForHumans() }}
                                        @if ($comment->updated_at > $comment->created_at)
                                            <span>
                                                (edited)
                                            </span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="comment-body">
                                <p class="comment-text ps-3 m-0">{{ $comment->content }}</p>
                            </div>
                            @auth
                                @if ($editable || $deletable)
                            </div>
                            <div class="dropdown pt-1 px-2">
                                <button class="border-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @if ($editable)
                                        <li>
                                            <button class="dropdown-item edit-comment"
                                                data-comment-id="{{ $comment->id }}">Edit</button>
                                        </li>
                                    @endif
                                    @if ($deletable)
                                        <li>
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">Delete</button>
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    @endauth
                </div>
                @endforeach
            </div>
            {{ $comments->links() }}
            <hr>
            <form class="d-flex flex-wrap flex-md-nowrap justify-content-md-between justify-content-end"
                action="{{ route('comments.store', $recipe) }}" method="POST">
                @csrf
                <input class="form-control mb-2 mb-md-0 me-0 me-md-2" type="text" name="content"
                    placeholder="Enter a comment" value="">
                <button class="btn btn-primary justify-self-end" type="submit">Send</button>
            </form>
        </div>
    </section>
@endsection
