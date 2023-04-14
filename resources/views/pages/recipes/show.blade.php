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
                autoHeight: true,
                center: true,
                autoWidth: true,
                items: 1,
                loop: false,
                margin: 10,
                nav: true,
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
    <section class="recipe-detail">
        <div class="row justify-content-between">
            <div class="text-column col-lg-8 col-md-12 col-sm-12">
                <div class="">
                    <!-- Upper Box -->
                    <div class="upper-box">
                        <div class="owl-carousel owl-theme">
                            <figure class="image"><img src="{{ asset('img/card.jpg') }}" alt=""></figure>
                        </div>
                    </div>
                    <h1>{{ $recipe->name }}</h1>
                    <div class="inner-column mb-4">
                        <h3 class="ps-3">List of ingredients :</h3>
                        <hr>
                        <ul class="ingredients-list ps-3">
                            @foreach ($recipe->ingredients as $ingredient)
                                <li class="ingredients-li">
                                    <strong>{{ $ingredient->pivot->amount . $ingredient->pivot->unit }}</strong> of
                                    {{ $ingredient->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="inner-column">
                        <h3 class="ps-3">Steps :</h3>
                        <hr>
                        <ul class="ingredients-list ps-3">
                            @foreach ($recipe->instructions as $instruction)
                                <li class="ingredients-li">
                                    <span>{{ $instruction->step.". ".$instruction->description }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="info-column col-lg-4 col-md-12 col-sm-12">
                <div class="inner-column">
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
                                $ratings = $recipe->ratings->pluck('rating_number')->toArray();
                                $average = round(array_sum($ratings) / count($ratings), 1);
                            @endphp
                                <span class="fs-7 lh-1 align-middle">{{ $average.' ('.count($recipe->ratings).')'}}</span>
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
                </div>

            </div>
        </div>
    </section>
@endsection
