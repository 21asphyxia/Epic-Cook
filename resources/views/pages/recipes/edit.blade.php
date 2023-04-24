@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>Edit Your Recipe !</h2>
    <div class="form-group mb-1">
        <h5 for="image">Recipe Images</h5>
        @if ($recipe->images)
            <div class="m-auto overflow-x-scroll text-nowrap mb-3">
                @foreach ($recipe->images as $image)
                    <div class="d-inline-block m-2">
                        <img src="@if ($image->path == 'public/img/card.jpg') {{ asset('img/card.jpg') }} @else {{ asset('storage/' . str_replace('public', '', $image->path)) }} @endif"
                            alt="Recipe Image" class="img-fluid" width="200">
                        {{-- edit delete  --}}
                        <div class="d-flex justify-content-around mt-2">
                            <form action="{{ route('recipe.image.update', $image) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Set as main</button>
                            </form> 
                            <form action="{{ route('recipe.image.destroy', $image) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <form action="{{ route('app.recipes.update', $recipe) }}" method="POST" enctype='multipart/form-data'>
        @method('PUT')
        @csrf
        <h6 for="image">Add Images :</h6>
        <input type="file" multiple class="form-control" name="images[]" id="image" placeholder=""
            aria-describedby="fileHelpId">
        <hr>
        <div class="form-group mb-1">
            <h5 for="name">Recipe Name</h5>
            <input type="text" name="name" id="name" class="form-control" placeholder="Recipe Name"
                aria-describedby="helpId" value="{{ $recipe->name ?? old('name') }}">
        </div>
        <hr>
        <div class="form-group mb-1">
            <h5 for="description">Recipe Description</h5>
            <textarea class="form-control" name="description" id="description" rows="3">{{ $recipe->description ?? old('description') }}</textarea>
        </div>
        <hr>
        <div class="d-flex justify-content-around">
            <div>
                <h5 class="align-self-start">Recipe Time</h5>
                <div class="input-group">
                    <input type="number" name="prep_time" id="prep_time" class="form-control w-auto"
                        placeholder="Prep Time" value="{{ $recipe->prep_time ?? old('prep_time') }}">
                    <span class="input-group-text">min</span>
                </div>
            </div>
            <div>
                <h5 class="align-self-start">Recipe Difficulty</h5>
                <div class="d-flex flex-column align-items-center">
                    <input type="range" class="form-range" name="difficulty" id="difficulty" min="1" max="5"
                        step="1" value="{{ $recipe->difficulty ?? old('difficulty') }}">
                    <span id="difficulty-filter" class="d-block">1/5</span>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group d-flex flex-column align-items-center">
            <h5 class="align-self-start">Recipe Ingredients</h5>
            @php
                // dd($recipe->ingredients);
                $i = 0;
            @endphp
            @foreach ($recipe->ingredients as $ingredient)
                @php
                    $i++;
                @endphp
                <div id="ingredient-group" class="input-group flex-nowrap mb-1">
                    <input id="ingredients-quantity" type="number" name="ingredients_amounts[]"
                        class="input-group-text bg-white" placeholder="Quantity" value="{{ $ingredient->pivot->amount }}">
                    <select id="ingredients-units" name="ingredients_units[]" class="form-select form-select-sm  w-auto"
                        placeholder="Unit">
                        <option value="mg" @if ($ingredient->pivot->unit == 'mg') selected @endif>mg</option>
                        <option value="g" @if ($ingredient->pivot->unit == 'g') selected @endif>g</option>
                        <option value="kg" @if ($ingredient->pivot->unit == 'kg') selected @endif>kg</option>
                        <option value="ml" @if ($ingredient->pivot->unit == 'ml') selected @endif>ml</option>
                        <option value="l" @if ($ingredient->pivot->unit == 'l') selected @endif>l</option>
                        <option value="tsp" @if ($ingredient->pivot->unit == 'tsp') selected @endif>tsp</option>
                        <option value="p" @if ($ingredient->pivot->unit == 'p') selected @endif>p</option>
                        <option value="other" @if ($ingredient->pivot->unit == 'other') selected @endif>other</option>
                    </select>
                    <select id="ingredients-select-{{ $i }}" name="ingredients[]"
                        class="form-select form-select-sm ingredient-select" placeholder="Ingredient">
                        @foreach ($allIngredients as $singleIngredient)
                            <option value="{{ $singleIngredient->id }}" @if ($singleIngredient->id == $ingredient->id) selected @endif>
                                {{ $singleIngredient->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <button id="add-ingredient" class="btn btn-primary rounded-pill" type="button"><i
                    class="bi bi-plus"></i></button>
        </div>
        <hr>
        <div class="form-group d-flex flex-column align-items-center mb-1">
            <h5 class="align-self-start">Recipe Instructions</h5>
            @foreach ($recipe->instructions as $instruction)
                <div id="instruction-group" class="input-group flex-nowrap mb-1">
                    <input type="text" class="form-control mb-1" name="instructions[]" id="instructions"
                        value="{{ $instruction->description ?? old('instructions') }}">
                </div>
            @endforeach
            <button id="add-instruction" class="btn btn-primary rounded-pill" type="button"><i
                    class="bi bi-plus"></i></button>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection

@section('additionalJS')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const value = document.querySelector("#difficulty-filter")
        const input = document.querySelector("#difficulty")
        value.textContent = input.value + "/5"
        input.addEventListener("input", (event) => {
            value.textContent = event.target.value + "/5"
        })

        $(document).ready(function() {
            let html = $('#ingredient-group').html();
            let ingredientCount = $('[id^="ingredients-select-"]').length;
            for (let i = 1; i <= ingredientCount; i++) {
                $('#ingredients-select-' + i).select2({
                    theme: "bootstrap-5",
                    tags: true,
                });
            }

            $('#add-ingredient').click(function() {
                ingredientCount++;
                let newIngredient = $('<div id="ingredient-group" class="input-group flex-nowrap mb-1">')
                    .append(html.replace(/ingredients-select-1/g, 'ingredients-select-' + ingredientCount));
                $(this).before(newIngredient);
                newIngredient.find('#ingredients-select-' + ingredientCount).select2({
                    theme: "bootstrap-5",
                    tags: true,
                });
            });

            $('#add-instruction').click(function() {
                let newInstruction = $(
                    '<input type="text" class="form-control mb-1" name="instructions[]" id="instructions">'
                );
                $(this).before(newInstruction);
            });
        });
    </script>
@endsection

@section('additionalCSS')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />
@endsection
