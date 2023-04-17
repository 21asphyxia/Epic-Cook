@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Recipes</h1>
                <a href="{{ route('app.recipes.create') }}" class="btn btn-primary">Create Recipe</a>
                
                {{-- <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recipes as $recipe)
                            <tr>
                                <td>{{ $recipe->name }}</td>
                                <td>
                                    <a href="{{ route('app.recipes.show', $recipe->id) }}" class="btn btn-primary">View</a>
                                    <a href="{{ route('app.recipes.edit', $recipe->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('app.recipes.destroy', $recipe->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
@endsection