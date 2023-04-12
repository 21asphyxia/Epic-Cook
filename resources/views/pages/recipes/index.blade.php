@extends('layouts.admin')

@section('content')
    <h1>Recipes</h1>
    {{-- success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body" style="overflow: auto">
            <table id="table" class="table">
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
                        <td class="text-center"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recipes as $recipe)
                        <tr>
                            <td class="text-center">{{ $recipe->id }}</td>
                            <td class="text-center">{{ $recipe->name }}</td>
                            <td class="text-center">{{ Str::limit($recipe->description, 30, '...') }}</td>
                            <td class="text-center">{{ $recipe->prep_time." min" }}</td>
                            <td class="text-center">{{ $recipe->difficulty."/5" }}</td>
                            <td class="text-center">5</td>
                            <td class="text-center">{{ $recipe->user->name }}</td>
                            <td class="text-center">20</td>
                            <td class="text-center">
                                <form class="d-inline" method="POST"
                                    action="{{ route('admin.recipes.destroy', $recipe) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="unstyled" type="submit"><i class="text-danger bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>    
            </table>
        </div>
    </div>
    {{ $recipes->links() }}
@endsection