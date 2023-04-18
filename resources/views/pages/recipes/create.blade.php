@extends('layouts.app')

@section('content')
    <h2>Create Your Recipe !</h2>
    <form action="{{ route('app.recipes.store') }}" method="POST">
        @csrf
        <div class="form-group mb-1">
            <label for="name">Recipe Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Recipe Name"
                aria-describedby="helpId">
        </div>
        <div class="form-group mb-1">
            <label for="description">Recipe Description</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
        </div>
        <div class="form-group d-flex flex-column align-items-center">
            <label class="align-self-start">Recipe Ingredients</label>
            <div id="ingredient-group" class="input-group flex-nowrap mb-1">
                <input id="ingredients-quantity" type="number" name="ingredients_quantities[]"
                    class="input-group-text bg-white" placeholder="Quantity">
                <select id="ingredients-units" name="ingredients_units[]" class="form-select form-select-sm  w-auto"
                    placeholder="Unit">
                    <option value="g">g</option>
                    <option value="kg">kg</option>
                    <option value="ml">ml</option>
                    <option value="l">l</option>
                    <option value="tsp">tsp</option>
                    <option value="tbsp">tbsp</option>
                    <option value="cup">cup</option>
                    <option value="oz">oz</option>
                    <option value="lb">lb</option>
                    <option value="whole">whole</option>
                </select>
                <select id="ingredients-select" name="ingredients[]" class="form-select form-select-sm"
                    placeholder="Ingredient">
                    @foreach ($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
            </div>
            <button id="add-ingredient" class="btn btn-primary rounded-pill" type="button"><i class="bi bi-plus"></i></button>
        </div>
        <div class="form-group mb-1">
            <label>Recipe Instructions</label>
            <input type="text" class="form-control" name="instruction" id="instructions"></input>
            <button id="add-instruction" class="btn btn-primary rounded-pill" type="button"><i class="bi bi-plus"></i></button>
        </div>
        <div class="form-group">
            <label for="image">Recipe Image</label>
            <input type="file" class="form-control-file" name="image" id="image" placeholder=""
                aria-describedby="fileHelpId">
            <small id="fileHelpId" class="form-text text-muted">Help text</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('additionalJS')
    <script>
        $(document).ready(function() {
            duplicateIngredient = $('#ingredient-group').clone();
            duplicate
            $('#add-ingredient').click(function() {
                $('#add-ingredient').before(duplicateIngredient.clone());
            });
        });
    </script>
@endsection