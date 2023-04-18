@extends('layouts.app')

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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Recipes</h1>
                <div class="row flex-nowrap justify-content-end">
                    <button class="btn btn-primary w-auto me-2" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasExample"><i class="bi bi-filter"></i> Filter</button>
                    <a href="{{ route('app.recipes.create') }}" class="btn btn-primary w-auto">Create Recipe</a>
                </div>
                <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                    id="offcanvasExample" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Filter :</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="offcanvas-body">
                        <form action="{{ route('app.recipes') }}" method="GET">
                            <div class="mb-3">
                                <h6 for="rating" class="form-label">Rating :</h6>
                                <div class="d-flex justify-content-around">
                                    <small class="d-block">Minimum rating :</small>
                                    <div class="d-flex justify-content-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <input type="radio" name="min_rating" id="min_rating-1" value="1" @if (request()->min_rating == 1) checked @endif>
                                            <label for="min_rating-1" class="d-block">
                                                <svg class="icon icon-star">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <input type="radio" name="min_rating" id="min_rating-2" value="2" @if (request()->min_rating == 2) checked @endif>
                                            <label for="min_rating-2" class="d-block">
                                                <svg class="icon icon-star">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <input type="radio" name="min_rating" id="min_rating-3" value="3" @if (request()->min_rating == 3) checked @endif>
                                            <label for="min_rating-3" class="d-block">
                                                <svg class="icon icon-star">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <input type="radio" name="min_rating" id="min_rating-4" value="4" @if (request()->min_rating == 4) checked @endif>
                                            <label for="min_rating-4" class="d-block">
                                                <svg class="icon icon-star">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <input type="radio" name="min_rating" id="min_rating-5" value="5" @if (request()->min_rating == 5) checked @endif>
                                            <label for="min_rating-5" class="d-block">
                                                <svg class="icon icon-star">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <small class="d-block">Maximum rating :</small>
                                    <div class="d-flex justify-content-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <input type="radio" name="max_rating" id="rating-1" value="1" @if (request()->max_rating == 1) checked @endif>
                                            <label for="rating-1" class="d-block">
                                                <svg class="icon icon-star">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <input type="radio" name="max_rating" id="rating-2" value="2" @if (request()->max_rating == 2) checked @endif>
                                            <label for="rating-2" class="d-block">
                                                <svg class="icon icon-star">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <input type="radio" name="max_rating" id="rating-3" value="3" @if (request()->max_rating == 3) checked @endif>
                                            <label for="rating-3" class="d-block">
                                                <svg class="icon icon-star">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <input type="radio" name="max_rating" id="rating-4" value="4" @if (request()->max_rating == 4) checked @endif>
                                            <label for="rating-4" class="d-block">
                                                <svg class="icon icon-star">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <input type="radio" name="max_rating" id="rating-5" value="5" @if (request()->max_rating == 5) checked @endif>
                                            <label for="rating-5" class="d-block">
                                                <svg class="icon icon-star">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="mb-3 d-flex flex-column align-items-center">
                                <label for="difficulty" class="form-label">Maximum Difficulty :</label>
                                <input type="range" class="form-range" name="difficulty" id="difficulty"
                                    min="1" max="5" step="1" value="{{ request()->difficulty ?? 5 }}">
                                <span id="difficulty-filter" class="d-block">5/5</span>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </form>
                    </div>
                </div>

                <hr>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                    @foreach ($recipes as $recipe)
                        <a class="col" href="{{ route('app.recipes.show', $recipe) }}">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('img/card.jpg') }}" alt="recipe image">
                                <div class="card-body">
                                    <h3 class="text-truncate">{{ $recipe->name }}</h3>
                                    <p class="multiline-truncate-2">{{ Str::limit($recipe->description, 100, '...') }}
                                    </p>
                                    <div>
                                        @php
                                            $ratings = $recipe->ratings->pluck('rating_number')->toArray();
                                            $average = round(array_sum($ratings) / count($ratings), 1);
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
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        {{ $recipes->links() }}
    </div>
    </div>
@endsection

@section('additionalJS')
    <script>
        const value = document.querySelector("#difficulty-filter")
        const input = document.querySelector("#difficulty")
        value.textContent = input.value + "/5"
        input.addEventListener("input", (event) => {
            value.textContent = event.target.value + "/5"
        })
    </script>
@endsection
