<div>
    <div class="row flex-wrap justify-content-end">
        <div class="col-md-4 order-3 order-md-1 px-0 pe-md-3">
            <input type="text" class="form-control" name="search" placeholder="Search" wire:model="search">
        </div>
        <button class="btn btn-primary w-auto me-2 order-1 order-md-2 mb-3 mb-md-0" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasExample"><i class="bi bi-filter"></i> Filter</button>
        <a href="{{ route('app.recipes.create') }}"
            class="btn btn-primary w-auto order-2 order-md-3 mb-3 mb-md-0">Create Recipe</a>
    </div>
    <div wire:ignore>

        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
            id="offcanvasExample" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Filter :</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <hr>

            <div class="offcanvas-body">
                <div class="mb-3">
                    <h6 for="rating" class="form-label">Rating :</h6>
                    <div class="d-flex justify-content-around">
                        <small class="d-block">Minimum rating :</small>
                        <div class="d-flex justify-content-center">
                            <div class="d-flex flex-column justify-content-center">
                                <input type="radio" name="min_rating" id="min_rating-1" wire:model="minRating"
                                    value="1">
                                <label for="min_rating-1" class="d-block">
                                    <svg class="icon icon-star">
                                        <use xlink:href="#icon-star"></use>
                                    </svg>
                                </label>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <input type="radio" name="min_rating" id="min_rating-2" wire:model="minRating"
                                    value="2">
                                <label for="min_rating-2" class="d-block">
                                    <svg class="icon icon-star">
                                        <use xlink:href="#icon-star"></use>
                                    </svg>
                                </label>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <input type="radio" name="min_rating" id="min_rating-3" wire:model="minRating"
                                    value="3">
                                <label for="min_rating-3" class="d-block">
                                    <svg class="icon icon-star">
                                        <use xlink:href="#icon-star"></use>
                                    </svg>
                                </label>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <input type="radio" name="min_rating" id="min_rating-4" wire:model="minRating"
                                    value="4">
                                <label for="min_rating-4" class="d-block">
                                    <svg class="icon icon-star">
                                        <use xlink:href="#icon-star"></use>
                                    </svg>
                                </label>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <input type="radio" name="min_rating" id="min_rating-5" wire:model="minRating"
                                    value="5">
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
                                <input type="radio" name="max_rating" id="rating-1" wire:model="maxRating"
                                    value="1">
                                <label for="rating-1" class="d-block">
                                    <svg class="icon icon-star">
                                        <use xlink:href="#icon-star"></use>
                                    </svg>
                                </label>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <input type="radio" name="max_rating" id="rating-2" wire:model="maxRating"
                                    value="2">
                                <label for="rating-2" class="d-block">
                                    <svg class="icon icon-star">
                                        <use xlink:href="#icon-star"></use>
                                    </svg>
                                </label>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <input type="radio" name="max_rating" id="rating-3" wire:model="maxRating"
                                    value="3">
                                <label for="rating-3" class="d-block">
                                    <svg class="icon icon-star">
                                        <use xlink:href="#icon-star"></use>
                                    </svg>
                                </label>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <input type="radio" name="max_rating" id="rating-4" wire:model="maxRating"
                                    value="4">
                                <label for="rating-4" class="d-block">
                                    <svg class="icon icon-star">
                                        <use xlink:href="#icon-star"></use>
                                    </svg>
                                </label>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <input type="radio" name="max_rating" id="rating-5" wire:model="maxRating"
                                    value="5">
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
                    <input type="range" class="form-range" name="difficulty" wire:model="difficulty"
                        id="difficulty" min="1" max="5" step="1" >
                    <span id="difficulty-filter" class="d-block">/5</span>
                </div>
            </div>
        </div>
    </div>

        <hr>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4 mb-3">
            @foreach ($recipes as $recipe)
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
        {{ $recipes->links() }}
    </div>
