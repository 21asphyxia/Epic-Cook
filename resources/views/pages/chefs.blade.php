@extends('layouts.app')

@section('content')
    <h1>Our Chefs</h1>
<hr>
    <div class="row row-cols-1 row-cols-md-3 justify-content-around">
        @foreach ($chefs as $chef)
        {{-- <a> --}}
            <a href="{{ route('app.chefs.show', $chef) }}" class="position-relative w-auto m-auto mb-5">
                <img src="{{ asset('img/banner.png') }}" alt="" class="w-100 honor">
                <img src="{{ ($chef->image == "default.jpg") ? asset('img/profile-img.jpg') : asset('storage/' . str_replace('public', '', $chef->image))
            }}" class="position-absolute chef-image rounded-circle">
            <div class="position-absolute chef-name">
                <p class="size-set">{{ $chef->name }}</p>
                <p>Certified Chef</p>
            </div>
            </a>
        {{-- </a> --}}
        @endforeach

    </div>
@endsection