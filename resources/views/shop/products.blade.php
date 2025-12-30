@extends('layouts.app')

@section('header')
{{-- Centered Search Box --}}
@auth
<form action="{{ route('global.search') }}" method="GET" class="flex gap-2">
    <input type="text" name="search" placeholder="Search ..." value="{{ request('search') }}"
        class="border px-4 py-2 rounded w-full">
    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
        Search
    </button>
</form>
@endauth
@endsection

@section('content')



<div class="py-8 max-w-7xl mx-auto px-6">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-900 mb-6">
        Products
    </h1>


    {{-- Featured Products Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">


        {{-- Product 1 --}}
        <div
            class="group bg-gray-100 rounded-lg shadow hover:shadow-2xl transition transform hover:-translate-y-2 flex flex-col overflow-hidden">
            <img src="{{ asset('images/product1.jpg') }}"
                class="w-full h-48 object-cover border-4 border-black rounded transition-transform duration-500 group-hover:scale-105">
            <div class="p-4 flex flex-col flex-grow">
                <h3 class="mt-3 font-semibold text-xl text-gray-900">Headphones</h3>
                <p class="mt-2 font-bold text-green-700">$150</p>
                <form action="{{ route('cart.add', 1) }}" method="POST" class="mt-auto">
                    @csrf
                    <button type="submit"
                        class="mt-4 w-full bg-indigo-600 hover:bg-indigo-800 text-white font-semibold py-2 rounded transition-all duration-300 hover:scale-105">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>

        {{-- Product 2 --}}
        <div
            class="group bg-gray-100 rounded-lg shadow hover:shadow-2xl transition transform hover:-translate-y-2 flex flex-col overflow-hidden">
            <img src="{{ asset('images/product2.png') }}"
                class="w-full h-48 object-cover border-4 border-black rounded transition-transform duration-500 group-hover:scale-105">
            <div class="p-4 flex flex-col flex-grow">
                <h3 class="mt-3 font-semibold text-xl text-gray-900">Laptops</h3>
                <p class="mt-2 font-bold text-green-700">$1,200</p>
                <form action="{{ route('cart.add', 2) }}" method="POST" class="mt-auto">
                    @csrf
                    <button type="submit"
                        class="mt-4 w-full bg-indigo-600 hover:bg-indigo-800 text-white font-semibold py-2 rounded transition-all duration-300 hover:scale-105">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>

        {{-- Product 3 --}}
        <div
            class="group bg-gray-100 rounded-lg shadow hover:shadow-2xl transition transform hover:-translate-y-2 flex flex-col overflow-hidden">
            <img src="{{ asset('images/product3.png') }}"
                class="w-full h-48 object-cover border-4 border-black rounded transition-transform duration-500 group-hover:scale-105">
            <div class="p-4 flex flex-col flex-grow">
                <h3 class="mt-3 font-semibold text-xl text-gray-900">Smartphones</h3>
                <p class="mt-2 font-bold text-green-700">$800</p>
                <form action="{{ route('cart.add', 3) }}" method="POST" class="mt-auto">
                    @csrf
                    <button type="submit"
                        class="mt-4 w-full bg-indigo-600 hover:bg-indigo-800 text-white font-semibold py-2 rounded transition-all duration-300 hover:scale-105">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>

        {{-- Product 4 --}}
        <div
            class="group bg-gray-100 rounded-lg shadow hover:shadow-2xl transition transform hover:-translate-y-2 flex flex-col overflow-hidden">
            <img src="{{ asset('images/product4.png') }}"
                class="w-full h-48 object-cover border-4 border-black rounded transition-transform duration-500 group-hover:scale-105">
            <div class="p-4 flex flex-col flex-grow">
                <h3 class="mt-3 font-semibold text-xl text-gray-900">Gaming PC</h3>
                <p class="mt-2 font-bold text-green-700">$2,000</p>
                <form action="{{ route('cart.add', 4) }}" method="POST" class="mt-auto">
                    @csrf
                    <button type="submit"
                        class="mt-4 w-full bg-indigo-600 hover:bg-indigo-800 text-white font-semibold py-2 rounded transition-all duration-300 hover:scale-105">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection