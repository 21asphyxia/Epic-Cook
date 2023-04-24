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
    <h2>Create Your Recipe !</h2>
    <form action="{{ route('app.recipes.store') }}" method="POST" enctype='multipart/form-data'>
        @csrf
        <div class="form-group mb-1">
            <label for="name">Recipe Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Recipe Name"
                aria-describedby="helpId" value="{{ old('name') }}">
        </div>
        <hr>
        <div class="form-group mb-1">
            <label for="description">Recipe Description</label>
            <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
        </div>
        <hr>
        <div class="d-flex justify-content-around">
            <div>
                <label class="align-self-start">Recipe Time</label>
                <div class="input-group">
                    <input type="number" name="prep_time" id="prep_time" class="form-control w-auto"
                        placeholder="Prep Time" value="{{ old('prep_time') }}">
                    <span class="input-group-text">min</span>
                </div>
            </div>
            <div>
                <label class="align-self-start">Recipe Difficulty</label>
                <div class="d-flex flex-column align-items-center">
                    <input type="range" class="form-range" name="difficulty" id="difficulty" min="1" max="5"
                        step="1" value="{{ old('difficulty') ?? 1 }}">
                    <span id="difficulty-filter" class="d-block">1/5</span>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group d-flex flex-column align-items-center">
            <label class="align-self-start">Recipe Ingredients</label>
            <div id="ingredient-group" class="input-group flex-nowrap mb-1">
                <input id="ingredients-quantity" type="number" name="ingredients_amounts[]"
                    class="input-group-text bg-white" placeholder="Quantity">
                <select id="ingredients-units" name="ingredients_units[]" class="form-select form-select-sm  w-auto"
                    placeholder="Unit">
                    <option value="mg">mg</option>
                    <option value="g">g</option>
                    <option value="kg">kg</option>
                    <option value="ml">ml</option>
                    <option value="l">l</option>
                    <option value="tsp">teaspoon</option>
                    <option value="p">pieces</option>
                    <option value="other">other</option>
                </select>
                <select id="ingredients-select-1" name="ingredients[]" class="form-select form-select-sm ingredient-select"
                    placeholder="Ingredient">
                    @foreach ($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
            </div>
            <button id="add-ingredient" class="btn btn-primary rounded-pill" type="button"><i
                    class="bi bi-plus"></i></button>
        </div>
        <hr>
        <div class="form-group d-flex flex-column align-items-center mb-1">
            <label class="align-self-start">Recipe Instructions</label>
            <input type="text" class="form-control mb-1" name="instructions[]" id="instructions"></input>
            <button id="add-instruction" class="btn btn-primary rounded-pill" type="button"><i
                    class="bi bi-plus"></i></button>
        </div>
        <hr>
        <div class="form-group">
            <label for="image">Recipe Image</label>
            <input type="file" multiple class="form-control" name="images[]" id="image" placeholder=""
                aria-describedby="fileHelpId">
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">Submit</button>
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
            let ingredientCount = 1;
            $('#ingredients-select-' + ingredientCount).select2({
                theme: "bootstrap-5",
                tags: true,
            });

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
