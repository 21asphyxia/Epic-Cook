@extends('layouts.app')
@section('content')

    <section class="font-sans text-gray-900 antialiased">
        <div class="bg-[#F4F7FF] flex items-center py-20 lg:py-[120px] h-screen">
            <div class="container mx-auto">
                <div class="-mx-4 flex flex-wrap">
                    <div class="w-full px-4">
                        <div
                            class="relative mx-auto max-w-[525px] overflow-hidden rounded-lg bg-white py-16 px-10 text-center sm:px-12 md:px-[60px]">
                            <div class="mb-10 text-center md:mb-16">
                                <a href="javascript:void(0)" class="mx-auto inline-block max-w-[70%]">
                                    <span id="LRlogo" class="text-black w-100">EPIC COOK</span>
                                </a>
                            </div>
                            <form method="POST" action="{{ route('login.page') }}">
                                @csrf
                                <x-input-error :messages="$errors->all()" />
                                <div class="mb-6">
                                    <input type="email" name="email" placeholder="Email"
                                        class="border-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none focus:border-blue-400 focus-visible:shadow-none"
                                        value="" required autofocus>
                                </div>
                                <div class="mb-6">
                                    <input type="password" placeholder="Password"
                                        class="bordder-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none focus:border-blue-400 focus-visible:shadow-none"
                                        name="password" required="" autocomplete="current-password">
                                </div>
                                <div class="flex my-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            name="remember">
                                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                                    </label>
                                </div>
                                <div class="mb-10">
                                    <input type="submit" value="Sign In"
                                        class="w-full cursor-pointer rounded-md border bg-green-500 py-3 px-5 text-base text-white transition hover:bg-opacity-90">
                                </div>
                            </form>
                            <a class="mb-2 inline-block text-base text-blue-600 hover:text-blue-400 hover:underline"
                                href="{{ route('forgot.password') }}">
                                Forgot your password?
                            </a>
                            <p class="text-base text-[#adadad]">
                                Not a member yet?
                                <a class="text-blue-600 hover:text-blue-400 hover:underline"
                                    href="{{ route('register.page') }}">
                                    Sign Up
                                </a>
                            </p>
                            <div>
                                <span class="absolute top-1 right-1">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="1.39737" cy="38.6026" r="1.39737"
                                            transform="rotate(-90 1.39737 38.6026)" fill="green"></circle>
                                        <circle cx="1.39737" cy="1.99122" r="1.39737"
                                            transform="rotate(-90 1.39737 1.99122)" fill="green"></circle>
                                        <circle cx="13.6943" cy="38.6026" r="1.39737"
                                            transform="rotate(-90 13.6943 38.6026)" fill="green"></circle>
                                        <circle cx="13.6943" cy="1.99122" r="1.39737"
                                            transform="rotate(-90 13.6943 1.99122)" fill="green"></circle>
                                        <circle cx="25.9911" cy="38.6026" r="1.39737"
                                            transform="rotate(-90 25.9911 38.6026)" fill="green"></circle>
                                        <circle cx="25.9911" cy="1.99122" r="1.39737"
                                            transform="rotate(-90 25.9911 1.99122)" fill="green"></circle>
                                        <circle cx="38.288" cy="38.6026" r="1.39737"
                                            transform="rotate(-90 38.288 38.6026)" fill="green"></circle>
                                        <circle cx="38.288" cy="1.99122" r="1.39737"
                                            transform="rotate(-90 38.288 1.99122)" fill="green"></circle>
                                        <circle cx="1.39737" cy="26.3057" r="1.39737"
                                            transform="rotate(-90 1.39737 26.3057)" fill="green"></circle>
                                        <circle cx="13.6943" cy="26.3057" r="1.39737"
                                            transform="rotate(-90 13.6943 26.3057)" fill="green"></circle>
                                        <circle cx="25.9911" cy="26.3057" r="1.39737"
                                            transform="rotate(-90 25.9911 26.3057)" fill="green"></circle>
                                        <circle cx="38.288" cy="26.3057" r="1.39737"
                                            transform="rotate(-90 38.288 26.3057)" fill="green"></circle>
                                        <circle cx="1.39737" cy="14.0086" r="1.39737"
                                            transform="rotate(-90 1.39737 14.0086)" fill="green"></circle>
                                        <circle cx="13.6943" cy="14.0086" r="1.39737"
                                            transform="rotate(-90 13.6943 14.0086)" fill="green"></circle>
                                        <circle cx="25.9911" cy="14.0086" r="1.39737"
                                            transform="rotate(-90 25.9911 14.0086)" fill="green"></circle>
                                        <circle cx="38.288" cy="14.0086" r="1.39737"
                                            transform="rotate(-90 38.288 14.0086)" fill="green"></circle>
                                    </svg>
                                </span>
                                <span class="absolute left-1 bottom-1">
                                    <svg width="29" height="40" viewBox="0 0 29 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="2.288" cy="25.9912" r="1.39737"
                                            transform="rotate(-90 2.288 25.9912)" fill="green"></circle>
                                        <circle cx="14.5849" cy="25.9911" r="1.39737"
                                            transform="rotate(-90 14.5849 25.9911)" fill="green"></circle>
                                        <circle cx="26.7216" cy="25.9911" r="1.39737"
                                            transform="rotate(-90 26.7216 25.9911)" fill="green"></circle>
                                        <circle cx="2.288" cy="13.6944" r="1.39737"
                                            transform="rotate(-90 2.288 13.6944)" fill="green"></circle>
                                        <circle cx="14.5849" cy="13.6943" r="1.39737"
                                            transform="rotate(-90 14.5849 13.6943)" fill="green"></circle>
                                        <circle cx="26.7216" cy="13.6943" r="1.39737"
                                            transform="rotate(-90 26.7216 13.6943)" fill="green"></circle>
                                        <circle cx="2.288" cy="38.0087" r="1.39737"
                                            transform="rotate(-90 2.288 38.0087)" fill="green"></circle>
                                        <circle cx="2.288" cy="1.39739" r="1.39737"
                                            transform="rotate(-90 2.288 1.39739)" fill="green"></circle>
                                        <circle cx="14.5849" cy="38.0089" r="1.39737"
                                            transform="rotate(-90 14.5849 38.0089)" fill="green"></circle>
                                        <circle cx="26.7216" cy="38.0089" r="1.39737"
                                            transform="rotate(-90 26.7216 38.0089)" fill="green"></circle>
                                        <circle cx="14.5849" cy="1.39761" r="1.39737"
                                            transform="rotate(-90 14.5849 1.39761)" fill="green"></circle>
                                        <circle cx="26.7216" cy="1.39761" r="1.39737"
                                            transform="rotate(-90 26.7216 1.39761)" fill="green"></circle>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @stop
