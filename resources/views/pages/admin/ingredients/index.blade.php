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
                        <td class="text-center">ID</td>
                        <td class="text-center">Name</td>
                        <td class="text-center">N° of recipes included in</td>
                        <td class="text-center"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $ingredient)
                        <tr>
                            <td class="text-center">{{ $ingredient->id }}</td>
                            <td class="text-center">{{ $ingredient->name }}</td>
                            <td class="text-center">{{ $ingredient->recipes->count() }}</td>
                            <td class="text-center">
                                <form class="d-inline" method="POST"
                                    action="{{ route('admin.ingredients.destroy', $ingredient) }}">
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
    {{ $ingredients->links() }}
@endsection