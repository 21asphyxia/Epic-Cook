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
    <section class="recipe-detail">
        <div class="row justify-content-between">
            <div class="text-column col-lg-8 col-md-12 col-sm-12">
                <div class="inner-column">
                    <!-- Upper Box -->
                    <div class="upper-box">
                        <div class="owl-carousel owl-theme">
                            <figure class="image"><img src="{{ asset('img/card.jpg') }}" alt=""></figure>
                        </div>
                    </div>
                    <h1>{{ $recipe->name }}</h1>
                    <div class="inner-column">
                        <h3>List of ingredients :</h3>
                        <ul>
                            @foreach ($recipe->ingredients as $ingredient)
                                <li><strong>{{ $ingredient->pivot->amount.$ingredient->pivot->unit}}</strong> of {{ $ingredient->name }}</li>
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
                            <p>{{ $recipe->user->name }}</p>
                        </li>
                        <li>
                            <span class="icon fa fa-clock"></span>
                            <strong>Preparation Time</strong>
                            <p>{{ $recipe->prep_time." minutes" }}</p>
                        </li>
                        <li>
                            <span class="icon fa fa-star"></span>
                            <strong>Difficulty</strong>
                            <p>{{ $recipe->difficulty }}</p>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
    </section>
@endsection
