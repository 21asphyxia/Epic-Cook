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
                        @php
                            if (count($recipe->ratings) == 0) {
                                $average = 0;
                            } else {
                                $ratings = $recipe->ratings->pluck('rating_number')->toArray();
                                $average = round(array_sum($ratings) / count($ratings), 1);
                            }
                        @endphp
                        <tr>
                            <td class="text-center">{{ $recipe->id }}</td>
                            <td class="text-center">{{ $recipe->name }}</td>
                            <td class="text-center">{{ Str::limit($recipe->description, 30, '...') }}</td>
                            <td class="text-center">{{ $recipe->prep_time . ' min' }}</td>
                            <td class="text-center">{{ $recipe->difficulty . '/5' }}</td>
                            <td class="text-center">{{ $average }}</td>
                            <td class="text-center">
                                @if ($recipe->user)
                                    {{ $recipe->user->name }}
                                @else
                                    Deleted User
                                @endif
                            </td>
                            <td class="text-center"><a
                                    href="{{ route('admin.recipe.comments', $recipe) }}">{{ count($recipe->comments) }}</a>
                            </td>
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
