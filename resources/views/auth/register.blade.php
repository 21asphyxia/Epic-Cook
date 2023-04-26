@extends('layouts.app')
@section('content')
    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
        <div id="LRcard" class="card mb-3">

            <div class="card-body">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="col-12">
                        <label for="Name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <input type="text" id="name" name="name" placeholder="Name"class="form-control"
                                required value="{{ old('name') }}" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="email" name="email" placeholder="Email" class="form-control" required
                                value="{{ old('email') }}" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="yourPassword" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="yourPassword"
                            required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>
                    <div class="col-12 mt-3">
                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                        <p class="small mb-0">Already have an account? <a class="text-primary" href="{{ route('login.page') }}">Log in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
