@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- search text --}}
    <h2 class="text-2xl font-bold mb-6">
        Search results for "{{ $query }}"
    </h2>

    {{-- Back button --}}
    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-indigo-100 font-semibold">
            ← Back
        </a>
    </div>

    {{-- False statement for product,order,cart if search not found --}}
    @if ($products->isEmpty() && $orders->isEmpty()&& $carts->isEmpty())
    <p class="text-gray-600 dark:text-gray-900">No results found.</p>
    @endif

    {{-- product --}}
    <div class="grid grid-cols-auto md:grid-cols-auto gap-4 mb-8">
        @foreach($products as $product)
        <div class="p-4 bg-white shadow rounded">
            {{-- Product Detail Container --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">

                {{-- Product Image --}}
                <div class="flex items-center justify-center">
                    @php
                    // Prefer explicit product image if set; otherwise use product{id}.jpg then test.jpg
                    $imagePath = 'images/' . ($product->image ?? ('product' . $product->id . '.jpg'));
                    if(!file_exists(public_path($imagePath))){
                    $imagePath = 'images/product' . $product->id . '.jpg';
                    if(!file_exists(public_path($imagePath))){
                    $imagePath = 'images/test.jpg';
                    }
                    }
                    @endphp
                    <img src="{{ asset($imagePath) }}" onerror="this.src='{{ asset('images/test.jpg') }}'"
                        alt="{{ $product->name }}"
                        class="w-full h-auto max-h-96 object-cover rounded-lg border-4 border-indigo-600 shadow-lg hover:scale-105 transition duration-300">
                </div>

                {{-- Product Details --}}
                <div class="flex flex-col justify-between">

                    {{-- Product Header --}}
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                            {{ $product->name }}
                        </h1>

                        <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
                            {{ $product->description }}
                        </p>

                        {{-- Product Info --}}
                        <div class="space-y-4 mb-8 pb-8 border-b border-gray-300 dark:border-gray-700">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400 font-semibold">Price:</span>
                                <span class="text-4xl font-bold text-green-600 dark:text-green-400">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400 font-semibold">Available Stock:</span>
                                <span
                                    class="text-lg font-semibold {{ $product->stock > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ $product->stock > 0 ? $product->stock . ' units' : 'Out of Stock' }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400 font-semibold">Product ID:</span>
                                <span class="text-sm text-gray-500 dark:text-gray-300">#{{ $product->id }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Add to Cart Action --}}
                    @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                            🛒 Add to Cart
                        </button>
                    </form>
                    @else
                    <button disabled
                        class="w-full bg-gray-400 text-white font-bold py-4 rounded-lg cursor-not-allowed opacity-50">
                        Out of Stock
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Orders --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @foreach($orders as $order)
        <div class="p-4 bg-white shadow rounded">
            <h4 class="font-bold">Status: {{ $order->status }}</h4>
            <h4 class="font-bold">Price: {{ $order->total_price }}</h4>
            <p class="text-sm text-gray-600">Date: {{ $order->created_at->format('M d, Y') }}</p>
        </div>
        @endforeach
    </div>

    {{-- Cart Items --}}
    <ul class="space-y-3">
        @foreach($carts as $cart)
        <li class="p-4 bg-gray-100 rounded">
            {{ $cart->product->name }} — Qty: {{ $cart->quantity }}
        </li>
        @endforeach
    </ul>
</div>
@endsection