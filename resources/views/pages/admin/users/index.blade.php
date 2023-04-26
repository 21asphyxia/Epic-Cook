@extends('layouts.admin')

@section('content')
    <h1>Recipes</h1>
    {{-- success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @livewire('show-users')
@endsection