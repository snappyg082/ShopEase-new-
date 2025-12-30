@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    <h2 class="text-2xl font-bold mb-6">
        Search results for "{{ $query }}"
    </h2>

    {{-- Products --}}
    <h3 class="text-xl font-semibold mb-3">Products</h3>

    @if($products->isEmpty())
    <p class="text-gray-500">No products found.</p>
    @else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @foreach($products as $product)
        <div class="p-4 bg-white shadow rounded">
            <h4 class="font-bold">{{ $product->name }}</h4>
            <p class="text-sm text-gray-600">{{ $product->description }}</p>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Orders --}}
    <h3 class="text-xl font-semibold mb-3">Track your orders</h3>

    @if($orders->isEmpty())
    <p class="text-gray-500">No Tracking-orders found.</p>
    @else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @foreach($orders as $order)
        <div class="p-4 bg-white shadow rounded">
            <h4 class="font-bold">Status: {{ $order->status }}</h4>
            <h4 class="font-bold">Price: {{ $order->total_price }}</h4>
            <p class="text-sm text-gray-600">Date: {{ $order->created_at->format('M d, Y') }}</p>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Cart Items --}}
    <h3 class="text-xl font-semibold mb-3">Your Cart</h3>

    @if($carts->isEmpty())
    <p class="text-gray-500">No cart items found.</p>
    @else
    <ul class="space-y-3">
        @foreach($carts as $cart)
        <li class="p-4 bg-gray-100 rounded">
            {{ $cart->product->name }} — Qty: {{ $cart->quantity }}
        </li>
        @endforeach
    </ul>
    @endif

</div>
@endsection