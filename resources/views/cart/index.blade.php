@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Page Header --}}
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                🛒 Your Cart
            </h1>
        </div>

        {{-- Empty Cart --}}
        @if($cartItems->isEmpty())
        <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-10 text-center">
            <p class="text-gray-600 dark:text-gray-300 text-lg">Your cart is empty.</p>
            <a href="{{ route('shop.products') }}"
                class="inline-block mt-6 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 transition">
                🛍 Start Shopping
            </a>
        </div>
        @else

        {{-- Cart Table --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Product
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Price
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Quantity
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Total
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($cartItems as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">{{ $item->product->name }}
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                            ${{ number_format($item->product->price, 2) }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $item->quantity }}</td>
                        <td class="px-6 py-4 font-semibold text-green-600">
                            ${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('cart.remove', $item->product->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-500 transition">
                                    Remove
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Place Order Button --}}
            <div class="p-6 text-right">
                <form action="{{ url('/orders/create') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition">
                        ✅ Place Order
                    </button>
                </form>
            </div>
        </div>

        @endif

    </div>
</div>
@endsection