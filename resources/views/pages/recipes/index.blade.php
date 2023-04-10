@extends('layouts.admin')

@section('content')
<h1>Recipes</h1>
<table>
    <thead>
        <tr>
            <td class="text-center">Image</td>
            <td class="text-center">Name</td>
            <td class="text-center">Description</td>
            <td class="text-center">Time</td>
            <td class="text-center">Difficulty</td>
            <td class="text-center">Average Rating</td>
            <td class="text-center">Author</td>
            <td class="text-center">N° of Comments</td>
            <td class="text-center">Operations</td>
        </tr>
    </thead>

    <tbody>
        @foreach ($recipes as $recipe)
        <tr>
            <td class="text-center">XX</td>
            <td class="text-center">{{ $recipe->name }}</td>
            <td class="text-center">{{ $recipe->description }}</td>
            <td class="text-center">{{ $recipe->prep_time }}</td>
            <td class="text-center">{{ $recipe->difficulty }}</td>
            <td class="text-center">5</td>
            <td class="text-center">{{ $recipe->user->name }}</td>
            <td class="text-center">20</td>
            <td class="text-center">
                <a id="edit-button" href="#" data-bs-toggle="modal"><ion-icon name="create-outline"></ion-icon></a>
                <form class="d-inline" method="POST" action="{{ route('admin.recipes.destroy', $recipe) }}">
                    @csrf
                    @method('DELETE')
                    <button class="unstyled" type="submit"><ion-icon name="trash-outline"></ion-icon></button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection