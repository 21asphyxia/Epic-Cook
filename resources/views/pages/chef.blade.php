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

    <div class="row">
        <div id="profile-infos"
            class="col-md-4 card mb-4 d-flex flex-column align-items-center border border-1 rounded-1  pt-4">
            <img src="{{ $chef->image == 'default.jpg' ? asset('img/profile-img.jpg') : asset('storage/' . str_replace('public', '', $chef->image)) }}"
                alt="" class="rounded-circle" style="width: 150px">
            <div class="">
                <strong class="fs-4 text-dark">{{ $chef->name }}</strong>
                <span class="badge bg-primary ms-2">{{ $chef->job_title }}</span>
            </div>
            <div class="w-75 py-3">
                <hr>
                <div class="d-flex flex-wrap justify-content-between w-100 mb-1">
                    <span class="text-secondary"><i class="fa-solid fa-envelope myIcon pe-2"></i>Email:</span>
                    <span class="text-break">{{ $chef->email }}</span>
                </div>
                <div class="d-flex flex-wrap justify-content-between w-100 mb-1">
                    <span class=" text-secondary"><i class="fa-solid fa-user myIcon pe-2"></i>Member since:</span>
                    <span class="">{{ substr($chef->created_at, 0, 4) }}</span>
                </div>
                <div class="d-flex flex-wrap justify-content-between w-100">
                    <span class=" text-secondary"><i class="fa fa-utensils pe-2"></i>Number of recipes:</span>
                    <span class="">{{ $chef->recipes->count() }}</span>
                </div>
            </div>
        </div>

        <div id="profile-services" class="col-md-8">
            <h3>{{ $chef->name }}'s recipes</h3>
            @if ($chef->recipes->count() == 0)
                <p class="text-secondary">No recipes yet</p>
            @else
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-3">
                    @foreach ($chef->recipes as $recipe)
                        <a class="col" href="{{ route('app.recipes.show', $recipe) }}">
                            <div class="card">
                                <img class="card-img-top"
                                    src="@if ($recipe->images->first()->path == 'public/img/card.jpg') {{ asset('img/card.jpg') }}
            @else {{ asset('storage/' . str_replace('public', '', $recipe->images->first()->path)) }} @endif"
                                    alt="recipe image">
                                <div class="card-body">
                                    <h3 class="text-truncate">{{ $recipe->name }}</h3>
                                    <p class="multiline-truncate-2">{{ Str::limit($recipe->description, 100, '...') }}
                                    </p>
                                    <div>
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
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
